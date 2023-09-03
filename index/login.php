<?php
require 'database.php';
session_start();

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query to fetch user data
    $sql = "SELECT * FROM users WHERE name = '$username' AND password = '$password'";
    $result = $conn->query($sql);

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
    <title>Login Result</title>
</head>
<body>
    <h1>Login Result</h1>
    <?php if(isset($error_message)) { echo "<p>$error_message</p>"; } ?>
    <p><a href="index.html">Go back to Login</a></p>
</body>
</html>
