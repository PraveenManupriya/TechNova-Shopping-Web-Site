<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}
$user_id = $_SESSION['user_id'];

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Check if a new image is uploaded
    if ($_FILES['profile_picture']['name'] != '') {
        $image = $_FILES['profile_picture']['name'];
        $temp_name = $_FILES['profile_picture']['tmp_name'];
        $upload_dir = 'registration_images/'; // Directory to store uploaded images
        $target_file = $upload_dir . basename($image);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($temp_name, $target_file)) {
            $profile_picture = $target_file;
        } else {
            header('location:user-profile.php?error=image_upload_failed');
            exit();
        }
    } else {
        // If no new image is uploaded, use the existing profile picture
        $query = "SELECT profile_picture FROM users WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $profile_picture = $row['profile_picture'];
        } else {
            header('location:user-profile.php?error=fetch_profile_picture_failed');
            exit();
        }
    }

    // Check if the required fields are filled
    if (empty($name) || empty($username) || empty($phone)) {
        header('location:user-profile.php?error=empty_fields');
        exit();
    }

    // Check if the username already exists
    $query = "SELECT * FROM users WHERE username = '$username' AND user_id != '$user_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        header('location:user-profile.php?error=user_exists');
        exit();
    } else {
        // Update the user details with the new information (or keep the old profile picture)
        $query = "UPDATE users SET name = '$name', username = '$username', phone = '$phone', profile_picture = '$profile_picture' WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header('location:user-profile.php?success=updated');
            exit();
        } else {
            header('location:user-profile.php?error=update_failed');
            exit();
        }
    }
}
?>
