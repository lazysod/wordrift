<?php
use App\Modules\Leaderboard\Controllers\LeaderboardController;

$router->get('/leaderboard', [LeaderboardController::class, 'index']);
