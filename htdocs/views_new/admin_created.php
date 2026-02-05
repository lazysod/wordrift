<?php
$title = 'Admin User Created';
require __DIR__ . '/partials/header.php';
?>
<div class="container py-5">
    <div class="row d-flex">
        <div class="col-lg-6 mx-auto">
            <div class="card p-4 shadow-sm text-center">
                <h2 class="mb-3">Admin User Created!</h2>
                <p class="mb-4">Your admin account has been created successfully. You can now log in and start using Wordrift.</p>
                <a href="/" class="mb-4 btn btn-success">Go to Home</a>
                <a href="/user/login" class="btn btn-primary">Login</a>
            </div>
        </div>
    </div>
</div>
<?php require __DIR__ . '/partials/footer.php'; ?>
