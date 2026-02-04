
<?php
require_once __DIR__ . '/app/App.php';
use App\App;
// /rebuild/htdocs/create_admin.php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Show a simple HTML form
    echo '<!DOCTYPE html><html><head><title>Create Admin</title><meta charset="utf-8"><style>body{font-family:sans-serif;background:#f9f9f9;}form{max-width:400px;margin:3em auto;padding:2em;background:#fff;border-radius:8px;box-shadow:0 2px 8px #ccc;}label{display:block;margin-top:1em;}input{width:100%;padding:0.5em;margin-top:0.2em;}button{margin-top:1.5em;width:100%;padding:0.7em;background:#007bff;color:#fff;border:none;border-radius:4px;font-size:1em;}</style></head><body><form method="post" action=""><h2>Create Admin User</h2><label>Username:<input type="text" name="username" required></label><label>Email:<input type="email" name="email" required></label><label>Password:<input type="password" name="password" required></label><button type="submit">Create Admin</button></form></body></html>';
    exit;
}


// Only allow POST for form submission
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo '<!DOCTYPE html><html><head><title>Error</title></head><body><h2>Method not allowed</h2></body></html>';
    exit;
// Detect if running from CLI or web
if (php_sapi_name() === 'cli') {
    echo "Admin user created\n";
    exit(0);
}

// If running from web, show styled HTML confirmation
?>
!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Created</title>
    <link rel="stylesheet" href="/css/custom.css">
</head>
<body>
    <div class="container" style="max-width: 600px; margin: 40px auto; padding: 2em; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); text-align: center;">
        <h1>Admin User Created</h1>
        <p>The admin user has been created successfully.</p>
        <a href="/" class="btn" style="display: inline-block; margin-top: 1em; padding: 0.5em 1.5em; background: #007bff; color: #fff; border-radius: 4px; text-decoration: none;">Go to Home</a>
    </div>
</body>
</html>
<?php
}


$display_name = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
if (!$display_name || !$email || !$password) {
    echo '<!DOCTYPE html><html><head><title>Error</title></head><body><h2>All fields are required.</h2><a href="create_admin">Back</a></body></html>';
    exit;
}


$db_conf = require __DIR__ . '/app/db_conf.php';
$mysqli = @new mysqli($db_conf['db_host'], $db_conf['db_user'], $db_conf['db_pass'], $db_conf['db_name']);
if ($mysqli->connect_error) {
    echo '<!DOCTYPE html><html><head><title>Error</title></head><body><h2>DB connection failed: '.htmlspecialchars($mysqli->connect_error).'</h2><a href="create_admin">Back</a></body></html>';
    exit;
}


$stmt = $mysqli->prepare('SELECT id FROM users WHERE display_name = ? OR email = ? LIMIT 1');
$stmt->bind_param('ss', $display_name, $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    echo '<!DOCTYPE html><html><head><title>Error</title></head><body><h2>User or email already exists.</h2><a href="create_admin">Back</a></body></html>';
    $stmt->close();
    $mysqli->close();
    exit;
}
$stmt->close();


$hash = password_hash($password, PASSWORD_DEFAULT);
$security_hash = bin2hex(random_bytes(16));
$stmt = $mysqli->prepare('INSERT INTO users (display_name, email, pwd, security_hash, is_admin, created_at) VALUES (?, ?, ?, ?, 1, NOW())');
$stmt->bind_param('ssss', $display_name, $email, $hash, $security_hash);
if ($stmt->execute()) {
    // Redirect to the styled confirmation page
    header('Location: /views/admin_created.php');
    exit;
} else {
    echo '<!DOCTYPE html><html><head><title>Error</title></head><body><h2>Failed to create user: '.htmlspecialchars($stmt->error).'</h2><a href="create_admin">Back</a></body></html>';
}
$stmt->close();
$mysqli->close();
