<?php
use App\Modules\UserHistory\Controllers\UserHistoryController;

$router->get('/userhistory', [UserHistoryController::class, 'index']);
