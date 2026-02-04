<?php 
require_once dirname(__DIR__, 3) . '/views/partials/header.php';
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
<?php require_once dirname(__DIR__, 3) . '/views/partials/footer.php'; ?>
