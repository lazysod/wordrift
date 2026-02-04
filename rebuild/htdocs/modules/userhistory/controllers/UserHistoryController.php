<?php
namespace App\Modules\UserHistory\Controllers;

use App\DB;

class UserHistoryController
{
    public function index()
    {
        require_once dirname(__DIR__, 3) . '/app/game.php';
        global $config;
        $db = new DB($config);

        // Get user ID from session or query param
        $user_id = $_SESSION[PREFIX . 'user_id'] ?? $_GET['id'] ?? null;
        if (!$user_id) {
            $history = [];
            $pagination = [];
            include __DIR__ . '/../views/user_history.php';
            return;
        }

        // Pagination setup
        $perPage = 20;
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $offset = ($page - 1) * $perPage;

        // Get total count
        $countSql = "SELECT COUNT(*) FROM game_results WHERE user_id = ? AND result = 'win'";
        $total = $db->fetch($countSql, [$user_id]);
        $totalRows = $total ? array_values($total)[0] : 0;
        $totalPages = ceil($totalRows / $perPage);

        // Fetch paginated results from game_results
        $sql = "SELECT game_date, guesses, answer, guess_history, mode 
            FROM game_results 
            WHERE user_id = ? AND result = 'win'
            ORDER BY game_date DESC
            LIMIT $perPage OFFSET $offset";
        $history = $db->fetchAll($sql, [$user_id]);

        // For each result, fetch guessed words from game_sessions
        foreach ($history as &$row) {
            $mode = $row['mode'] ?? 'daily';
            $game_date = $row['game_date'];
            $sessionSql = "SELECT guesses_made FROM game_sessions WHERE user_id = ? AND game_date = ? AND mode = ? AND is_complete = 1 ORDER BY id DESC LIMIT 1";
            $session = $db->fetch($sessionSql, [$user_id, $game_date, $mode]);
            if ($session && !empty($session['guesses_made'])) {
                $guessesArr = json_decode($session['guesses_made'], true);
                $row['guessed_words'] = array_column($guessesArr, 'word');
            } else {
                $row['guessed_words'] = [];
            }
        }
        unset($row);

        // Pagination info for view
        $pagination = [
            'current' => $page,
            'total' => $totalPages,
            'perPage' => $perPage
        ];

        include __DIR__ . '/../views/user_history.php';
    }
}
