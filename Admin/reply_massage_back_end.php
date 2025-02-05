<?php
    include '../connection.php'; 
    session_start();
   
    if (isset($_POST['replybtn'])) {
        $id = $_POST['id'];
        $reply = $_POST['reply'];
        $user_id = $_SESSION['user_id'];
      

        $query = "SELECT * FROM contact WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $subject = "TechNova - Reply Received";
        $message = $row['massage'];

        $query = "INSERT INTO message (user_id,name, subject, content, reply) VALUES ('$user_id','$name', '$subject', '$message','$reply')";
        $result = mysqli_query($conn, $query);

        $query = "UPDATE contact SET status = 'Replied' WHERE id = '$id'";
        $result = mysqli_query($conn, $query);

        header("Location: contact.php?success=reply_sent");
        exit();
    }
?>
