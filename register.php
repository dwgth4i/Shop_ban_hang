<?php
require "database.php";

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $email = $_POST["email"];
    if (checkValid($conn, $username) && $confirm_password === $password) {
        $sql = "INSERT INTO users(name, password, email) VALUES ('$username', '$password', '$email')";
        $conn->query($sql);
        echo "Đăng kí thành công";
    } else {
        echo "Vui lòng chọn tên đăng nhập khác, tên đăng nhập này đã bị trùng hoặc mật khẩu xác nhận không đúng với mật khẩu";
    }
}

function checkValid($conn, $username) {
    $sql = "SELECT * FROM `users` WHERE name='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return false;
    } else {
        return true;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Trang đăng kí</title>
</head>
<body>
    <h1>Đăng kí</h1>
    <form action="register.php" method="POST">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" name="username" required><br><br>

        <label for="password">Mật khẩu:</label>
        <input type="password" name="password" required><br><br>

        <label for="confirm_password">Xác nhận mật khẩu:</label>
        <input type="password" name="confirm_password" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <input type="submit" value="Register">
    </form>
    <p><a href="index.php">Quay về trang đăng nhập</a></p>
</body>
</html>
