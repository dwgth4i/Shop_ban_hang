<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}

require "database.php";

$sql = "SELECT id, product_name, quantity, price FROM `product`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pid = $row["id"];
        echo "ID: " . $row["id"] . "<br>";
        echo "Tên sản phẩm: " . $row["product_name"] . "<br>";
        echo "Số lượng: " . $row["quantity"] . "<br>";
        echo "giá: " . $row["price"] . "<br>";
        echo "<br>";

        if ($pid === 1 || $pid === 2 || $pid === 3 || $pid === 4) {
            echo "Xoá hộ bố mày cái";
        } else {
            echo "<form action='delete_product.php' method='POST'>";
            echo "<input type='hidden' name='delete_product' value='$pid'>";
            echo "<input type='submit' value='Xóa sản phẩm'>";
            echo "</form>";
        }
        echo "<hr>";
    }
}

if (isset($_POST["delete_product"])) {
    $pid = intval($_POST["delete_product"]);

    if ($pid === 1 || $pid === 2 || $pid === 3 || $pid === 4) {
        echo "Sản phẩm này xịn lắm đừng xóa (っ◞‸◟ c)";
    } else {
        $sql = "DELETE FROM `product` WHERE id = $pid";
        $conn->query($sql);
        echo "Đã xóa sản phẩm có ID: $pid";
        header("Location: delete_product.php");
    }
}




?>