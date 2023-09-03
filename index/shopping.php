<?php
require 'database.php';
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: index.html");
    exit;
}

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
}

$cart = $_SESSION["cart"];

$cartQuantity = array_count_values($cart);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Web bán hàng xịn vkl</title>
</head>
<body>
    <h1>Chào mừng <?php echo $_SESSION["username"]; ?> đến với web bán hàng xịn vkl.</h1>

    <h2>Giỏ hàng của bạn</h2>
    <?php
    if (!empty($cart)) {
        echo "<ul>";
        foreach ($cartQuantity as $product_id => $quantity) {
            $sql = "SELECT * FROM product WHERE id = $product_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<li>{$row['product_name']} - Giá: {$row['price']}$ - Số lượng: {$quantity}";
                echo " <form action='shopping.php' method='POST'>";
                echo "     <input type='hidden' name='product_id' value='$product_id'>";
                echo "     <input type='submit' name='remove_from_cart' value='Remove from Cart'>";
                echo " </form></li>";
            }
        }
        echo "</ul>";
    } else {
        echo "<p>Giỏ hàng của bạn hiện đang trống.</p>";
    }
    ?>

    <h2>Sản phẩm</h2>
    <?php
    $sql = "SELECT * FROM product";
    $result = $conn->query($sql);
    $products = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    ?>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <?php 
                echo $product['product_name'];
                echo " Giá: " . $product['price'] . "$";
                echo " Số lượng: " . $product['quantity'];
                echo "<br>";
                ?>
                <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['product_name']; ?>" width="50">
                <form action="shopping.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="submit" name="add_to_cart" value="Add to Cart">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <p><a href="cart.php">View Cart</a></p>
    <p><a href="logout.php">Logout</a></p>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_id"])) {
        $product_id = $_POST["product_id"];
        
        if (isset($_POST["add_to_cart"])) {
            $cart[] = $product_id;
            $_SESSION["cart"] = $cart;
        } elseif (isset($_POST["remove_from_cart"])) {
            $index = array_search($product_id, $cart);
            if ($index !== false) {
                array_splice($cart, $index, 1);
                $_SESSION["cart"] = $cart;
            }
        }
        $cartQuantity = array_count_values($cart);
    }
    ?>
</body>
</html>
