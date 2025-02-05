<?php
session_start();
include "connection.php";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        header("Location: login.php?error=empty");
        exit();
    }

    // Check if user is banned
    $sql = "SELECT * FROM users WHERE email = '$username' AND is_banned = 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        header("Location: login.php?error=banned");
        exit();
    }

    // Check if user is verified
    $query = "SELECT * FROM users WHERE email = '$username' AND is_verified = 1";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 0) {
        header("Location: login.php?error=not_verified");
        exit();
    }

    // Check user credentials
    $query = "SELECT * FROM users WHERE email='$username'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        if ($row = mysqli_fetch_assoc($result)) {
            // Verify the entered password against the hashed password in the database
            if (password_verify($password, $row['password'])) {
                // Password is correct, login the user
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];

                // Set is_logged_in to 1
                $user_id = $_SESSION['user_id'];
                $query = "UPDATE users SET is_logged_in = 1 WHERE user_id = '$user_id'";
                mysqli_query($conn, $query);

                header('Location: index.php?success=login');
                exit();
            } else {
                header('Location: login.php?error=incorrect_password');
                exit();
            }
        }
    } else {
        header('Location: login.php?error=notMatch');
        exit();
    }
}
?>
