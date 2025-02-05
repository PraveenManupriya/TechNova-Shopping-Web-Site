<?php
include "../connection.php";

if (isset($_POST['submit'])) {   
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $userRole = $_POST['userRole'];
     
    
    $check = "SELECT * FROM users WHERE username='$userName'";
    $check_result = mysqli_query($conn, $check);
    if (mysqli_num_rows($check_result) > 0) {
        header('location:index.php?error=user_exists');
        exit();
    } else {
        $query = "INSERT INTO users (username, email, role) 
                  VALUES('$userName', '$userEmail', '$userRole')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header('location:index.php?success=user_insert');
            exit(); 
        }
    }
}
?>
