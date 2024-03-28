<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel</h1>
    
    <h2>Chức năng của chúa!!</h2>
    <ul>
        <li><a href="add_user.php">Thêm người dùng</a></li>
        <li><a href="delete_user.php">Xóa người dùng</a></li>
        <li><a href="add_product.php">Thêm sản phẩm</a></li>
        <li><a href="delete_product.php">Xóa sản phẩm</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

    <?php
    if (isset($_GET["function"])) {
        $function = $_GET["function"];

        switch ($function) {
            case "add_user":
                include "add_user.php";
                break;
            case "delete_user":
                include "delete_user.php";
                break;
            case "add_product":
                include "add_product.php";
                break;
            case "delete_product":
                include "delete_product.php";
                break;
            case "list_orders":
                include "list_orders.php";
                break;
            default:
                echo ".";
        }
    }
    ?>

</body>
</html>
