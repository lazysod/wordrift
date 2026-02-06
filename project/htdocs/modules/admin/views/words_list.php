<?php 
if (!isset($config)) {
    $config = file_exists($_SERVER['DOCUMENT_ROOT'] . '/app/config.php') ? include $_SERVER['DOCUMENT_ROOT'] . '/app/config.php' : [];
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];
require_once __DIR__ . '/../../../views/partials/admin_header.php';
?>
<div class="container py-4">
    <h2 class="mb-4">Word List Management</h2>
    <?php if (!empty($_SESSION['admin_words_msg'])): ?>
        <div class="alert alert-<?php echo $_SESSION['admin_words_msg_type']; ?>"><?= $_SESSION['admin_words_msg']; ?></div>
        <?php unset($_SESSION['admin_words_msg']); ?>
    <?php endif; ?>
    <form method="post" action="/admin/words/add" class="row g-2 mb-3">
        <div class="col-auto">
            <input type="text" name="word" maxlength="5" required class="form-control" placeholder="Add new word (3-5 letters)">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Add Word</button>
        </div>
    </form>
    <form method="post" enctype="multipart/form-data" action="/admin/words/upload" class="row g-2 mb-4">
        <div class="col-auto">
            <input type="file" name="csv" accept=".csv" required class="form-control">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-success">Upload CSV</button>
        </div>
    </form>
    <form method="post" action="/admin/words/deleteall" class="mb-3" id="deleteAllForm">
        <input type="hidden" name="confirm" value="yes">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAllModal">Delete All Words</button>
    </form>
    <button type="button" class="btn btn-info mb-3" id="downloadWordsBtn">Download Words (CSV)</button>
<script>
document.getElementById('downloadWordsBtn').addEventListener('click', function() {
    fetch('/admin/words/export?csrf_token=<?= htmlspecialchars($csrf_token) ?>')
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.blob();
        })
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'word_list.csv';
            document.body.appendChild(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);
        })
        .catch(error => alert('Download failed: ' + error));
});
</script>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Word</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($words as $w): ?>
                <tr>
                    <td><?= $w['word_id'] ?></td>
                    <td><?= htmlspecialchars($w['word']) ?></td>
                    <td>
                        <form method="post" action="/admin/words/remove" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $w['word_id'] ?>">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Remove this word?');">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if ($total > 25): ?>
    <nav>
        <ul class="pagination">
            <?php
            $totalPages = ceil($total / 25);
            $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
            $start = max(1, $page - 2);
            $end = min($totalPages, $page + 2);
            if ($start > 1) {
                echo '<li class="page-item"><a class="page-link" href="/admin/words?page=1">1</a></li>';
                if ($start > 2) echo '<li class="page-item disabled"><span class="page-link">…</span></li>';
            }
            for ($i = $start; $i <= $end; $i++) {
                $active = $i == $page ? ' active' : '';
                echo '<li class="page-item' . $active . '"><a class="page-link" href="/admin/words?page=' . $i . '">' . $i . '</a></li>';
            }
            if ($end < $totalPages) {
                if ($end < $totalPages - 1) echo '<li class="page-item disabled"><span class="page-link">…</span></li>';
                echo '<li class="page-item"><a class="page-link" href="/admin/words?page=' . $totalPages . '">' . $totalPages . '</a></li>';
            }
            ?>
        </ul>
    </nav>
    <?php endif; ?>
</div>
<?php require_once __DIR__ . '/../../../views/partials/footer.php';
