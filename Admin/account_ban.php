
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include('../connection.php'); 

if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);


    $query = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result); 
        $user_name = $user['name'];
        $user_email = $user['email'];

        if (empty($user_email) || !filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid or missing email address for the user.";
            exit;
        }

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'praveen.manupriya@ecyber.com'; 
            $mail->Password   = 'yowemmaguisnnsty';  
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('technova@gmail.com', 'TECH NOVA');
            $mail->addAddress($user_email, $user_name); 

            $mail->isHTML(true);
            $mail->Subject = 'Account Banned Notification';
            $mail->Body    = "<p>Dear <b>$user_name</b>,</p>
                              <p>Your account has been banned due to a violation of our terms and conditions.</p>
                              <p>If you believe this is a mistake, please contact our support team <a href='mailto:praveen.manupriya@ecyber.com'>technova@gmail.com</a> or call us at <strong>+94-389-1726</strong>.</p>
                              <p>Best regards,<br>TECH NOVA Team</p>";
            $mail->AltBody = "Dear $user_name,\nYour account has been banned due to a violation of our terms and conditions.\nIf you believe this is a mistake, please contact our support team.\nBest regards,\nTECH NOVA Team";

            $mail->send();
            header("Location: user.php?success=banned");
        } catch (Exception $e) {
            echo "Notification email could not be sent. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "User not found!";
    }
} else {
    echo "No user ID found!";
}
?>


<?php
include '../connection.php';

if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);

    $query = "UPDATE users SET is_banned = 1 WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: user.php?success=banned");
    } 
}
$conn->close();
?>
