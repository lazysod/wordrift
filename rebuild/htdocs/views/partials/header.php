
<?php
// Ensure Composer autoloader is loaded so App class is available
if (file_exists(__DIR__ . '/../../vendor/autoload.php')) {
    require_once __DIR__ . '/../../vendor/autoload.php';
}
$config = include __DIR__ . '/../../app/config.php';

if( $config['debug'] === true){
    // Show all errors for debugging
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

// Safe checks for required variables
if (!class_exists('App\\App')) {
    echo '<div class="alert alert-danger">App class not found.</div>';
    exit;
}
if (!defined('PREFIX')) {
    define('PREFIX', ''); // fallback
}
if (!isset($_SESSION)) {
    session_start();
}
if (!file_exists(__DIR__ . '/../../app/navConfig.php')) {
    echo '<div class="alert alert-danger">navConfig.php missing.</div>';
    exit;
}

$controllersDir = __DIR__ . '/../../controllers/';
$controllerFiles = glob($controllersDir . '*Controller.php');
$navConfig = include __DIR__ . '/../../app/navConfig.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php include('meta.php'); 
    ?>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Font Awesome for link icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="/themes/wordrift/css/styles.css" rel="stylesheet" />
    <link href="/themes/wordrift/css/custom.css" rel="stylesheet" />
        <main class="flex-shrink-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container px-5">
                    <a class="navbar-brand" href="/" id="logo"><img src="<?php echo \App\App::config('theme_path')?>/images/logo.png" alt="Word Rift" class="img-fluid" /></a>
                    <a href="/" id="logo-mobile"><img src="<?php echo \App\App::config('theme_path')?>/images/mobile_logo.png" alt="Word Rift" class="img-fluid" /></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <?php
                        if (!isset($showNav)) { $showNav = true;
                        }
                        if ($showNav) {
                            foreach ($navConfig as $key => $config) {
                                // Only show Contact if module is enabled
                                if (strtolower($key) === 'contact' && empty(\App\App::config('modules')['contact'])) { continue;
                                }
                                if (!($config['show'] ?? true)) { continue;
                                }
                                $label = $config['label'] ?? $key;
                                $url = $config['url'] ?? ('/' . strtolower($key));
                                $currentPath = '/' . trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
                                if ($currentPath === '/') { $currentPath = '/';
                                }
                                
                                if (!empty($config['children'])) {
                                    $active = ($url === $currentPath) ? ' class="active nav-item dropdown"' : ' class=" nav-item dropdown"';
                                    echo '<li' . $active . '>';
                                    $slug = \App\App::stripSpaces($label);
                                    echo '<a class="nav-link dropdown-toggle" href="' . $url . '" id="navbarDropdown' . $slug . '" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $label . '</a>';
                                    echo '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown' . $slug . '">';
                                    foreach ($config['children'] as $childKey => $child) {
                                        // Only show Contact child if module is enabled
                                        if (strtolower($childKey) === 'contact' && empty(\App\App::config('modules')['contact'])) { continue;
                                        }
                                        if (!($child['show'] ?? true)) { continue;
                                        }
                                        $childLabel = $child['label'] ?? $childKey;
                                        $childUrl = $child['url'] ?? ($url . '/' . strtolower($childKey));
                                        $childActive = ($childUrl === $currentPath) ? ' class="active"' : 'class="nav-item dropdown"';
                                        echo '<li' . $childActive . '><a href="' . $childUrl . '" class="dropdown-item">' . $childLabel . '</a></li>';
                                    }
                                    echo '</ul>';
                                }else{
                                    $new_tab = ($config['new_tab']) ? 'target="_blank"' : '';
                                    $active = ($url === $currentPath) ? 'active' : '';
                                    echo '<li class="nav-item ">';
                                    echo '<a class="nav-link ' . $active . '" href="' . $url . '" ' . $new_tab . '>' . $label . '</a>';
                                }
                                echo '</li>';
                            }
                            ?>
                            <?php if (!empty(\App\App::config('modules')['user'])) : ?>
                                <?php if (!empty($_SESSION[PREFIX . 'user_id'])) : ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($_SESSION[PREFIX . 'first_name'] ?? 'User'); ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <?php if(isset($_SESSION[PREFIX . 'admin']) && $_SESSION[PREFIX . 'admin'] > 0 ) : ?>
                                        <li><a class="dropdown-item" href="/admin">Admin Panel</a></li>
                                        <?php endif; ?>
                                        <?php if (!empty(\App\App::config('modules')['user'])) : ?>
                                        <li><a class="dropdown-item" href="/user/profile">Profile</a></li>
                                        <li><a class="dropdown-item" href="/user/sessions">Sessions</a></li>
                                        <?php elseif (isset($_SESSION[PREFIX . 'admin']) && $_SESSION[PREFIX . 'admin'] > 0) : ?>
                                        <li><a class="dropdown-item" href="<?php echo \App\App::config('base_url'); ?>/admin/dashboard/profile">Profile</a></li>
                                        <?php endif; ?>
                                        <li><a class="dropdown-item" href="/logout.php">Logout</a></li>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <li class="nav-item"><a class="nav-link" href="/user/login">Login</a></li>
                                <li class="nav-item"><a class="nav-link" href="/user/register">Register</a></li>
                            <?php endif; ?>
                            <?php endif; ?>
                        <?php } ?>
                    </ul>
                    </div>
                </div>
            </nav>