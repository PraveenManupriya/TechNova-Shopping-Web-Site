<?php
include "../connection.php";
session_start();

$user_id = $_SESSION['user_id']; // Get user_id from session

// Step 3: Delete items from the cart after inserting into the orders table
$delete_cart_query = "DELETE FROM cart WHERE user_id = '$user_id'";
mysqli_query($conn, $delete_cart_query);

// Commit the transaction
mysqli_commit($conn);
header("Location:website/index.php");
?>