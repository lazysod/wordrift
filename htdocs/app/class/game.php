<?php
class game
{
    private $db;
    private $word;
    private $maxAttempts;
    private $currentAttempt;

    public function __construct($db, $word = '', $maxAttempts = 6)
    {
        $this->db = $db;
        $this->word = $word;
        $this->maxAttempts = $maxAttempts;
        $this->currentAttempt = 0;
    }

    public function isGameOver(): bool
    {
        return $this->currentAttempt >= $this->maxAttempts;
    }

    public function addGameResult($user_id, $game_date, $mode, $result, $guesses, $answer, $guess_history = null)
    {
        $db = $this->db;

        $game_date = date('Y-m-d', strtotime($game_date));
        $today = date('Y-m-d');
        if ($game_date > $today) {
            throw new Exception("game_date cannot be in the future. Received: $game_date");
        }

        $sql = "SELECT id FROM game_results WHERE user_id = ? AND game_date = ? AND mode = ?";
        $existing = $db->fetch($sql, [$user_id, $game_date, $mode]);

        // Set default streak values
        $max_streak = 0;
        $current_streak = 0;

        if ($existing) {
            $sql = "UPDATE game_results SET result = ?, guesses = ?, answer = ?, guess_history = ?, max_streak = ?, current_streak = ? WHERE id = ?";
            $db->query($sql, [
                $result,
                $guesses,
                strtoupper($answer),
                $guess_history,
                $max_streak,
                $current_streak,
                $existing['id']
            ]);
            return $existing['id'];
        }

        // Calculate streaks for daily and random modes
        if ($mode === 'daily' || $mode === 'random') {
            if ($mode === 'daily') {
                $sql = "SELECT game_date, result, current_streak, max_streak FROM game_results WHERE user_id = ? AND mode = 'daily' AND game_date < ? ORDER BY game_date DESC LIMIT 1";
                $prev = $db->fetch($sql, [$user_id, $game_date]);
                if ($result === 'win') {
                    if ($prev) {
                        $prev_date = $prev['game_date'];
                        $expected = date('Y-m-d', strtotime($game_date . ' -1 day'));
                        if ($prev['result'] === 'win' && $prev_date === $expected) {
                            $current_streak = (int)$prev['current_streak'] + 1;
                            // Only update max_streak if current_streak > previous max
                            if ($current_streak > (int)$prev['max_streak']) {
                                $max_streak = $current_streak;
                            } else {
                                $max_streak = (int)$prev['max_streak'];
                            }
                        } else {
                            $current_streak = 1;
                            // After a break, always set max_streak to previous max
                            $max_streak = (int)$prev['max_streak'];
                        }
                    } else {
                        // Only set max_streak to 1 if this is the very first win ever
                        $current_streak = 1;
                        $max_streak = 1;
                    }
                } else {
                    $current_streak = 0;
                    $max_streak = $prev ? (int)$prev['max_streak'] : 0;
                }
            } else if ($mode === 'random') {
                $sql = "SELECT result FROM game_results WHERE user_id = ? AND mode = 'random' ORDER BY created_at ASC";
                $res = $db->fetchAll($sql, [$user_id]);
                $results = array_map(function ($row) {
                    return $row['result'];
                }, $res);
                $prev_streak = 0;
                for ($i = count($results) - 1; $i >= 0; $i--) {
                    if ($results[$i] === 'win') {
                        $prev_streak++;
                    } else {
                        break;
                    }
                }
                if ($result === 'win') {
                    $current_streak = $prev_streak + 1;
                } else {
                    $current_streak = 0;
                }
                $max_streak = 0;
                $temp_streak = 0;
                foreach ($results as $r) {
                    if ($r === 'win') {
                        $temp_streak++;
                        if ($temp_streak > $max_streak) $max_streak = $temp_streak;
                    } else {
                        $temp_streak = 0;
                    }
                }
                if ($result === 'win') {
                    $temp_streak = $prev_streak + 1;
                    if ($temp_streak > $max_streak) $max_streak = $temp_streak;
                }
            }
        }

        $sql = "INSERT INTO game_results (user_id, game_date, mode, result, guesses, answer, guess_history, max_streak, current_streak)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $answer = strtoupper($answer);
        $db->query($sql, [
            $user_id,
            $game_date,
            $mode,
            $result,
            $guesses,
            $answer,
            $guess_history,
            $max_streak,
            $current_streak
        ]);
        return $db->insertId();
    }

