<?php
require "database.php";
include "validation.php";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $enc_password = md5($password);
    if (!validation($username,$password)) {
        header("Location: youcantdoshit.php");
        exit;
    }

    $stmt = $conn->prepare("SELECT username,password FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $enc_password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if ($row["username"] === "admin"){
            session_start();
            $_SESSION["admin"] = true;
            header("Location: admin_panel.php");
            exit;
        }
    }
    echo "Đã bảo là chỉ admin rồi!!!";
} 
?>



<!DOCTYPE html>
<html>
<head>
    <title>Trang của admin</title>
</head>
<body>
    <h1>Chỉ admin mới vào được</h1>
    
    <form action="admin.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
