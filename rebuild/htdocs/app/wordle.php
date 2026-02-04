<?php
// htdocs/app/wordle.php
$action = $_GET['action'] ?? $_POST['action'] ?? null;
$is_ajax = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest');
include_once __DIR__ . '/start.php'; // Load configuration and autoload
// Allow AJAX or direct GET for leaderboard and last_result
if ($is_ajax || $action === 'last_result' || $action === 'leaderboard') {
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    // require_once __DIR__ . '/start.php';
    global $config;
    $db = new \App\DB($config);
    if (session_status() === PHP_SESSION_NONE) session_start();

    $public_actions = ['validate', 'leaderboard', 'daily', 'get_stats'];
    $action = $_REQUEST['action'] ?? '';
    if (!in_array($action, $public_actions)) {
        // Only allow logged-in users for non-public actions
        if (!isset($_SESSION[PREFIX . 'user_id'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Login required']);
            exit;
        }
    }

    // --- Return last game session for user (for showing last guesses as actual words) ---
    if ($action === 'last_result') {
        $user_id = $_SESSION[PREFIX . 'user_id'] ?? null;
        $mode = $_GET['mode'] ?? 'daily';
        $today = date('Y-m-d');
        if (!$user_id) {
            http_response_code(401);
            echo json_encode(['error' => 'Login required']);
            exit;
        }
        $sql = "SELECT guesses_made, answer, game_date FROM game_sessions WHERE user_id = ? AND mode = ? AND is_complete = 1 AND game_date = ? ORDER BY id DESC LIMIT 1";
        $row = $db->fetch($sql, [$user_id, $mode, $today]);
        if ($row && !empty($row['guesses_made'])) {
            $guesses = json_decode($row['guesses_made'], true);
            $guessed_words = [];
            $guessed_results = [];
            foreach ($guesses as $g) {
                $guessed_words[] = $g['word'];
                $guessed_results[] = $g['result']; // array of 'correct', 'present', 'absent'
            }
            echo json_encode([
                'guessed_words' => $guessed_words,
                'guessed_results' => $guessed_results,
                'answer' => $row['answer'],
                'game_date' => $row['game_date']
            ]);
        } else {
            echo json_encode([
                'guessed_words' => [],
                'guessed_results' => [],
                'answer' => '',
                'game_date' => ''
            ]);
        }
        exit;
    }

// --- Check if user has played daily game today ---
if ($action === 'daily_played_check') {
    $user_id = $_SESSION[PREFIX . 'user_id'] ?? null;
    $puzzle_date = date('Y-m-d');

    if (!$user_id) {
        http_response_code(401);
        echo json_encode(['error' => 'Login required']);
        exit;
    }
    // $logger = new Logger(['daily_played'], 'User_id: ' . $user_id . ' date: ' . $puzzle_date);
    // $logger->info("CHECK: user_id=$user_id, puzzle_date=$puzzle_date");
    $sql = "SELECT 1 FROM `daily_played` WHERE `user_id`=? AND DATE(`game_date`)=? LIMIT 1";
    $row = $db->fetch($sql, [$user_id, $puzzle_date]);
    echo json_encode(['played' => $row ? true : false]);
    exit;
}

if ($action === 'validate' && isset($_GET['guess'])) {
    $guess = strtoupper($db->escapeString($_GET['guess']));
    $sql = "SELECT 1 FROM `word_list` WHERE `word` = ? LIMIT 1";
    $row = $db->fetch($sql, [$guess]);
    $errorInfo = $db->errorInfo();
    if ($row === false && $errorInfo && $errorInfo[0] !== '00000') {
        http_response_code(500);
        echo json_encode(['error' => 'Query failed', 'db_error' => $errorInfo]);
        exit;
    }
    // If $row is false but no DB error, it means not found (not a valid word)
    echo json_encode(['valid' => $row ? true : false]);
    exit;
}

// --- Record game result ---
if ($action === 'record_result' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debug: log incoming request for troubleshooting
    $logFile = __DIR__ . '/../storage/logs/wordle_debug.log';
    file_put_contents($logFile, "\n==== record_result ====".PHP_EOL, FILE_APPEND);
    $rawInput = file_get_contents('php://input');

    // Only allow AJAX requests
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
        http_response_code(403);
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'code' => 403, 'message' => 'Invalid access method (AJAX required)']);
        exit;
    }
    // Expect JSON body
    $input = json_decode($rawInput, true);
    file_put_contents($logFile, 'Raw input: '.$rawInput.PHP_EOL, FILE_APPEND);
    file_put_contents($logFile, 'Parsed input: '.print_r($input, true).PHP_EOL, FILE_APPEND);
    // Only allow AJAX requests
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
        http_response_code(403);
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'code' => 403, 'message' => 'Invalid access method (AJAX required)']);
        exit;
    }
    // Expect JSON body
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid JSON input']);
        exit;
    }
    $user_id = $_SESSION[PREFIX . 'user_id'] ?? null;
    $game_date = $input['game_date'] ?? date('Y-m-d'); // <-- always use the intended puzzle date!
    $mode = $input['mode'] ?? '';
    $result = $input['result'] ?? '';
    $guesses = isset($input['guesses']) ? (int)$input['guesses'] : null;
    $answer = $input['answer'] ?? '';
    $guess_history = isset($input['guess_history']) ? $input['guess_history'] : '';
    $missing = [];
    if (!$user_id) $missing[] = 'user_id';
    if (!$mode) $missing[] = 'mode';
    if (!$result) $missing[] = 'result';
    if ($guesses === null || $guesses === '') $missing[] = 'guesses';
    if (!$answer) $missing[] = 'answer';
    if (!empty($missing)) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing required fields', 'fields' => $missing, 'input' => $input]);
        exit;
    }
    // Only record completed games (win/loss)
    if ($result === 'win' || $result === 'loss') {
        // --- NEW: Insert or update game_sessions for persistent guesses ---
        $guesses_made = $input['guesses_made'] ?? null; // Could be JSON string or array
        if (!$guesses_made && !empty($input['guess_history'])) {
            // Try to reconstruct guesses_made from guess_history (legacy)
            $guesses_made = json_encode(array_map(function($word) {
                return ['word' => $word, 'result' => []];
            }, explode("\n", $input['guess_history'])));
        } else if (is_array($guesses_made)) {
            $guesses_made = json_encode($guesses_made);
        } else if (is_string($guesses_made)) {
            // If it's a string, check if it's valid JSON, and re-encode to ensure DB always gets a string
            $decoded = json_decode($guesses_made, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $guesses_made = json_encode($decoded);
            } // else leave as-is (may be null or invalid)
        }
        file_put_contents($logFile, 'guesses_made (pre-save): '.print_r($guesses_made, true).PHP_EOL, FILE_APPEND);
        require_once __DIR__ . '/game.php';
        $game = new game($db); // <-- FIXED
        $insert_id = $game->addGameResult($user_id, $game_date, $mode, $result, $guesses, $answer, $guess_history);
        $is_complete = 1;
        // Upsert into game_sessions
        $sql = "SELECT id FROM game_sessions WHERE user_id = ? AND game_date = ? AND mode = ? LIMIT 1";
        $existing = $db->fetch($sql, [$user_id, $game_date, $mode]);
        if ($existing) {
                        file_put_contents($logFile, 'Updating game_sessions: '.print_r([$guesses_made, $answer, $is_complete, $existing['id']], true).PHP_EOL, FILE_APPEND);
                        file_put_contents($logFile, 'Inserting game_sessions: '.print_r([$user_id, $game_date, $mode, $guesses_made, $answer, $is_complete], true).PHP_EOL, FILE_APPEND);
            $sql = "UPDATE game_sessions SET guesses_made = ?, answer = ?, is_complete = ?, updated_at = NOW() WHERE id = ?";
            $db->query($sql, [$guesses_made, $answer, $is_complete, $existing['id']]);
        } else {
            $sql = "INSERT INTO game_sessions (user_id, game_date, mode, guesses_made, answer, is_complete, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
            $db->query($sql, [$user_id, $game_date, $mode, $guesses_made, $answer, $is_complete]);
        }

        // If daily game, record in daily_played
        if ($mode === 'daily') {
            $user_id = $_SESSION[PREFIX . 'user_id'] ?? null;
            $puzzle_date = $game_date; // <-- Use the intended puzzle date from frontend!

            $sql = "SELECT 1 FROM `daily_played` WHERE `user_id`=? AND DATE(`game_date`)=? LIMIT 1";
            $row = $db->fetch($sql, [$user_id, $puzzle_date]);
            if (!$row) {
                $sql2 = "INSERT INTO `daily_played` (`user_id`, `game_date`) VALUES (?, ?)";
                $db->query($sql2, [$user_id, $puzzle_date]);
            }
        }
        echo json_encode(['success' => true, 'id' => $insert_id]);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Game not completed']);
    }
    exit;
}


