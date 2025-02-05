<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

$update_query = "UPDATE cart SET quantity = '$quantity' WHERE user_id = '$user_id' AND product_id = '$product_id'";

if (mysqli_query($conn, $update_query)) {
    header("Location: order_success.php");
} 

$update_query = "UPDATE orders SET quantity = '$quantity' WHERE user_id = '$user_id' AND product_id = '$product_id'";

if (mysqli_query($conn, $update_query)) {
    header("Location: order_success.php");
}
?>
