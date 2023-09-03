<?php
session_start();

if (isset($_POST["product_id"]) && isset($_POST["action"])) {
    $product_id = $_POST["product_id"];
    $action = $_POST["action"];

    if ($action === "add") {
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array();
        }
        if (!in_array($product_id, $_SESSION["cart"])) {
            $_SESSION["cart"][] = $product_id;
        }
    } elseif ($action === "remove") {
        if (isset($_SESSION["cart"]) && in_array($product_id, $_SESSION["cart"])) {
            $index = array_search($product_id, $_SESSION["cart"]);
            array_splice($_SESSION["cart"], $index, 1);
        }
    }
}
?>
