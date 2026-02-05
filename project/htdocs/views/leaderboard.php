<?php
require __DIR__ . '/partials/header.php';
require_once __DIR__ . '/../app/game.php';
require_once __DIR__ . '/../app/DB.php';
$config = require __DIR__ . '/../app/config.php';
$db = new App\DB($config);
$game = new game($db);

// Get all users who have played at least one game
$sql = "SELECT u.id, u.display_name FROM users u JOIN game_results gr ON gr.user_id = u.id GROUP BY u.id ORDER BY u.display_name ASC";
$result = $db->fetchAll($sql);
$users = $result ?: [];
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
// Sort leaderboard by daily wins, then streak, then max streak
usort($leaderboard, function($a, $b) {
    if ($a['daily']['wins'] !== $b['daily']['wins']) {
        return $b['daily']['wins'] - $a['daily']['wins'];
    }
    if ($a['daily']['streak'] !== $b['daily']['streak']) {
        return $b['daily']['streak'] - $a['daily']['streak'];
    }
    return $b['daily']['maxStreak'] - $a['daily']['maxStreak'];
});
$leaderboard = array_slice($leaderboard, 0, 10);
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
</div>
<?php require __DIR__ . '/partials/footer.php'; ?>
