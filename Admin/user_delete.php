<?php
    include "../connection.php";
    if(isset($_GET['delete_id'])){
        $delete_id = $_GET['delete_id'];

        $query = "DELETE FROM users WHERE user_id='$delete_id'";
        $result = mysqli_query($conn,$query);
        header("location:user.php?success=deleted");
        exit();

    }

?>