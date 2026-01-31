<?php
// htdocs/app/create_admin.php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

// Get POST data
$display_name = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!$display_name || !$email || !$password) {
    echo json_encode(['success' => false, 'error' => 'All fields are required.']);
    exit;
}

// Load DB config
$db_conf = require __DIR__ . '/db_conf.php';
$mysqli = @new mysqli($db_conf['db_host'], $db_conf['db_user'], $db_conf['db_pass'], $db_conf['db_name']);
if ($mysqli->connect_error) {
    echo json_encode(['success' => false, 'error' => 'DB connection failed: ' . $mysqli->connect_error]);
    exit;
}

// Check if user already exists
$stmt = $mysqli->prepare('SELECT id FROM users WHERE display_name = ? OR email = ? LIMIT 1');
$stmt->bind_param('ss', $display_name, $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    echo json_encode(['success' => false, 'error' => 'User or email already exists.']);
    $stmt->close();
    $mysqli->close();
    exit;
}
$stmt->close();

// Hash password
$hash = password_hash($password, PASSWORD_DEFAULT);
// Generate security_hash
$security_hash = bin2hex(random_bytes(16));

// Insert admin user
$stmt = $mysqli->prepare('INSERT INTO users (display_name, email, pwd, security_hash, is_admin, created_at) VALUES (?, ?, ?, ?, 1, NOW())');
$stmt->bind_param('ssss', $display_name, $email, $hash, $security_hash);
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Failed to create user: ' . $stmt->error]);
}
$stmt->close();
$mysqli->close();
