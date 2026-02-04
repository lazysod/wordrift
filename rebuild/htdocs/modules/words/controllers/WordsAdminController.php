<?php
namespace App\Modules\Words\Controllers;

use App\Modules\Admin\Controllers\AdminBaseController;
use App\DB;

class WordsAdminController extends AdminBaseController
{
    public function export()
    {
        if (empty($_SESSION[PREFIX . 'admin']) || $_SESSION[PREFIX . 'admin'] < 1) {
            http_response_code(403);
            exit('Unauthorized');
        }
        if (!isset($_GET['csrf_token']) || $_GET['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
            http_response_code(400);
            exit('Invalid CSRF token');
        }
        global $config;
        $db = new DB($config);
        $words = $db->fetchAll("SELECT word FROM word_list ORDER BY word_id ASC");
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="word_list.csv"');
        $output = fopen('php://output', 'w');
        foreach ($words as $row) {
            fputcsv($output, [$row['word']]);
        }
        fclose($output);
        exit;
    }

    public function index()
    {
        global $config;
        $db = new DB($config);
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $perPage = 25;
        $offset = ($page - 1) * $perPage;
        $total = $db->fetch("SELECT COUNT(*) as cnt FROM word_list")['cnt'];
        $words = $db->fetchAll(
            "SELECT word_id, word FROM word_list ORDER BY word_id ASC LIMIT $perPage OFFSET $offset"
        );
        require __DIR__ . '/../views/words_list.php';
    }

    public function remove()
    {
        if (empty($_SESSION[PREFIX . 'admin']) || $_SESSION[PREFIX . 'admin'] < 1) {
            http_response_code(403);
            exit('Unauthorized');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['csrf_token']) && $_POST['csrf_token'] === ($_SESSION['csrf_token'] ?? '')) {
            global $config;
            $db = new DB($config);
            $db->query("DELETE FROM word_list WHERE word_id = ?", [intval($_POST['id'])]);
            header('Location: /admin/words');
            exit;
        } else {
            http_response_code(400);
            exit('Invalid request');
        }
    }

    public function upload()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv'])) {
            global $config;
            $db = new DB($config);
            $file = $_FILES['csv']['tmp_name'];
            $handle = fopen($file, 'r');
            $added = 0;
            $skipped = 0;
            while (($line = fgetcsv($handle)) !== false) {
                foreach ($line as $word) {
                    $word = strtolower(trim($word));
                    if (preg_match('/^[a-z]{3,5}$/', $word)) {
                        $exists = $db->fetch("SELECT word_id FROM word_list WHERE word = ?", [$word]);
                        if (!$exists) {
                            $db->query("INSERT INTO word_list (word) VALUES (?)", [$word]);
                            $added++;
                        } else {
                            $skipped++;
                        }
                    } else {
                        $skipped++;
                    }
                }
            }
            fclose($handle);
            $total = $db->fetch("SELECT COUNT(*) as cnt FROM word_list")['cnt'];
            $_SESSION['admin_words_msg_type'] = 'info';
            $_SESSION['admin_words_msg'] = "Upload complete: $added added, $skipped skipped. New total: $total.";
            header('Location: /admin/words');
            exit;
        }
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['word'])) {
            global $config;
            $db = new DB($config);
            $word = strtolower(trim($_POST['word']));
            if (preg_match('/^[a-z]{3,5}$/', $word)) {
                $exists = $db->fetch("SELECT word_id FROM word_list WHERE word = ?", [$word]);
                if (!$exists) {
                    $db->query("INSERT INTO word_list (word) VALUES (?)", [$word]);
                    $_SESSION['admin_words_msg_type'] = 'success';
                    $_SESSION['admin_words_msg'] = 'Word added!';
                } else {
                    $_SESSION['admin_words_msg_type'] = 'danger';
                    $_SESSION['admin_words_msg'] = 'Word already exists!';
                }
            } else {
                $_SESSION['admin_words_msg_type'] = 'danger';
                $_SESSION['admin_words_msg'] = 'Invalid word!';
            }
            header('Location: /admin/words');
            exit;
        }
    }

    public function deleteAll()
    {
        if (empty($_SESSION[PREFIX . 'admin']) || $_SESSION[PREFIX . 'admin'] < 1) {
            http_response_code(403);
            exit('Unauthorized');
        }
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' && 
            isset($_POST['confirm'], $_POST['csrf_token']) && 
            $_POST['confirm'] === 'yes' && 
            $_POST['csrf_token'] === ($_SESSION['csrf_token'] ?? '')
        ) {
            global $config;
            $db = new DB($config);
            $db->query("TRUNCATE TABLE word_list");
            $_SESSION['admin_words_msg_type'] = 'danger';
            $_SESSION['admin_words_msg'] = "All words deleted!";
            header('Location: /admin/words');
            exit;
        } else {
            http_response_code(400);
            exit('Invalid request');
        }
    }
}
