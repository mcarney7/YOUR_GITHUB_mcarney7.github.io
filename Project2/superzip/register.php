<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPass = $_POST['confirmPass'];

    if ($password === $confirmPass) {
        $userData = "$username:$password\n";
        file_put_contents('loginInfo.txt', $userData, FILE_APPEND);

        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $username;
        header('Location: login.php');
        exit;
    } else {
        $error = "Passwords do not match. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login_img">
    <div class="container">
        <h1>Sign Up</h1>
        <form action="register.php" method="post" class="center">
            <label for="username" class="labels">Username:</label>
            <input type="text" size="18" id="username" name="username" required><br><br>
            <label for="password" class="labels">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <label for="confirmPass" class="labels">Confirm Password:</label>
            <input type="password" id="confirmPass" name="confirmPass" required><br>
            <input type="submit" value="Register" class="center"><br>
        </form>
        <?php echo $error; ?> <br><br>
        <p>Already have an account?<br> <a href="login.php" class="loginButton">Login</a></p>
    </div>
</body>
</html>