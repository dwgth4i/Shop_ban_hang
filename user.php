<?php
session_start();


if (!isset($_SESSION["username"])) {
    header("Location: index.html");
    exit;
}

require 'database.php';

if(isset($_POST["old_password"]) && isset($_POST["new_password"])) {
    $username = $_SESSION["username"];
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];

    $sql = "SELECT * FROM `users` WHERE name='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
    if ($row["password"] === $_POST["old_password"]) {
        $conn->query("UPDATE `users` SET password='$new_password' WHERE name='$username'");
        echo "Oke bro đã đổi mật khẩu";
    } else {
        echo "nah vigga wrong password";
    }

}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
</head>
<body>
    <form action="user.php" method="post">Thay đổi mật khẩu
    <label for="old_password">Mật khẩu cũ: </label>
    <input type="password" name="old_password" required>
    <label for="new_password">Mật khẩu mới: </label>
    <input type="password" name="new_password" required>
    <input type="submit" value="Oke luôn!!">
    </form>

    
</body>
</html>
