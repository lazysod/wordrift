<?php
namespace App\Controllers;
use App\View;
use App\App;
class PrivacyController
{
    public function index()
    {
        $config = require __DIR__ . '/../app/config.php';
        $view = new View($config);
        $data = [
            'title' => 'Privacy',
            'content' => 'We are a modern PHP framework company.',
            'site_name' => App::config('site_name')
        ];

        // Example: Conditionally render PHP or Twig view based on config
        // If Twig is enabled in config, render Twig template
        if (!empty($config['use_twig']) && $config['use_twig'] !== false && $config['use_twig'] !== 'false') {
            // Render Twig template (privacy.twig)
            $view->render('privacy.twig', $data);
        } else {
            // Render classic PHP view (privacy.php) with theme support
            App::loadView('privacy', $data);
        }
    }

}
    