<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Who Wants to Be a Millionaire</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login_img">
    <div class="container">
        <h1>Who Wants to Be a Millionaire</h1><br>
        <?php
        if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
            echo "<h3 id='rainbowText'>Welcome, {$_SESSION['username']}!<br><br><br></h3>";
            echo '<a href="question1.php" class="startButton">Start</a>';
            echo '<a href="leaderboard.php" class="startButton">Leaderboard</a>';
            echo '<a href="logout.php" class="startButton">Logout</a>';
        } else {
            echo '<a href="login.php">Login</a>';
            echo '<a href="register.php">Register</a>';
        }
        ?>
    </div>
</body>
</html>
