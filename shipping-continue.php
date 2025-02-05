<?php
include "connection.php";
session_start();
$discount = 2;

$user_id = $_SESSION['user_id']; 
 $cart_query = "SELECT * FROM cart WHERE user_id='$user_id'";
 $cart_result = mysqli_query($conn, $cart_query);

 $query = "SELECT * FROM order_details WHERE user_id='$user_id'";
 $result = mysqli_query($conn, $query);

 if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
         $order_id = $row['order_id'];
         $payment_method = $row['payment_method'];
     }
 

 while ($cart_item = mysqli_fetch_assoc($cart_result)) {
     $product_id = $cart_item['product_id'];
     $quantity = $cart_item['quantity'];
     $category = $cart_item['category'];

     $order_total=$_SESSION['total'];
     $total += $order_total - 100 * $discount ;
     
     $order_items_query = "INSERT INTO orders (order_id, product_id,user_id,payment_method, quantity,total,category) VALUES ('$order_id', '$product_id','$user_id','$payment_method', '$quantity','$total','$category')";
     mysqli_query($conn, $order_items_query);
 }

 $delete_cart_query = "DELETE FROM cart WHERE user_id='$user_id'";
 mysqli_query($conn, $delete_cart_query);

 header('location:index.php?success=confirm');
?>