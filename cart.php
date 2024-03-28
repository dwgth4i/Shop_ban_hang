<?php
require "database.php";
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
}

$cart = $_SESSION["cart"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Giỏ hàng của bạn</title>
</head>
<body>
    <h1>Giỏ hàng của bạn</h1>

    <?php
        if (!empty($cart)) {
            $cartQuantity = array_count_values($cart);

            $itemIds = implode(",", array_keys($cartQuantity));

            $sql = "SELECT * FROM product WHERE id IN ($itemIds)";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<ul>";
                while ($row = $result->fetch_assoc()) {
                    $productId = $row['id'];
                    $quantityInCart = $cartQuantity[$productId];

                    echo "<li>{$row['product_name']} - Giá: {$row['price']}$ - Số lượng trong giỏ hàng: $quantityInCart</li>";
                }
                echo "</ul>";
            }
        } else {
            echo "<p>Giỏ hàng của bạn hiện đang trống.</p>";
        }
    ?>


    <p><a href="shopping.php">Tiếp tục mua sắm</a></p>
    <p><a href="checkout.php">Thanh toán</a></p>
    <p><a href="logout.php">Đăng xuất</a></p>
</body>
</html>
