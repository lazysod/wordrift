<?php 
$pageJs = 'leaderboard';
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../app/class/DB.php';
$config = include __DIR__ . '/../app/config.php';

$db = new DB($config);

try {
    // Get all users who have played at least one game
    $sql = "SELECT u.id, u.display_name, 
                   SUM(gr.mode = 'daily' AND gr.result = 'win') AS daily_wins,
                   MAX(gr.current_streak) AS max_streak
            FROM users u
            JOIN game_results gr ON gr.user_id = u.id
            GROUP BY u.id
            ORDER BY daily_wins DESC, max_streak DESC, u.display_name ASC";
    $result = $db->query($sql);
    $users = [];
    foreach ($result as $row) {
        $users[] = [
            'id' => $row['id'],
            'display_name' => $row['display_name']
        ];
    }
    $game = new game($db);
    $leaderboard = [];
    foreach ($users as $i => $user) {
        try {
            $daily = $game->getUserStats($user['id'], 'daily');
            $random = $game->getUserStats($user['id'], 'random');
        } catch (Exception $e) {
            $daily = $random = [
                'played' => 0,
                'wins' => 0,
                'streak' => 0,
                'maxStreak' => 0
            ];
        }
        $leaderboard[] = [
            'rank' => $i + 1,
            'user' => $user['display_name'],
            'daily' => $daily,
            'random' => $random
        ];
    }
    // Output HTML for leaderboard

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
    exit;
}
?>
<div class="container py-5">
    <h1 class="text-center mb-4">Leaderboard</h1>
    <div class="row g-3">
        <?php if (!empty($leaderboard)): ?>
            <?php foreach ($leaderboard as $i => $user): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-2"><?= $i + 1 ?>. <?= htmlspecialchars($user['user']) ?></h5>
                            <div class="row g-2 d-flex">
                                <div class="col">
                                    <span class="badge bg-primary">Daily</span>
                                    <div class="small">
                                        Played: <?= $user['daily']['played'] ?><br>
                                        Wins: <?= $user['daily']['wins'] ?><br>
                                        Streak: <?= $user['daily']['streak'] ?><br>
                                        Max Streak: <?= $user['daily']['maxStreak'] ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <span class="badge bg-success">Random</span>
                                    <div class="small">
                                        Played: <?= $user['random']['played'] ?><br>
                                        Wins: <?= $user['random']['wins'] ?><br>
                                        Streak: <?= $user['random']['streak'] ?><br>
                                        Max Streak: <?= $user['random']['maxStreak'] ?>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12"><div class="alert alert-warning">No leaderboard data available.</div></div>
        <?php endif; ?>
    </div>
</div>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
