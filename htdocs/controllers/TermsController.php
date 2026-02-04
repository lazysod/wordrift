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
            'title' => 'Terms & Conditions',
            'content' => 'Edit this page at /htdocs/views/terms.php',
            'site_name' => App::config('site_name')
        ];
        if (!empty($config['use_twig']) && $config['use_twig'] !== false && $config['use_twig'] !== 'false') {
            $view->render('terms.twig', $data);
        } else {
            \App\App::loadView('terms', $data);
        }
    }
}
