<?php
session_start();
include "connection.php";

$discount = 2;

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


$user_id = $_SESSION['user_id'];

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $shipping_method = mysqli_real_escape_string($conn, $_POST['method']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['peyment']);

    $sub_total = isset($_SESSION['total']) ? $_SESSION['total'] : 0;
    $total = $sub_total - 100 * $discount;

  
    if (empty($name) || empty($email) || empty($phone) || empty($country) || empty($state) || 
        empty($city) || empty($address) || empty($shipping_method) || empty($payment_method)) {
        header('Location: checkout.php?error=empty_fields');
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: checkout.php?error=invalid_email');
        exit();
    }


    $query = "INSERT INTO order_details 
        (user_id, name, email, phone, country, state, city, address, shipping_method, payment_method, total) 
        VALUES 
        ('$user_id', '$name', '$email', '$phone', '$country', '$state', '$city', '$address', '$shipping_method', '$payment_method', '$total')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        header('Location: checkout.php?status=success');
        exit();
    } 
} else {
    header('Location: checkout.php');
    exit();
}
?>
