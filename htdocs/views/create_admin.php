<?php
$title = 'Install Wordrift';
require __DIR__ . '/partials/header.php';
?>
<div class="container py-5">
    <div class="row d-flex">
        <div class="col-lg-6 mx-auto">
            <h1 class="mb-4">Wordrift Installation</h1>
            <h2>Create Admin User</h2>
            <form action="/create_admin.php" method="post" class="card p-4 shadow-sm">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required><br>
                <button type="submit" class="btn btn-primary">Create Admin</button>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>

<script>
// Intercept form submit and use AJAX
const form = document.querySelector('form[action="/create_admin"]');
if (form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const data = new FormData(form);
        fetch('/create_admin', {
            method: 'POST',
            body: data
        })
        .then(res => res.json())
        .then(result => {
            if (result.success) {
                window.location.href = '/admin_created';
            } else {
                alert(result.error || 'Failed to create admin user.');
            }
        })
        .catch(() => alert('Error creating admin user.'));
    });
}
</script>