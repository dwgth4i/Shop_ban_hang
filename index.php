<?php 
session_start();

if (isset($_SESSION["username"])) {
    header("Location: shopping.php");
    exit;
} 
?> 

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    
    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <a href="register.php">Chưa có tài khoản</a>
</body>
</html>
