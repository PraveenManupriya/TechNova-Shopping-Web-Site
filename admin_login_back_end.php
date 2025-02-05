<?php
session_start();
include "connection.php";

if (isset($_POST['submit'])) {
    $username = $_POST['username']; // This is the email
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        header("Location: admin_login.php?error=empty");
        exit();
    }

    // Prepare the query to fetch the user from the database
    $query = "SELECT * FROM admin_login WHERE email='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // If the user exists, fetch the user details
        $row = mysqli_fetch_assoc($result);

        // Verify the hashed password with the one entered by the user
        if (password_verify($password, $row['password'])) {
            // If the password matches, start the session and redirect
            $_SESSION['admin_id'] = $row['id']; // Storing user ID in session (for example)
            header('Location: Admin/index.php');
            exit();
        } else {
            // If password doesn't match, redirect with error
            header('Location: admin_login.php?error=notMatch');
            exit();
        }
    }else {
        // If the user doesn't exist, redirect with error
        header('Location: admin_login.php?error=userNotFound');
        exit();
    }
}
?>
