<?php

session_start();

require '../includes/database_connection.php';
require '../includes/functions.php';

$userId = $_SESSION['user_id'];
$productId = $_POST['product_id'];
$quantity = $_POST['quantity'];


//Error message if user puts in numbers less than 0
if ($quantity < 0) {
    header('location:../index.php?error=please enter a number above 0');
    die;
}

updateCart($pdo, $userId, $productId, $quantity);

header('Location: /index.php');