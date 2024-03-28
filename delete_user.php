<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}

require "database.php";

$sql = "SELECT id, name, email FROM `users`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $uid = $row["id"];
        echo "ID: " . $row["id"] . "<br>";
        echo "Username: " . $row["name"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
        echo "<br>";

        if ($uid === 1) {
            echo "Xoá hộ";
        } else {
            echo "<form action='delete_user.php' method='POST'>";
            echo "<input type='hidden' name='delete_user' value='$uid'>";
            echo "<input type='submit' value='Xóa người dùng'>";
            echo "</form>";
        }

        echo "<hr>";
    }
} else {
    echo "Có user nào đâu mà xóa bro";
}

if (isset($_POST["delete_user"])) {
    $uid = intval($_POST["delete_user"]);

    if ($uid === 1) {
        echo "Vkl ai lại đi xóa admin ୧༼ಠ益ಠ༽୨";
    } else {

        $sql = "DELETE FROM `users` WHERE id = ?";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("i", $uid);

        if ($stmt->execute()) {
            echo "Đã xóa user có ID: $uid";
            header("Location: delete_user.php");
            exit();
        } else {
            echo "Có lỗi xảy ra khi xóa user. Vui lòng thử lại sau.";
        }
    }
}

?>


<html><body>
<p><a href="admin_panel.php">Quay về trang admin</a></p>
</body></html>
