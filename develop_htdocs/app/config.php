<?php
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
// main config array
return array(
    'site_name' => 'Wordrift',
    'site_tagline' => 'The Word Guessing Game',
    'site_description' => 'Excisting Word Game based on the famous Wordle. Powered by the Strata Framework',
    'admin_email' => 'noreply@albaweb.net',
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
    
    // Mail configuration
    'mail' =>
    array(
      'host' => $mail_conf['host'],
      'username' => $mail_conf['username'],
      'password' => $mail_conf['password'],
      'port' => $mail_conf['port'],
      'encryption' => $mail_conf['encryption'],
      'from_email' => $mail_conf['from_email'],
    ),
    'debug' => true,
    'timezone' => 'Europe/London',
    'session_lifetime' => 3600,
    'version' => '1.0.0',
    'maintenance_mode' => false,
    'allowed_ips' =>
    array(
      0 => '127.0.0.1',
    ),
    'theme' => 'wordle',
    'theme_path' => '/themes/wordle',
    'theme_config' =>
    array(
      'name' => 'Wordle Theme',
      'author' => 'Lazysod',
      'version' => '1.0',
      'logo' => '/assets/images/logo_small.png',
      'favicon' => '/assets/images/favicon.ico',
      'css' => '/css/styles.css',
      'js' => '/js/scripts.js',
    ),
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
    array(
      'home' =>
      array(
        'enabled' => true,
        'suitable_as_default' => true,
      ),
      'user' =>
      array(
        'enabled' => true,
        'suitable_as_default' => false,
      ),
      'admin' =>
      array(
        'enabled' => true,
        'suitable_as_default' => false,
      ),
    ),
    'session_prefix' => 'app_',
    'csrf_token' => true,
    'login_redirect' => '/',
    'login_path' => '/user/login',
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
    'cookie_banner_enabled' => true,
    'cookie_banner_text' => 'This website uses cookies to ensure you get the best experience.',
    'default_module' => 'home',
  );