    /**
     * Get leaderboard: top users by daily wins
     * @param int $limit
     * @return array
     */
    public function getLeaderboard($limit = 10)
    {
        $db = $this->db;
        $limit = (int)$limit;
        $sql = "SELECT u.id, u.display_name, COUNT(DISTINCT gr.game_date) as wins
                FROM game_results gr
                JOIN users u ON gr.user_id = u.id
                WHERE gr.mode = 'daily' AND gr.result = 'win'
                GROUP BY gr.user_id
                ORDER BY wins DESC, u.display_name ASC
                LIMIT $limit";
        $rows = $db->fetchAll($sql);
        return array_map(function ($row) {
            return [
                'user_id' => $row['id'],
                'display_name' => $row['display_name'],
                'wins' => (int)$row['wins']
            ];
        }, $rows);
    }

    /**
     * Get stats for a user and mode
     * @param int $user_id
     * @param string $mode
     * @return array
     */
    public function getUserStats($user_id, $mode = 'daily')
    {
        $db = $this->db;
        $sql = "SELECT COUNT(*) as played, SUM(result = 'win') as wins FROM game_results WHERE user_id = ? AND mode = ?";
        $row = $db->fetch($sql, [$user_id, $mode]);
        $streak = ($mode === 'daily') ? $this->getDailyStreak($user_id) : 0;
        $maxStreak = ($mode === 'daily') ? $this->getMaxDailyStreak($user_id) : 0;
        return [
            'played' => $row['played'],
            'wins' => $row['wins'],
            'streak' => $streak,
            'maxStreak' => $maxStreak
        ];
    }

    /**
     * Get the current daily win streak for a user.
     * Counts consecutive daily wins from the most recent backwards.
     * Ignores missing days (gaps do NOT break the streak).
     * @param int $user_id
     * @return int
     */
    public function getDailyStreak($user_id)
    {
        $db = $this->db;
        // Get the most recent daily game
        $sql = "SELECT game_date, result
                FROM game_results
                WHERE user_id = ? AND mode = 'daily'
                ORDER BY game_date DESC
                LIMIT 1";
        $latest = $db->fetch($sql, [$user_id]);
        if (!$latest || $latest['result'] !== 'win') {
            return 0;
        }

        // Now count consecutive wins backwards from the latest win
        $sql = "SELECT game_date
                FROM game_results
                WHERE user_id = ? AND mode = 'daily' AND result = 'win'
                GROUP BY game_date
                ORDER BY game_date DESC";
        $rows = $db->fetchAll($sql, [$user_id]);
        if (empty($rows)) return 0;
        $streak = 1;
        $last_date = $rows[0]['game_date'];
        for ($i = 1; $i < count($rows); $i++) {
            $expected = date('Y-m-d', strtotime($last_date . ' -1 day'));
            if ($rows[$i]['game_date'] === $expected) {
                $streak++;
                $last_date = $rows[$i]['game_date'];
            } else {
                break;
            }
        }
        return $streak;
    }

    /**
     * Public method to get current daily streak for a user.
     * @param int $user_id
     * @return int
     */
    public function dailyStreak($user_id)
    {
        return $this->getDailyStreak($user_id);
    }

    /**
     * Get the maximum daily win streak for a user.
     * @param int $user_id
     * @return int
     */
    public function getMaxDailyStreak($user_id)
    {
        $db = $this->db;
        $sql = "SELECT game_date, result FROM game_results WHERE user_id = ? AND mode = 'daily' ORDER BY game_date ASC";
        $rows = $db->fetchAll($sql, [$user_id]);
        $maxStreak = 0;
        $currentStreak = 0;
        $lastWinDate = null;
        foreach ($rows as $row) {
            if ($row['result'] === 'win') {
                if ($lastWinDate) {
                    $expected = date('Y-m-d', strtotime($lastWinDate . ' +1 day'));
                    if ($row['game_date'] === $expected) {
                        $currentStreak++;
                    } else {
                        $currentStreak = 1;
                    }
                } else {
                    $currentStreak = 1;
                }
                if ($currentStreak > $maxStreak) $maxStreak = $currentStreak;
                $lastWinDate = $row['game_date'];
            } else {
                $currentStreak = 0;
                $lastWinDate = null;
            }
        }
        return $maxStreak;
    }

    public function getDailyWord($date)
    {
        $db = $this->db;
        $startDate = new DateTime('2025-01-01');
        $currentDate = new DateTime($date);
        $offset = $startDate->diff($currentDate)->days;
        $offset = max(0, (int)$offset); // Always sanitize!

        $sql = "SELECT word FROM word_list ORDER BY word_id LIMIT 1 OFFSET $offset";
        $row = $db->fetch($sql);
        return $row ? $row['word'] : null;
    }
}
