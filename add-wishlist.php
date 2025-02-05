<?php
session_start();
include "connection.php";

$user_id = $_SESSION['user_id']; 
$product_id = $_GET['product_id']; 

if (isset($_SESSION['user_id'])) {   
    
    $check = "SELECT * FROM wishlist WHERE user_id='$user_id'";
    $check_result = mysqli_query($conn, $check);
    if (mysqli_num_rows($check_result) > 0) {
        header('location:index.php?error=exists');
        exit();

    } else {
        $query = "INSERT INTO wishlist (product_id, user_id) 
                  VALUES('$product_id', '$user_id')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header('location:index.php?success=insert');
            exit(); 
        }
    }
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

