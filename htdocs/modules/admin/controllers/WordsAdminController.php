<?php

class WordsAdminController
{
    public function index()
    {
        // require_once __DIR__ . '/../view/admin_header.php';
        global $config;
        $db = new DB($config);
        
        // Pagination setup
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $perPage = 25;
        $offset = ($page - 1) * $perPage;

        // Fetch words
        $total = $db->fetch("SELECT COUNT(*) as cnt FROM word_list")['cnt'];
        $words = $db->fetchAll(
            "SELECT word_id, word FROM word_list ORDER BY word_id ASC LIMIT $perPage OFFSET $offset"
        );

        require __DIR__ . '/../views/words_list.php';

        // require_once __DIR__ . '/../view/admin_footer.php';
    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            global $config;
            $db = new DB($config);
            $db->query("DELETE FROM word_list WHERE word_id = ?", [intval($_POST['id'])]);
            header('Location: /admin/words');
            exit;
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
                // Prevent duplicates
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
            global $config;
            $db = new DB($config);
            $db->query("TRUNCATE TABLE word_list");
            $_SESSION['admin_words_msg_type'] = 'danger';
            $_SESSION['admin_words_msg'] = "All words deleted!";
            header('Location: /admin/words');
            exit;
        }
    }
}