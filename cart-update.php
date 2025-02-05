<?php
session_start();
include 'connection.php';

$user_id = $_SESSION['user_id']; 
$product_id = $_POST['product_id'];  

if (isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];

    $stock_query = "SELECT stock FROM products WHERE product_id = '$product_id'";
    $stock_result = mysqli_query($conn, $stock_query);

    if ($stock_result && mysqli_num_rows($stock_result) > 0) {
        $stock_row = mysqli_fetch_assoc($stock_result);
        $available_stock = $stock_row['stock'];

        if ($quantity > $available_stock) {
            header("Location: view-cart.php?error=out_of_stock");
            exit();
        } else {

            $update_cart_query = "UPDATE cart SET quantity = '$quantity' WHERE user_id = '$user_id' AND product_id = '$product_id'";

            if (mysqli_query($conn, $update_cart_query)) {
                $update_order_query = "UPDATE orders SET quantity = '$quantity' WHERE user_id = '$user_id' AND product_id = '$product_id'";

                if (mysqli_query($conn, $update_order_query)) {
                    header("Location: view-cart.php?success=updated");
                    exit();
                }
            }
        }
    } else {
        header("Location: view-cart.php?error=stock_not_found");
        exit();
    }
}
?>