// --- Leaderboard API ---
if ($action === 'leaderboard') {
    require_once __DIR__ . '/game.php';
    $game = new game($db); // <-- FIXED
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $rows = $game->getLeaderboard($limit);
    echo json_encode(['leaderboard' => $rows]);
    exit;
}

// --- Get stats API ---
if ($action === 'get_stats') {
    $user_id = $_SESSION[PREFIX . 'user_id'] ?? null;
    $mode = $_GET['mode'] ?? '';
    if (!$mode) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing mode']);
        exit;
    }
    $game = new game($db);
    if ($user_id) {
        $stats = $game->getUserStats($user_id, $mode);
    } else {
        // Return empty/default stats for guests
        $stats = [
            'games_played' => 0,
            'wins' => 0,
            'current_streak' => 0,
            'max_streak' => 0,
            'win_percentage' => 0,
            'guess_distribution' => []
        ];
    }
    echo json_encode(['stats' => $stats]);
    exit;
}

if ($action === 'daily') {
    $game = new game($db); // already correct here
    $puzzle_date = $_GET['game_date'] ?? date('Y-m-d');
    $word = $game->getDailyWord($puzzle_date);
    if (!$word) {
        http_response_code(500);
        echo json_encode(['error' => 'Could not load word. Try refreshing.']);
        exit;
    }
    echo json_encode(['word' => $word]);
    exit;
}

if ($action === 'random') {
    $row = $db->fetch("SELECT `word` FROM `word_list` ORDER BY RAND() LIMIT 1");
    if (!$row) {
        http_response_code(500);
        echo json_encode(['error' => 'Could not load word. Try refreshing.']);
        exit;
    }
    echo json_encode(['word' => $row['word']]);
    exit;
}

http_response_code(400);
echo json_encode(['error' => 'Invalid request']);
}else{
    $data = array(
        'status' => 'error',
        'code' => 403,
        'message' => 'Invalid access method'
    );
    echo json_encode($data);
}