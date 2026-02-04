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
            'title' => 'Privacy Policy',
            'content' => 'Edit this page at /htdocs/views/privacy.php',
            'site_name' => App::config('site_name')
        ];
        if (!empty($config['use_twig']) && $config['use_twig'] !== false && $config['use_twig'] !== 'false') {
            $view->render('privacy.twig', $data);
        } else {
            \App\App::loadView('privacy', $data);
        }
    }
}
