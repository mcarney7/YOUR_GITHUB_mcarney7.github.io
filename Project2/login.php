<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userFile = file('loginInfo.txt', FILE_IGNORE_NEW_LINES);
    
    foreach ($userFile as $line) {
        list($storedUsername, $storedPassword) = explode(':', $line);
        if ($username === $storedUsername && $password === $storedPassword) {
            $_SESSION['authenticated'] = true;
            $_SESSION['username'] = $username;
            header('Location: index.php'); 
            exit;
        }
    }

    $error = "Invalid Username or Password";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login_img">
    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="post" class="center">
            <label for="username" class="labels">Username:</label>
            <input type="text" id="username" name="username" required> <br><br><br>
            <label for="password" class="labels">Password:</label>
            <input type="password" id="password" name="password" required> <br>
            <input type="submit" value="Login" class="center"><br><br>
        </form>
        <?php echo $error; ?> <br> <br>
        <p>Don't Have an Account?<br><a href="register.php" class="registerButton">Register</a></p>
    </div>
</body>
</html>

