<?php
// Simple stats script for Wordrift

// DB config
$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = 'root';
$db_name = 'awordgame';

// Connect to DB
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Get all users
$users = [];
$res = $mysqli->query("SELECT id, display_name FROM users");
while ($row = $res->fetch_assoc()) {
    $users[$row['id']] = $row['display_name'];
}

// Get stats for each user
echo "<h2>Wordrift Stats</h2>";
echo "<table border='1' cellpadding='6'><tr><th>User</th><th>Games Played</th><th>Wins</th><th>Losses</th><th>Current Streak</th><th>Max Streak</th></tr>";

foreach ($users as $user_id => $name) {
    // Games played
    $games = $mysqli->query("SELECT * FROM game_results WHERE user_id = $user_id AND mode = 'daily' ORDER BY game_date ASC");
    $played = $games->num_rows;
    $wins = 0;
    $losses = 0;
    $max_streak = 0;
    $current_streak = 0;
    $streak = 0;
    $last_date = null;

    while ($game = $games->fetch_assoc()) {
        if ($game['result'] === 'win') $wins++;
        if ($game['result'] === 'loss') $losses++;

        // Streak calculation by game_date
        if ($game['result'] === 'win') {
            if ($last_date) {
                $expected = date('Y-m-d', strtotime($last_date . ' +1 day'));
                if ($game['game_date'] === $expected) {
                    $streak++;
                } else {
                    $streak = 1;
                }
            } else {
                $streak = 1;
            }
            if ($streak > $max_streak) $max_streak = $streak;
        } else {
            $streak = 0;
        }
        $last_date = $game['game_date'];
    }
    $current_streak = $streak;

    echo "<tr>
        <td>" . htmlspecialchars($name) . "</td>
        <td>$played</td>
        <td>$wins</td>
        <td>$losses</td>
        <td>$current_streak</td>
        <td>$max_streak</td>
    </tr>";
}
echo "</table>";

$mysqli->close();

