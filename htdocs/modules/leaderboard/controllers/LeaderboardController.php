<?php
namespace App\Modules\Leaderboard\Controllers;

use App\DB;
use game;

class LeaderboardController
{
    public function index()
    {
        require_once dirname(__DIR__, 3) . '/app/game.php';
        global $config;
        $db = new DB($config);
        $sql = "SELECT DISTINCT u.id, u.display_name FROM users u JOIN game_results gr ON gr.user_id = u.id ORDER BY u.display_name ASC";
        $users = $db->fetchAll($sql);
        $game = new \game($db);
        $leaderboard = [];
        foreach ($users as $i => $user) {
            try {
                $daily = $game->getUserStats($user['id'], 'daily');
                $random = $game->getUserStats($user['id'], 'random');
            } catch (\Exception $e) {
                $daily = $random = [
                    'played' => 0,
                    'wins' => 0,
                    'streak' => 0,
                    'maxStreak' => 0
                ];
            }
            $leaderboard[] = [
                'rank' => $i + 1,
                'user' => $user['display_name'],
                'daily' => $daily,
                'random' => $random
            ];
        }
        usort($leaderboard, function($a, $b) {
            if ($a['daily']['wins'] !== $b['daily']['wins']) {
                return $b['daily']['wins'] - $a['daily']['wins'];
            }
            if ($a['daily']['streak'] !== $b['daily']['streak']) {
                return $b['daily']['streak'] - $a['daily']['streak'];
            }
            return $b['daily']['maxStreak'] - $a['daily']['maxStreak'];
        });
        $leaderboard = array_slice($leaderboard, 0, 10);
        include __DIR__ . '/../views/leaderboard.php';
    }
}
