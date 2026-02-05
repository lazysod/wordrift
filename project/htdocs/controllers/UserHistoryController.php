<?php
namespace App\Controllers;

require_once __DIR__ . '/../app/DB.php';

class UserHistoryController
{
    public function index()
    {
        $config = require __DIR__ . '/../app/config.php';
        $db = new \App\DB($config);
        $sessionPrefix = $config['session_prefix'] ?? 'app_';
        $user_id = $_SESSION[$sessionPrefix . 'user_id'] ?? $_GET['id'] ?? null;
        if (!$user_id) {
            $history = [];
            $pagination = [];
            include __DIR__ . '/../views/user_history.php';
            return;
        }
        $perPage = 20;
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $offset = ($page - 1) * $perPage;
        $countSql = "SELECT COUNT(*) FROM game_results WHERE user_id = ? AND result = 'win'";
        $total = $db->fetch($countSql, [$user_id]);
        $totalRows = $total ? array_values($total)[0] : 0;
        $totalPages = ceil($totalRows / $perPage);
        $sql = "SELECT game_date, guesses, answer, guess_history, mode FROM game_results WHERE user_id = ? AND result = 'win' ORDER BY game_date DESC LIMIT $perPage OFFSET $offset";
        $history = $db->fetchAll($sql, [$user_id]);
        foreach ($history as &$row) {
            $mode = $row['mode'] ?? 'daily';
            $game_date = $row['game_date'];
            $sessionSql = "SELECT guesses_made FROM game_sessions WHERE user_id = ? AND game_date = ? AND mode = ? AND is_complete = 1 ORDER BY id DESC LIMIT 1";
            $session = $db->fetch($sessionSql, [$user_id, $game_date, $mode]);
            if ($session && !empty($session['guesses_made'])) {
                $guessesArr = json_decode($session['guesses_made'], true);
                $row['guessed_words'] = is_array($guessesArr) ? array_column($guessesArr, 'word') : [];
            } else {
                $row['guessed_words'] = [];
            }
        }
        unset($row);
        $pagination = [
            'current' => $page,
            'total' => $totalPages,
            'perPage' => $perPage
        ];
        include __DIR__ . '/../views/user_history.php';
    }
}
