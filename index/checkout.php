<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: index.html");
    exit;
}

$cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : array();
$total_price = 0;

foreach ($cart as $item) {
    $total_price += $item["price"];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <h1>Checkout</h1>
    
    <?php if (count($cart) > 0): ?>
    <table border="1">
        <tr>
            <th>Product</th>
            <th>Price</th>
        </tr>
        <?php foreach ($cart as $item): ?>
        <tr>
            <td><?php echo $item["name"]; ?></td>
            <td>$<?php echo $item["price"]; ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td><strong>Total</strong></td>
            <td><strong>$<?php echo $total_price; ?></strong></td>
        </tr>
    </table>
    <p>Thank you for your purchase!</p>
    <?php else: ?>
    <p>Your cart is empty.</p>
    <?php endif; ?>
    
    <p><a href="shopping.php">Continue Shopping</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
