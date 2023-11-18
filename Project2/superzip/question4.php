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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $correctAnswer = "C";
    $selectedAnswer = isset($_POST["answer"]) ? $_POST["answer"] : "";

    if ($selectedAnswer == $correctAnswer) {
        $result = "Correct!";
        $score++;
      
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
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $selectedAnswer == $correctAnswer): ?>
            <form action="question5.php" method="post">
               
            <table>
                <caption class="question">In Greek mythology, who is the god of the sea?</caption>
                <tr class = "options">
                    <td class="option"><input type="radio" name="answer" value="A" required>A: Zeus</td>
                    <td class="option"><input type="radio" name="answer" value="B">B: Apollo</td>
                </tr>
                
                <tr class = "options">
                    <td class="option"><input type="radio" name="answer" value="C">C: Hades</td>
                    <td class="option"><input type="radio" name="answer" value="D">D: Poseidon</td>
                </tr>
                </table><br>
                <input type="hidden" name="score" value="<?php echo $score; ?>">
                <input type="submit" class = "button" value="Next Question">
            </form>
        <?php else: ?>
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