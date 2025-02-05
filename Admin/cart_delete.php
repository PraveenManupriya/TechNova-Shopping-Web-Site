<?php
session_start();
include '../connection.php';

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

$remove_query = "DELETE FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";

if (mysqli_query($conn, $remove_query)) {
    
    header("Location: order_success.php");
    exit(); 
} else {
    echo "Error removing item: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
