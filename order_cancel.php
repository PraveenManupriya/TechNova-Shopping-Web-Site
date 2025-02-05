<?php
include "connection.php";
session_start();
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];


    $query = "UPDATE orders SET confirm = 'Cancelled' WHERE order_id = '$order_id'";
    $result=mysqli_query($conn,$query);


    header('Location: user-profile.php?error=cancel');
    exit;
} else {
    echo "No order ID specified.";
}
?>
