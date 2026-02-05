<?php
namespace App\Controllers;
use App\View;
use App\App;
class AdminCreatedController
{
    public function index()
    {
        $config = require __DIR__ . '/../app/config.php';
        $view = new View($config);
        $data = [
            'title' => 'Admin User Created',
            'content' => 'Your admin account has been created successfully. You can now log in and start using Wordrift.',
            'site_name' => App::config('site_name')
        ];

        // Example: Conditionally render PHP or Twig view based on config
        // If Twig is enabled in config, render Twig template
        if (!empty($config['use_twig']) && $config['use_twig'] !== false && $config['use_twig'] !== 'false') {
            // Render Twig template (admin_created.twig)
            $view->render('admin_created.twig', $data);
        } else {
            // Render classic PHP view (admin_created.php) with theme support
            \App\App::loadView('admin_created', $data);
        }
    }

}
