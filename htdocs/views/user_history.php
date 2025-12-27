<?php
$pageJs = 'user_history';
require_once __DIR__ . '/partials/header.php';
?>
<div class="container py-5">
    <h1 class="text-center mb-4">Your Wordrift History</h1>
    <div class="row g-3 bg-light">
        <?php if (!empty($history)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Word</th>
                        <th>Attempts</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($history as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['game_date']) ?></td>
                            <td><?= htmlspecialchars($row['answer']) ?></td>
                            <td><?= htmlspecialchars($row['guesses']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if ($pagination['total'] > 1): ?>
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php for ($p = 1; $p <= $pagination['total']; $p++): ?>
                            <li class="page-item<?= $p == $pagination['current'] ? ' active' : '' ?>">
                                <a class="page-link" href="?page=<?= $p ?>"><?= $p ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        <?php else: ?>
            <?php if(!isset($_SESSION[PREFIX . 'user_id'])): ?>
            <div class="col-12 text-center"><div class="alert alert-danger">You need to be logged in to view history.</div></div>
            <?php else: ?>
            <div class="col-12 text-center"><div class="alert alert-warning">No correct guesses recorded yet.</div></div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php require_once __DIR__ . '/partials/footer.php'; ?>