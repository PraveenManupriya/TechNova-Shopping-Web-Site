<?php
include "connection.php";
session_start();

$user_id = $_SESSION['user_id']; 
$product_id = $_GET['product_id']; 
$category = $_GET['category']; 
$quantity = 1;

if (isset($_SESSION['user_id'])) {
    $stock_check_query = "SELECT stock FROM products WHERE product_id = '$product_id'";
    $stock_result = mysqli_query($conn, $stock_check_query);
    $row = mysqli_fetch_assoc($stock_result);
    
    if ($row['stock'] >= $quantity) {
        $query = "INSERT INTO cart (user_id, product_id, quantity, category) VALUES ('$user_id', '$product_id', '$quantity', '$category')";
        
        if (mysqli_query($conn, $query)) {
            $update_stock_query = "UPDATE products SET stock = stock - $quantity WHERE product_id = '$product_id'";
            mysqli_query($conn, $update_stock_query);
            
            header("location:index.php?success=insertCart");
        }
    } else {
        header("location:index.php?success=outOfStock");
    }
} else if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
