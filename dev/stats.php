<?php
// Simple stats script for Wordrift

// DB config
$db_host = 'localhost';
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
    // DEBUG: Only show for your user (replace 1 with your user_id if needed)
    if ($user_id == 1) {
        echo "<pre>\n--- DEBUG for $name (user_id=$user_id) ---\n";
    }
    // Games played
    $games = $mysqli->query("SELECT * FROM game_results WHERE user_id = $user_id AND mode = 'daily' ORDER BY game_date ASC");
    $played = $games->num_rows;
    $wins = 0;
    $losses = 0;
    $max_streak = 0;
    $current_streak = 0;
    $streak = 0;
    $last_date = null;
    $last_was_consecutive = false;
    $prev_date = null;


    if ($user_id == 1) {
        // Debug output for each game
    }
    while ($game = $games->fetch_assoc()) {
        if ($game['result'] === 'win') $wins++;
        if ($game['result'] === 'loss') $losses++;

        // Streak calculation by game_date
        if ($user_id == 1) {
            echo "Game date: {$game['game_date']}, Result: {$game['result']}, Streak: $streak, Max Streak: $max_streak\n";
        }
        if ($game['result'] === 'win') {
            if ($last_date) {
                $expected = date('Y-m-d', strtotime($last_date . ' +1 day'));
                if ($game['game_date'] === $expected) {
                    $streak++;
                    $last_was_consecutive = true;
                } else {
                    // streak broken, only update max if streak > 1
                    if ($streak > 1 && $streak > $max_streak) $max_streak = $streak;
                    $streak = 1;
                    $last_was_consecutive = false;
                }
            } else {
                $streak = 1;
                $last_was_consecutive = false;
            }
        } else {
            // streak broken, only update max if streak > 1
            if ($streak > 1 && $streak > $max_streak) $max_streak = $streak;
            $streak = 0;
            $last_was_consecutive = false;
        }
        $prev_date = $last_date;
        $last_date = $game['game_date'];
    }
    // After loop, check if the last streak is the max
    // Only update max streak at end if streak is at least 2 and the last two wins were consecutive days
    if (
        $streak > 1 &&
        $streak > $max_streak &&
        $prev_date &&
        $last_date &&
        (date('Y-m-d', strtotime($prev_date . ' +1 day')) === $last_date)
    ) {
        $max_streak = $streak;
    }
    if ($user_id == 1) {
        echo "Final Streak: $streak, Final Max Streak: $max_streak\n";
        echo "--- END DEBUG for $name ---\n</pre>";
        flush();
        // Optionally, exit here to only show debug for this user
        // exit;
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

