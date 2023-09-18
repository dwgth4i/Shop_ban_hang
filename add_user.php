<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}

require "database.php";

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $sql = "SELECT * FROM `users` WHERE name='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "Có người dùng tên này rồi, tên khác đi bro!!";
    } else {
        $sql = "INSERT INTO users(name,password,email) VALUE ('$username','$password','$email')";
        $conn->query($sql);
        echo "Người dùng $username đã được add <3";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm người dùng</title>
</head>
<body>
    <form action="add_user.php" method="POST">Thêm người dùng
        <label for="username">Tài khoản: </label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Mật khẩu: </label>
        <input type="password" id="password" name="password" required><br>
        <label for="email">Email: </label>
        <input type="email" id="email" name="email">
        <input type="submit" value="Login">
    </form>
    <p><a href="admin_panel.php">Quay về trang admin</a></p>
</body>
</html>