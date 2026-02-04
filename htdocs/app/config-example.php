<?php
if (!defined('BASE_PATH')) {
  define('BASE_PATH', dirname(__DIR__, 2));
}
// Define the log file path
if (!defined('LOG_PATH')) {
    define('LOG_PATH', BASE_PATH . '/storage/logs/app.log');
}
// Example config file for Strata Framework
require_once __DIR__ . '/theme.php';

// Load modules dynamically from modules.php
// add db info into db_conf.php
$modulesConfig = include __DIR__ . '/modules.php';
if (file_exists(__DIR__ . '/db_conf.php')) {
  $db_conf = include __DIR__ . '/db_conf.php';
} else {
  $db_conf = [
    'db_host' => '',
    'db_user' => '',
    'db_pass' => '',
    'db_name' => ''
  ];
}
// mail configuration
if (file_exists(__DIR__ . '/mail_config.php')) {
  $mail_conf = include __DIR__ . '/mail_config.php';
} else {
  $mail_conf = [
    'host' => '',
    'username' => '',
    'password' => '',
    'port' => 587,
    'encryption' => 'tls',
    'from_email' => '',
  ];
}
// Basic Site Information and Settings
return array(
    'api_key' => 'changeme123',
    'site_name' => 'Wordrift',
    'site_tagline' => 'The Word Guessing Game',
    'site_description' => 'A fun word guessing game',
    'admin_email' => 'your@email.com',
    'form_email' => 'your-form@example.com',
    'base_url' => 'http://localhost:8888',
    'dashboard_url' => '/admin/dashboard',
    'logo_small' => '/assets/images/logo_small.png',
    'db' =>
    array(
      'host' => $db_conf['db_host'],
      'username' => $db_conf['db_user'],
      'password' => $db_conf['db_pass'],
      'database' => $db_conf['db_name'],
    ),
    'mail' =>
    array(
      'host' => $mail_conf['host'],
      'username' => $mail_conf['username'],
      'password' => $mail_conf['password'],
      'port' => $mail_conf['port'],
      'encryption' => $mail_conf['encryption'],
      'from_email' => $mail_conf['from_email'],
    ),
    'version' => '1.0.0',
    'debug' => true,
    'timezone' => 'Europe/London',
    'session_lifetime' => 3600,
    'session_heartbeat_interval' => 300, // seconds (default 5 minutes)
    'maintenance_mode' => false,
    'allowed_ips' =>
    array(
        0 => '127.0.0.1',
    ),
    'salt' => 'b7f8c2e1a9d4f6a3e2c1b8d7f5e4c3a2',
    'base_path' => BASE_PATH,
    'theme' => 'wordrift',
    'theme_path' => '/themes/wordrift',
    'theme_config' =>
    array(
        'name' => 'Default Theme',
        'author' => 'Strata Team',
        'version' => '1.0',
        'logo' => '/assets/images/logo_small.png',
        'favicon' => '/assets/images/favicon.ico',
        'css' => '/css/styles.css',
        'js' => '/js/scripts.js',
    ),
    'logo_url' => '/themes/default/assets/images/logo_small.png',
    'partials_path' => '/views/partials',
    'admin_views_path' => '/views/admin',
    'log_path' => LOG_PATH,
    'js_path' => '/js',
    'assets_path' => '/assets',
    'uploads_path' => '/storage/uploads',
    'prefix' => 'framework',
    'token_expiry' => 3600,
    'session_prefix' => 'wordrift_',
    'csrf_token' => true,
    'login_redirect' => '/',
    'system_pages' =>
    array(
        404 => '/views/errors/404.php',
        500 => '/views/errors/500.php',
    ),
    'custom_pages' =>
    array(
        'privacy' => '/views/privacy.php',
        'terms' => '/views/terms.php',
    ),
    'default_module' => 'home',
    'update_url' => '', // Optional: URL to check for updates
    'registration_enabled' => true,
    'modules' => $modulesConfig['modules'],
);
