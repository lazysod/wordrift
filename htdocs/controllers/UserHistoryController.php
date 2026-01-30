<?php
class UserHistoryController
{
    public function index()
    {
        require_once __DIR__ . '/../app/class/DB.php';
        $config = include __DIR__ . '/../app/config.php';
        $db = new DB($config);

        // Get user ID from session or query param
        $user_id = $_SESSION[PREFIX . 'user_id'] ?? $_GET['id'] ?? null;
        if (!$user_id) {
            $history = [];
            $pagination = [];
            include __DIR__ . '/../views/user_history.php';
            return;
        }

        // Pagination setup
        $perPage = 20;
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $offset = ($page - 1) * $perPage;

        // Get total count
        $countSql = "SELECT COUNT(*) FROM game_results WHERE user_id = ? AND result = 'win'";
        $total = $db->fetch($countSql, [$user_id]);
        $totalRows = $total ? array_values($total)[0] : 0;
        $totalPages = ceil($totalRows / $perPage);

        // Fetch paginated results
        $sql = "SELECT game_date, guesses, answer, guess_history 
            FROM game_results 
            WHERE user_id = ? AND result = 'win'
            ORDER BY game_date DESC
            LIMIT $perPage OFFSET $offset";
        $history = $db->fetchAll($sql, [$user_id]);

        // Pagination info for view
        $pagination = [
            'current' => $page,
            'total' => $totalPages,
            'perPage' => $perPage
        ];

        include __DIR__ . '/../views/user_history.php';
    }
}