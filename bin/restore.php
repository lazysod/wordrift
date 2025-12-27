<?php
#!/usr/bin/env php
// Database restore script for Strata Framework

if (!isset($config)) {
    $config = require __DIR__ . '/../htdocs/app/config.php';
}
if (!$config || !isset($config['db'])) {
    echo "Could not load database config.\n";
    exit(1);
}

$dbname = $config['db']['database'];
$user = $config['db']['username'];
$pass = $config['db']['password'];
$host = $config['db']['host'];

// Get backup file from command line
if ($argc < 2) {
    echo "Usage: php restore.php /path/to/backup.sql\n";
    exit(1);
}
$sqlFile = $argv[1];
if (!file_exists($sqlFile)) {
    echo "Backup file not found: $sqlFile\n";
    exit(1);
}

// Check if mysql is available
exec('which mysql', $output, $ret);
if ($ret !== 0 || empty($output)) {
    echo "mysql command not found. Please install MySQL client tools.\n";
    exit(1);
}

// Run restore command
$cmd = sprintf(
    'mysql -h%s -u%s -p%s %s < %s',
    escapeshellarg($host),
    escapeshellarg($user),
    escapeshellarg($pass),
    escapeshellarg($dbname),
    escapeshellarg($sqlFile)
);

echo "Restoring database from $sqlFile...\n";
system($cmd, $restoreRet);

if ($restoreRet === 0) {
    echo "Restore complete!\n";
} else {
    echo "Restore failed.\n";
    exit(1);
}