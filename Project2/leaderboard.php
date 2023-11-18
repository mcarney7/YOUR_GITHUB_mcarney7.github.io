<?php
session_start(); 

function generateLeaderboard() {
    $filename = 'scores.txt';
    if (!file_exists($filename) || filesize($filename) == 0) {
        
        return [];
    }
    
    $scores = file($filename);
    $scoreData = [];

    foreach ($scores as $scoreLine) {
        list($user, $score) = explode(',', trim($scoreLine));
        $user = htmlspecialchars($user);
        $scoreData[$user] = (int)$score;
    }

    arsort($scoreData); 
    return array_slice($scoreData, 0, 10, true); 
}

$leaderboard = generateLeaderboard();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login_img">
    <div class="container">
        <h1 class="specialText">Leaderboards</h1>
        <?php if (count($leaderboard) > 0): ?>
            <table id="alternate">
                <tr ><th>Rank</th><th>Player</th><th>Score</th></tr>
                <?php
                $rank = 1;
                foreach ($leaderboard as $username => $score) {
                    echo "<tr>
                            <td>{$rank}</td><td>{$username}</td>
                            <td>{$score}</td>
                        </tr>";
                    $rank++;
                }
                ?>
            </table>
        <?php else: ?>
            <p>Looks like no one wanted a million dollars!</p>
        <?php endif; ?><br><br><br><br>
        <a href="index.php" class="startButton">Menu</a><br>
        
        <a href="logout.php" class="startButton">Logout</a>
    </div>
</body>
</html>