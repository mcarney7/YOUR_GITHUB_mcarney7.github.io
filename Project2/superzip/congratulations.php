<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Who Wants to Be a Millionaire</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login_img">
 
<?php
session_start(); 

function updateScore($username, $newScore) {
    $filename = 'scores.txt';
    $scores = file_exists($filename) ? file($filename) : [];
    $scoreData = [];


    foreach ($scores as $scoreLine) {
        list($user, $score) = explode(',', trim($scoreLine));
        
        $user = filter_var($user, FILTER_SANITIZE_STRING);
        $scoreData[$user] = (int)$score;
    }


    
    if (!isset($scoreData[$username]) || $newScore > $scoreData[$username]) {
        $scoreData[$username] = $newScore;
    }


    
    $scoreLines = [];
    foreach ($scoreData as $user => $score) {
        $scoreLines[] = "$user,$score\n";
    }


    file_put_contents($filename, implode('', $scoreLines));
}

$score = isset($_POST["score"]) ? $_POST["score"] : 0;
$isCorrect = false; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correctAnswer = "D"; 
    $selectedAnswer = isset($_POST["answer"]) ? $_POST["answer"] : "";

    if ($selectedAnswer == $correctAnswer) {
        $score ++;
        $isCorrect = true; 
        if (isset($_SESSION['username'])) {
            updateScore($_SESSION['username'], $score);
        }
        ?>
	<div class="firework" style="top: 50%; left: 50%;"></div>
    <div class="firework" style="top: 30%; left: 40%;"></div>
    <div class="firework" style="top: 70%; left: 70%;"></div>
    <div class="firework" style="top: 20%; left: 80%;"></div>
	<div class="firework" style="top: 50%; left: 50%;"></div>
    <div class="firework" style="top: 30%; left: 40%;"></div>
    <div class="firework" style="top: 70%; left: 70%;"></div>
    <div class="firework" style="top: 20%; left: 80%;"></div>
	<div class="firework" style="top: 50%; left: 50%;"></div>
    <div class="firework" style="top: 30%; left: 40%;"></div>
    <div class="firework" style="top: 70%; left: 70%;"></div>
    <div class="firework" style="top: 20%; left: 80%;"></div>
	<div class="firework" style="top: 50%; left: 50%;"></div>
    <div class="firework" style="top: 30%; left: 40%;"></div>
    <div class="firework" style="top: 70%; left: 70%;"></div>
    <div class="firework" style="top: 20%; left: 80%;"></div>
	<div class="firework" style="top: 70%; left: 70%;"></div>
    <div class="firework" style="top: 40%; left: 90%;"></div>
	<div class="firework" style="top: 50%; left: 50%;"></div>
    <div class="firework" style="top: 30%; left: 40%;"></div>
    <div class="firework" style="top: 70%; left: 70%;"></div>
    <div class="firework" style="top: 60%; left: 80%;"></div>
	
	<div class="fade-in-text">
		Congratulations! You Are A Millionaire!
	</div> <br><br><br>

    <a href="leaderboard.php" class="button">Go To Leaderboard</a> 

    <?php
    } else {
        if (isset($_SESSION['username'])) {
            updateScore($_SESSION['username'], $score);
        }
    }
}
?>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !$isCorrect): ?>
        <div class="container">
        <h1>Who Wants to Be a Millionaire</h1><br>
            <div class="scorePage">
                Wrong answer. Try again!<br>
                Your Score is: <?php echo $score; ?><br>
                <a href="index.php" class="startButton">Retry</a><br>
                <a href="leaderboard.php" class="startButton">Leaderboard</a>
            </div>
        </div>
        <?php endif; ?>
    
</body>
</html>