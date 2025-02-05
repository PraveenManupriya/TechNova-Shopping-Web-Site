<?php
    include "connection.php";
    if(isset($_GET['delete_id'])){
        $delete_id = $_GET['delete_id'];

        $query = "DELETE FROM contact WHERE id='$delete_id'";
        $result = mysqli_query($conn,$query);
        header("location:messages.php?success=deleted");
        exit();

    }

?>