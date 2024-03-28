<?php
session_start();

require 'database.php';
include 'checkout.php';

if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }
    $cart = $_SESSION["cart"];


    $sql = "INSERT INTO orders(name, address, phone_number, total_price) VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssd", $name, $address, $phone, $totalPrice);
    
    if ($stmt->execute()) {
        $_SESSION["cart"] = array();
        
        header("Location: thank_you.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}

