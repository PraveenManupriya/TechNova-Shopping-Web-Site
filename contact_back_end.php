<?php
include 'connection.php'; 
session_start();
$user_id = $_SESSION['user_id'];

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $massage = mysqli_real_escape_string($conn, $_POST['massage']);

    if(empty($name)||empty($address)||empty($email)||empty($phone)||empty($subject)||empty($massage)){
        header("Location: contact.php?error=empty");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.php?error=invalid_email");
        exit();
    }

    $query = "INSERT INTO contact (user_id,name, address, email, phone, subject, massage) VALUES ('$user_id','$name', '$address', '$email', '$phone', '$subject', '$massage')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header('Location: contact.php?success=submit');
        exit();
    } 
}
?>
