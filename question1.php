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


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $score = 0; 
} else {
    
    $score = isset($_SESSION["score"]) ? $_SESSION["score"] : 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correctAnswer = "C"; 
    $selectedAnswer = isset($_POST["answer"]) ? $_POST["answer"] : "";

    if ($selectedAnswer == $correctAnswer) {
        $score++; 
        $_SESSION["score"] = $score;
        header('Location: question2.php'); 
        exit;
    } else {
        if (isset($_SESSION['username'])) {
            updateScore($_SESSION['username'], $score); 
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Who Wants to Be a Millionaire</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="questions_img">
    <div class="container">
        <h1>Who Wants to Be a Millionaire</h1><br>
        <?php if ($_SERVER["REQUEST_METHOD"] == "GET" || $selectedAnswer != $correctAnswer): ?>
            <form action="question2.php" method="post">
                
            <table>
                <caption class="question">Which of these is a famous painting by Leonardo da Vinci?</caption>
                <tr class = "options">
                    <td class="option"><input type="radio" name="answer" value="A" required>A: Starry Night</td>
                    <td class="option"><input type="radio" name="answer" value="B">B: The Persistence of Memory</td>
                </tr>
                
                <tr class = "options">
                    <td class="option"><input type="radio" name="answer" value="C">C: The Last Supper</td>
                    <td class="option"><input type="radio" name="answer" value="D">D: Guernica</td>
                </tr>
                </table><br>
                <input type="hidden" name="score" value="<?php echo $score; ?>">
                <input type="submit" class = "button" value="Next Question">
            </form>
        <?php else: ?>
            
        <?php endif; ?>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $selectedAnswer != $correctAnswer): ?>
            <div class="scorePage">
                Wrong answer. Try again!<br>
                Your Score is: <?php echo $score; ?><br>
                <a href="index.php" class="startButton">Retry</a><br>
                <a href="leaderboard.php" class="startButton">Leaderboard</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

