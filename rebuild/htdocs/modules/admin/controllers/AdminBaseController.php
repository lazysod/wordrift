<?php
namespace App\Modules\Admin\Controllers;

// Base controller for admin modules to enforce admin authentication
class AdminBaseController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION[PREFIX . 'admin']) || $_SESSION[PREFIX . 'admin'] < 1) {
            header('Location: /admin/');
            exit;
        }
    }
}
