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
                        <th>Colored Results</th>
                        <th>Share</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($history as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['game_date']) ?></td>
                            <td><?= htmlspecialchars($row['answer']) ?></td>
                            <td><?= htmlspecialchars($row['guesses']) ?></td>
                            <td style="font-family:monospace;white-space:normal;">
                                <?php
                                // Remove empty lines and only show non-empty rows, one per line
                                $lines = preg_split('/\r?\n/', $row['guess_history'] ?? '');
                                $lines = array_filter(array_map('trim', $lines), fn($l) => $l !== '');
                                echo implode('<br>', array_map('htmlspecialchars', $lines));
                                ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-success btn-sm share-history-btn" 
                                    data-date="<?= htmlspecialchars($row['game_date']) ?>"
                                    data-answer="<?= htmlspecialchars($row['answer']) ?>"
                                    data-attempts="<?= htmlspecialchars($row['guesses']) ?>"
                                    data-results="<?= htmlspecialchars(str_replace(array("\r","\n"), "\\n", $row['guess_history'] ?? '')) ?>">
                                    Share
                                </button>
                            </td>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.share-history-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const date = btn.getAttribute('data-date');
            const answer = btn.getAttribute('data-answer');
            const attempts = btn.getAttribute('data-attempts');
            let results = btn.getAttribute('data-results').replace(/\\n/g, '\n');
            // Remove any trailing blank lines
            results = results.replace(/\n+$/g, '');
            // Format date as DD-MM-YYYY for sharing
            let formattedDate = date;
            if (/^\d{4}-\d{2}-\d{2}$/.test(date)) {
                const [y, m, d] = date.split('-');
                formattedDate = `${d}-${m}-${y}`;
            }
            const text = results
                ? `Wordrift (${formattedDate}) ${answer} ${attempts}/6\n${results}`.replace(/\n+$/g, '')
                : `Wordrift (${formattedDate}) ${answer} ${attempts}/6`;
            navigator.clipboard.writeText(text).then(() => {
                btn.textContent = 'Copied!';
                setTimeout(() => { btn.textContent = 'Share'; }, 1500);
            });
        });
    });
});
</script>
<?php require_once __DIR__ . '/partials/footer.php'; ?>