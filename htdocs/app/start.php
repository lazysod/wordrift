<?php
// Redirect to /install if db_conf.php does not exist and not already on /install or /app/install.php
if (!file_exists(__DIR__ . '/db_conf.php')) {
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    if (strpos($uri, '/install') === false && strpos($uri, '/app/install.php') === false) {
        header('Location: /install');
        exit;
    }
}
$config = isset($config) ? $config : (file_exists(__DIR__ . '/config.php') ? require __DIR__ . '/config.php' : []);

// Set timezone based on config entry
date_default_timezone_set($config['timezone'] ?? 'Europe/London');

// set session prefix for security
if (!defined('SESSION_PREFIX')) {
    define('PREFIX', $config['session_prefix'] ?? 'app_');
}

// Load Composer autoloader first (if present)
$composerAutoload = __DIR__ . '/../vendor/autoload.php';
if (file_exists($composerAutoload)) {
    include_once $composerAutoload;
}

// Start session for authentication and tokens
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set up autoloading for controllers, models, and app classes
spl_autoload_register(
    function ($class) {
        $paths = [
        __DIR__ . '/../controllers/' . $class . '.php',
        __DIR__ . '/../models/' . $class . '.php',
        __DIR__ . '/' . $class . '.php', // For app/App.php, Token.php, etc.
        __DIR__ . '/class/' . $class . '.php', // For app/class/TokenManager.php, etc.
        ];
        // Add all modules/*/controllers/ and modules/*/models/ paths
        $modulesDir = __DIR__ . '/../modules/';
        if (is_dir($modulesDir)) {
            foreach (glob($modulesDir . '*/controllers/' . $class . '.php') as $modController) {
                $paths[] = $modController;
            }
            foreach (glob($modulesDir . '*/models/' . $class . '.php') as $modModel) {
                $paths[] = $modModel;
            }
        }
        foreach ($paths as $file) {
            if (file_exists($file)) {
                include_once $file;
                return;
            }
        }
    }
);

// Set up global router
require_once __DIR__ . '/Router.php';
global $router;
if (!isset($router)) {
    $router = new Router();
}

$router->get('/install', function() {
    require __DIR__ . '/../views/install.php';
    exit;
});
$router->get('/create_admin', function() {
    require __DIR__ . '/../views/create_admin.php';
    exit;
});

$router->post('/create_admin', function() {
    require __DIR__ . '/../app/create_admin.php';
    exit;
});
// Register static routes for privacy and terms (after router is initialized)
$router->get('/privacy', function() {
    require __DIR__ . '/../views/privacy.php';
    exit;
});
$router->get('/terms', function() {
    require __DIR__ . '/../views/terms.php';
    exit;
});

$router->get('/admin_created', function() {
    require __DIR__ . '/../views/admin_created.php';
    exit;
});

// Register core admin routes
$router->get('/admin/modules', ['ModuleManagerController', 'index']);
$router->post('/admin/modules/update', ['ModuleManagerController', 'update']);
$router->get('/admin/dashboard/profile', ['AdminController', 'profile']);
$router->get('/admin', ['AdminController', 'index']);
$router->get('/admin/dashboard', ['AdminController', 'dashboard']);
$router->get('/admin/reset-password', ['AdminController', 'resetRequest']);
$router->post('/admin/reset-password', ['AdminController', 'resetRequest']);
$router->get('/admin/reset-password/confirm', ['AdminController', 'resetPassword']);
$router->post('/admin/reset-password/confirm', ['AdminController', 'resetPassword']);
$router->post('/admin/dashboard/profile', ['AdminController', 'profile']);

// Register admin links routes
if (isset($router) && $router instanceof Router) {
    $router->get('/admin/links', ['AdminLinksController', 'index']);
    $router->get('/admin/links/add', ['AdminLinksController', 'add']);
    $router->post('/admin/links/add', ['AdminLinksController', 'add']);
    $router->get('/admin/links/edit/{id}', ['AdminLinksController', 'edit']);
    $router->post('/admin/links/edit/{id}', ['AdminLinksController', 'edit']);
    $router->get('/admin/links/delete/{id}', ['AdminLinksController', 'delete']);
    $router->post('/admin/links/order', ['AdminLinksController', 'order']);
}

// Modular system loader: load routes for all enabled modules

$modulesDir = __DIR__ . '/../modules/';
if (is_dir($modulesDir)) {
    // Auto-detect modules
    $foundModules = [];
    foreach (scandir($modulesDir) as $modName) {
        if ($modName === '.' || $modName === '..' || !is_dir($modulesDir . $modName)) continue;
        $foundModules[$modName] = true;
    }
    // Sync with config['modules']
    if (!isset($config['modules'])) {
        $config['modules'] = $foundModules;
    } else {
        foreach ($foundModules as $modName => $enabled) {
            if (!array_key_exists($modName, $config['modules'])) {
                $config['modules'][$modName] = true;
            }
        }
        // Optionally, remove modules from config that no longer exist
        foreach ($config['modules'] as $modName => $enabled) {
            if (!isset($foundModules[$modName])) {
                unset($config['modules'][$modName]);
            }
        }
    }
    // Load routes for enabled modules
    global $router;
    foreach ($config['modules'] as $modName => $enabled) {
        if (!$enabled) continue;
        $routeFile = $modulesDir . $modName . '/routes.php';
        if (file_exists($routeFile)) {
            include $routeFile;
        }
    }
}

// Example: define app constants
define('APP_VERSION', '0.1.0');
// define('BASE_URL', '/htdocs/');

// Auto-generate a CSRF token for every user session
if (empty($_SESSION[PREFIX . 'csrf_token'])) {
    $_SESSION[PREFIX . 'csrf_token'] = Token::generate();
}
