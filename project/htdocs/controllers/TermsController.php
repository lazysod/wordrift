<?php
namespace App\Controllers;
use App\View;
use App\App;
class TermsController
{
    public function index()
    {
        $config = require __DIR__ . '/../app/config.php';
        $view = new View($config);
        $data = [
            'title' => 'Terms and Conditions',
            'content' => 'We are a modern PHP framework company.',
            'site_name' => App::config('site_name')
        ];

        // Example: Conditionally render PHP or Twig view based on config
        // If Twig is enabled in config, render Twig template
        if (!empty($config['use_twig']) && $config['use_twig'] !== false && $config['use_twig'] !== 'false') {
            // Render Twig template (terms.twig)
            $view->render('terms.twig', $data);
        } else {
            // Render classic PHP view (terms.php) with theme support
            App::loadView('terms', $data);
        }
    }

}
    