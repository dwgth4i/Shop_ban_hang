<?php
session_start();


if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

require 'database.php';


if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
}

$cart = $_SESSION["cart"];


?>

<!DOCTYPE html>
<html>
<head>
    <title>Thanh toán</title>
</head>
<body>
    <h1>Thanh toán</h1>

    <h2>Giỏ hàng của bạn</h2>
    <?php
    if (!empty($cart)) {

        $totalPrice = 0;
    

        $cartQuantity = array_count_values($cart);
    

        $itemIds = implode(",", array_keys($cartQuantity));
    

        $sql = "SELECT * FROM product WHERE id IN ($itemIds)";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {

                $productId = $row['id'];
                $quantityInCart = $cartQuantity[$productId];

                $productPrice = $row['price'] * $quantityInCart;
                $totalPrice += $productPrice;
    
                echo "<li>{$row['product_name']} - Giá: {$row['price']}$ - Số lượng trong giỏ hàng: $quantityInCart</li>";
            }
            echo "</ul>";
        }
        echo "<h3>Tổng tiền trong giỏ hàng: $totalPrice$</h3>";
    } else {
        echo "<p>Giỏ hàng của bạn hiện đang trống.</p>";
    }
    ?>

    <h2>Thông tin thanh toán</h2>
    <form action="process_checkout.php" method="POST">
        <label for="name">Tên của bạn:</label>
        <input type="text" name="name" required><br><br>

        <label for="address">Địa chỉ:</label>
        <input type="text" name="address" required><br><br>

        <label for="phone">Số điện thoại:</label>
        <input type="text" name="phone" required><br><br>
        <input type="submit" value="Xác nhận thanh toán">
    </form>

    <p><a href="shopping.php">Quay lại giỏ hàng</a></p>
    <p><a href="logout.php">Đăng xuất</a></p>
</body>
</html>
