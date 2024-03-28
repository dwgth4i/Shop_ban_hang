<?php
require 'database.php';
include 'validation.php';
session_start();

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $enc_password = md5($password);
    if (!validation($username,$password)) {
        header("Location: youcantdoshit.php");
        exit;
    };

    $sql = "SELECT username,password FROM users WHERE username =? AND password =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $enc_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION["username"] = $username;
            header("Location: shopping.php");
            exit;
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "Username not found.";
    }


?>

<!DOCTYPE html>
<html>
<head>
    <title>Đang đăng nhập ...</title>
</head>
<body>
    <h1>Kết quả đăng nhập</h1>
    <?php if(isset($error_message)) { echo "<p>$error_message</p>"; } ?>
    <p><a href="index.php">Quay về trang đăng nhập</a></p>
</body>
</html>
