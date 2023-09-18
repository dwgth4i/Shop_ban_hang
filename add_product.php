<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}

require 'database.php';

$message = "";

if (isset($_POST["add_product"])) {
    $productName = $_POST["product_name"];
    $productQuantity = $_POST["quantity"];
    $productPrice = $_POST["product_price"];

    $sql = "INSERT INTO `product` (product_name, quantity, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdi", $productName, $productPrice, $productQuantity); 
    if ($stmt->execute()) {
        $message = "Đã thêm sản phẩm";
    } else {
        $message = "Lỗi không thêm được sản phẩm";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <h1>Add Product</h1>
    
    <form method="POST" action="add_product.php">
        <label for="product_name">Tên sản phẩm: </label>
        <input type="text" name="product_name" required><br><br>

        <label for="product_price">Giá: </label>
        <input type="number" name="product_price" step="0.01" required><br><br>

        <label for="quantity">Số lượng sản phẩm: </label>
        <input type="number" name="quantity" required><br><br>

        <input type="submit" name="add_product" value="Thêm sản phẩm">
    </form>

    <p><?php echo $message; ?></p>

    <p><a href="admin_panel.php">Quay về trang admin</a></p>
</body>
</html>
