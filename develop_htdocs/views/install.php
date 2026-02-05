<?php
$title = 'Install Wordrift';
require __DIR__ . '/partials/header.php';
?>
<div class="container py-5">
    <div class="row d-flex">
        <div class="col-lg-6 mx-auto">
            <h1 class="mb-4">Wordrift Installation</h1>
            <form id="install-form" method="post" class="card p-4 shadow-sm">
                <div class="mb-3">
                    <label for="db_host" class="form-label">Database Host</label>
                    <input type="text" class="form-control" id="db_host" name="db_host" value="localhost" required>
                </div>
                <div class="mb-3">
                    <label for="db_user" class="form-label">Database User</label>
                    <input type="text" class="form-control" id="db_user" name="db_user" value="root" required>
                </div>
                <div class="mb-3">
                    <label for="db_pass" class="form-label">Database Password</label>
                    <input type="password" class="form-control" id="db_pass" name="db_pass" value="root">
                </div>
                <div class="mb-3">
                    <label for="db_name" class="form-label">Database Name</label>
                    <input type="text" class="form-control" id="db_name" name="db_name" value="awordgame" required>
                </div>
                <button type="submit" class="btn btn-success">Install & Setup</button>
            </form>
            <div id="install-feedback" class="mt-4"></div>
        </div>
    </div>
    <div class="row" id="next_step" style="display: none;">
        <div class="col-lg-6 mx-auto">
            <hr>
        <h3>Next Step: Create Admin User</h3>
        <a href="/create_admin" class="btn btn-primary">Create Admin User</a>
        </div>
        <script>
            document.getElementById('install-form').addEventListener('submit', function(e) {
                e.preventDefault();
                const form = e.target;
                const feedback = document.getElementById('install-feedback');
                feedback.innerHTML = '<div class="alert alert-info">Running install...</div>';
                fetch('/app/install.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            db_host: form.db_host.value,
                            db_user: form.db_user.value,
                            db_pass: form.db_pass.value,
                            db_name: form.db_name.value
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            feedback.innerHTML = '<div class="alert alert-success">Install complete!</div>';
                            document.getElementById('next_step').style.display = 'block';
                        } else {
                            feedback.innerHTML = '<div class="alert alert-danger">' + (data.error || 'Install failed.') + '</div>';
                        }
                    })
                    .catch(err => {
                        feedback.innerHTML = '<div class="alert alert-danger">Error: ' + err + '</div>';
                    });
            });
        </script>
        <?php require __DIR__ . '/partials/footer.php'; ?>