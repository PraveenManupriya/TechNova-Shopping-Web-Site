<?php
session_start();
include 'connection.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    $query = "UPDATE users SET is_logged_in = 0 WHERE user_id = '$user_id'";
    mysqli_query($conn, $query);
    
    $delete_cart_query = "DELETE FROM cart WHERE user_id = '$user_id'";
    mysqli_query($conn, $delete_cart_query);

    
    session_destroy(); 
    header("Location:index.php"); 
    exit();
}

?>

