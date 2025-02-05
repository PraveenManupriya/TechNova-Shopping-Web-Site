<?php
session_start();
include 'connection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];  
    $phone = $_POST['phone'];
    $image = $_FILES['profile_picture']['name'];
    $temp_name = $_FILES['profile_picture']['tmp_name'];
    $upload_dir = 'registration_images/'; // Directory to store uploaded images
    $target_file = $upload_dir . basename($image);

    // Validation checks
    if (empty($name) || empty($username) || empty($phone) || empty($email) || empty($password) || empty($c_password) || empty($image)) {
        header("Location:register.php?error=empty");
        exit();
    }

    // Password Strength Validation in a single if statement
    if (strlen($password) < 6 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        header("Location: register.php?error=weak_password");
        exit();
    }
    
    if (strlen($phone) != 10) {
        header("Location: register.php?error=invalid_phone");
        exit();
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location:register.php?error=invalid_email");
        exit();
    }

    if ($password !== $c_password) {
        header("Location:register.php?error=password_mismatch");
        exit();
    }

    // Check if the user already exists
    $query = "SELECT username, email FROM users WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        header("Location:register.php?error=user_exists");
        exit();
    } else {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Generate a random verification code
        $verification_code = rand(100000, 999999);

        // Save the uploaded file to the server
        if (move_uploaded_file($temp_name, $target_file)) {
            // Insert into the database with hashed password and image path
            $query = "INSERT INTO users (name, username, phone, password, email, profile_picture, verification_code) 
                      VALUES ('$name', '$username', '$phone', '$hashed_password', '$email', '$target_file', '$verification_code')";

            $result = mysqli_query($conn, $query);

            if ($result) {
                $_SESSION['email'] = $email; // Store email in session for verification step
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'praveen.manupriya@ecyber.com'; 
                    $mail->Password = 'yowemmaguisnnsty'; 
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    $mail->setFrom('technova@gmail.com', 'TECH NOVA');
                    $mail->addAddress($email, $name);

                    $mail->isHTML(true);
                    $mail->Subject = 'Email Verification Code';
                    $mail->Body = "Hello $name,<br><br>Your verification code is: <h1>$verification_code</h1> Please verify your email to activate your account.";
                    
                    $mail->send();
                    header("Location:verify.php");
                    exit();
                } catch (Exception $e) {
                    header("Location:register.php?error=email_failed");
                    exit();
                }
            } else {
                header("Location:register.php?error=insert_failed");
                exit();
            }
        } else {
            header("Location:register.php?error=image_upload_failed");
            exit();
        }
    }
}
?>
