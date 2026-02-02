<?php
// Example config file for Wordrift
// Copy to config.php and fill in your own values
// Only load db_conf.php if it exists
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
return array (
  'site_name' => 'Wordrift',
  'site_tagline' => 'The Word Guessing Game',
  'site_description' => 'Word Game based on Wordle.',
  'admin_email' => '', // your admin email
  'base_url' => '', // e.g. http://localhost:8888
  'dashboard_url' => '/admin/dashboard',
  'logo_small' => '/assets/images/logo_small.png',
  // Database configuration - this will be loaded from db_conf.php
  'db' => 
  array (
    'host' => $db_conf['db_host'],
    'username' => $db_conf['db_user'],
    'password' => $db_conf['db_pass'],
    'database' => $db_conf['db_name'],
  ),
    // Mail configuration
  'mail' => 
  array (
    'host' => '',
    'username' => '',
    'password' => '',
    'port' => 587,
    'encryption' => 'tls',
    'from_email' => '',
  ),
  'debug' => false,
  'timezone' => 'Europe/London',
  'session_lifetime' => 3600,
  'version' => '1.0.0',
  'maintenance_mode' => false,
  'allowed_ips' => array('127.0.0.1'),
  'theme' => 'wordle',
  'theme_path' => '/themes/wordle',
  'theme_config' => array(),
  'logo_url' => '/themes/default/assets/images/logo_small.png',
  'partials_path' => '/views/partials',
  'admin_views_path' => '/views/admin',
  'log_path' => __DIR__ . '/../storage/logs',
  'js_path' => '/js',
  'assets_path' => '/assets',
  'uploads_path' => '/storage/uploads',
  'prefix' => 'framework',
  'token_expiry' => 3600,
  'modules' => 
  array (
    'home' => 
    array (
      'enabled' => true,
      'suitable_as_default' => true,
    ),
    'user' => 
    array (
      'enabled' => true,
      'suitable_as_default' => false,
    ),
    'admin' => 
    array (
      'enabled' => true,
      'suitable_as_default' => false,
    ),
  ),
  'session_prefix' => 'app_',
  'csrf_token' => true,
  'login_redirect' => '/',
  'login_path' => '/user/login',
  'system_pages' => array(
    404 => '/views/errors/404.php',
    500 => '/views/errors/500.php',
  ),
  'custom_pages' => array(
    'privacy' => '/views/privacy.php',
    'terms' => '/views/terms.php',
  ),
  'default_module' => 'home',
);