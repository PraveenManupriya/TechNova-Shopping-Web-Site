<?php
session_start();
include 'connection.php';

$user_id = $_SESSION['user_id'];
$product_id = $_GET['product_id'];

$check_cart_query = "SELECT quantity FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
$cart_result = mysqli_query($conn, $check_cart_query);
$cart_item = mysqli_fetch_assoc($cart_result);

if ($cart_item) {
    $current_quantity = $cart_item['quantity'];
    $new_quantity = $current_quantity - 1;

    if ($new_quantity > 0) {
        $update_cart_query = "UPDATE cart SET quantity = $new_quantity WHERE user_id = '$user_id' AND product_id = '$product_id'";
        if (mysqli_query($conn, $update_cart_query)) {
            
            $update_stock_query = "UPDATE products SET stock = stock + 1 WHERE product_id = '$product_id'";
            mysqli_query($conn, $update_stock_query);

            header("Location: index.php");
            exit();
        }
    } else {
        $delete_cart_query = "DELETE FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
        if (mysqli_query($conn, $delete_cart_query)) {

            $update_stock_query = "UPDATE products SET stock = stock + 1 WHERE product_id = '$product_id'";
            mysqli_query($conn, $update_stock_query);


            header("Location: index.php?success=removeItem");
            exit();
        }
    }
}
?>
