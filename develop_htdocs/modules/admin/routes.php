<?php
// Admin User Management Routes
$router->get('/admin/users', ['UserAdminController', 'index']);
$router->get('/admin/users/add', ['UserAdminController', 'add']);
$router->post('/admin/users/add', ['UserAdminController', 'add']);
$router->get('/admin/users/edit/{id}', ['UserAdminController', 'edit']);
$router->post('/admin/users/edit/{id}', ['UserAdminController', 'edit']);
$router->get('/admin/users/suspend/{id}', ['UserAdminController', 'suspend']);
$router->get('/admin/users/unsuspend/{id}', ['UserAdminController', 'unsuspend']);
$router->get('/admin/users/delete/{id}', ['UserAdminController', 'delete']);
// 
$router->get('/admin/words', ['WordsAdminController', 'index']);
$router->post('/admin/words/remove', ['WordsAdminController', 'remove']);
$router->post('/admin/words/upload', ['WordsAdminController', 'upload']);
$router->post('/admin/words/add', ['WordsAdminController', 'add']);
$router->post('/admin/words/deleteall', ['WordsAdminController', 'deleteAll']);
$router->get('/admin/words/export', ['WordsAdminController', 'export']);