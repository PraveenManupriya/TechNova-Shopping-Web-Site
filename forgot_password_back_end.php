<?php
session_start();
include 'connection.php'; 
$user_id = $_SESSION['user_id'];

if (isset($_POST['submit'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation for empty inputs
    if (empty($new_password) || empty($confirm_password)) {
        header("Location: forgot_password.php?error=empty");
        exit();
    }

    // Check if passwords match
    if ($new_password === $confirm_password) {
        // Hash the new password before updating in the database
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $query = "UPDATE users SET password='$hashed_password' WHERE user_id='$user_id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: forgot_password.php?success=updated");
            exit();
        } else {
            header("Location: forgot_password.php?error=failed");
            exit();
        }
    } else {
        header("Location: forgot_password.php?error=password_mismatch");
        exit();
    }
}
?>
