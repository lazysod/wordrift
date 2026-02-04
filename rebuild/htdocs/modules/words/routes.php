<?php
// Modular Words Admin Routes
$router->get('/admin/words', ['App\\Modules\\Words\\Controllers\\WordsAdminController', 'index']);
$router->post('/admin/words/remove', ['App\\Modules\\Words\\Controllers\\WordsAdminController', 'remove']);
$router->post('/admin/words/upload', ['App\\Modules\\Words\\Controllers\\WordsAdminController', 'upload']);
$router->post('/admin/words/add', ['App\\Modules\\Words\\Controllers\\WordsAdminController', 'add']);
$router->post('/admin/words/deleteall', ['App\\Modules\\Words\\Controllers\\WordsAdminController', 'deleteAll']);
$router->get('/admin/words/export', ['App\\Modules\\Words\\Controllers\\WordsAdminController', 'export']);
