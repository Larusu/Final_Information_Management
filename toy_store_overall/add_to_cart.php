<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $toy_id = $_POST['toy_id'];
    $quantity = $_POST['quantity'];

    // Add the toy to the cart
    if (isset($_SESSION['orders'][$toy_id])) {
        $_SESSION['orders'][$toy_id] += $quantity; // Increase quantity if already in cart
    } else {
        $_SESSION['orders'][$toy_id] = $quantity; // Add new item to cart
    }

    // Redirect back to the homepage
    header('Location: index.php');
    exit;
}
?>