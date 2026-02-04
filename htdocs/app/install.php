
<?php
// Error/exception handler: always return JSON
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => "PHP Error: $errstr in $errfile on line $errline"
    ]);
    exit;
});
set_exception_handler(function($exception) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Uncaught Exception: ' . $exception->getMessage(),
        'file' => $exception->getFile(),
        'line' => $exception->getLine()
    ]);
    exit;
});
// rebuild/htdocs/app/install.php
header('Content-Type: application/json');

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

// Check for required config files
$configPath = __DIR__ . '/config.php';
$mailConfigPath = __DIR__ . '/mail_config.php';
if (!file_exists($configPath)) {
    echo json_encode(['success' => false, 'error' => 'config.php is missing. Please copy config-example.php to config.php and update your settings.']);
    exit;
}
if (!file_exists($mailConfigPath)) {
    echo json_encode(['success' => false, 'error' => 'mail_config.php is missing. Please copy mail_config-example.php to mail_config.php and update your settings.']);
    exit;
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);
$db_host = $input['db_host'] ?? '';
$db_user = $input['db_user'] ?? '';
$db_pass = $input['db_pass'] ?? '';
$db_name = $input['db_name'] ?? '';

if (!$db_host || !$db_user || !$db_name) {
    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
    exit;
}

// Try DB connection
$mysqli = @new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($mysqli->connect_error) {
    echo json_encode(['success' => false, 'error' => 'DB connection failed: ' . $mysqli->connect_error]);
    exit;
}

// Run migrations/install.sql
$sql_file = __DIR__ . '/install.sql';
if (!file_exists($sql_file)) {
    echo json_encode(['success' => false, 'error' => 'install.sql not found.']);
    $mysqli->close();
    exit;
}
$sql = file_get_contents($sql_file);
if ($sql === false) {
    echo json_encode(['success' => false, 'error' => 'Failed to read install.sql.']);
    $mysqli->close();
    exit;
}
// Split and execute each statement
$queries = array_filter(array_map('trim', preg_split('/;\s*\n/', $sql)));
foreach ($queries as $query) {
    if ($query && !$mysqli->query($query)) {
        echo json_encode(['success' => false, 'error' => 'SQL error: ' . $mysqli->error]);
        $mysqli->close();
        exit;
    }
}

$mysqli->close();

// Delete install.sql after successful install
@unlink(__DIR__ . '/install.sql');
$mysqli->close();

// Write config to db_conf.php
$config_file = __DIR__ . '/db_conf.php';
$config_php = "<?php\nreturn [\n    'db_host' => '" . addslashes($db_host) . "',\n    'db_user' => '" . addslashes($db_user) . "',\n    'db_pass' => '" . addslashes($db_pass) . "',\n    'db_name' => '" . addslashes($db_name) . "'\n];\n";
if (file_put_contents($config_file, $config_php) === false) {
    echo json_encode(['success' => false, 'error' => 'Failed to write config file']);
    exit;
}

// Optionally, create an installed flag file
$flag_file = __DIR__ . '/../../storage/installed.flag';
@touch($flag_file);

echo json_encode(['success' => true]);
