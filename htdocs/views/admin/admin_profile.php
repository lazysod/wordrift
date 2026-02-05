<?php
use App\TokenManager;
$startPath = dirname(__DIR__, 2) . '/app/start.php';
if (file_exists($startPath)) {
    $config = include dirname(__DIR__, 2) . '/app/config.php';
    include_once $startPath;
}

if (!isset($_SESSION[PREFIX . 'admin']) || $_SESSION[PREFIX . 'admin'] < 1) {
    header('Location: /admin/login');
    exit;
}

$db = class_exists('App\\DB') ? new \App\DB($config) : null;
$adminId = $_SESSION[PREFIX . 'user_id'] ?? null;
$admin = null;
if ($db && $adminId) {
    $admin = $db->fetch("SELECT * FROM users WHERE id = ? AND is_admin = 1", [$adminId]);
}
$success = '';
$error = '';

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tm = new TokenManager($config);
    $verify = $tm->verify($_POST['csrf_token'] ?? '');
    if (!isset($_['csrf_token']) || $verify['status'] !== 'success') {
        $error = 'Invalid CSRF token.';
    } elseif (!$admin) {
        $error = 'Admin not found.';
    } else {
        $display_name = trim($_POST['display_name'] ?? '');
        $pwd = $_POST['pwd'] ?? '';
        $pwd2 = $_POST['pwd2'] ?? '';
        if (!$display_name) {
            $error = 'Display Name is required.';
        } elseif ($pwd && $pwd !== $pwd2) {
            $error = 'Passwords do not match.';
        } else {
            $params = [$display_name, $adminId];
            $sql = "UPDATE users SET display_name = ? WHERE id = ? AND is_admin = 1";
            $db->query($sql, $params);
            if ($pwd) {
                $hashed = password_hash($pwd, PASSWORD_DEFAULT);
                $db->query("UPDATE users SET password = ? WHERE id = ? AND is_admin = 1", [$hashed, $adminId]);
            }
            $success = 'Profile updated successfully.';
            // Refresh admin data
            $admin = $db->fetch("SELECT * FROM users WHERE id = ? AND is_admin = 1", [$adminId]);
        }
    }
}
?>
<?php require __DIR__ . '/../partials/admin_header.php'; ?>
<section class="py-5">
    <div class="container mt-5">
        <?php if (!empty($success)) : ?>
            <div class="alert alert-success"> <?php echo htmlspecialchars($success) ?> </div>
        <?php endif; ?>
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger"> <?php echo htmlspecialchars($error) ?> </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6">
                <h2>Admin Profile</h2>
                <div class="card" style="max-width: 500px;">
                    <div class="card-body">
                        <p><strong>Display Name:</strong> <?php echo htmlspecialchars($admin['display_name'] ?? 'No display name set') ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($admin['email'] ?? '') ?></p>
                        <p><strong>Role:</strong> Admin</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <form method="post" action="">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(TokenManager::csrf($config)) ?>" />
                    <div class="form-floating mb-3">
                        <input class="form-control" id="display_name" name="display_name" type="text" value="<?php echo htmlspecialchars($admin['display_name'] ?? '') ?>" required />
                        <label for="display_name">Display Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="pwd" name="pwd" type="password" placeholder="New password (leave blank to keep current)" />
                        <label for="pwd">New Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="pwd2" name="pwd2" type="password" placeholder="Confirm new password" />
                        <label for="pwd2">Confirm New Password</label>
                    </div>
                    <div class="d-grid"><button class="btn btn-primary btn-lg" type="submit">Update Profile</button></div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require __DIR__ . '/../partials/footer.php'; ?>


<pre>DEBUG adminId: <?php var_dump($adminId); ?></pre>