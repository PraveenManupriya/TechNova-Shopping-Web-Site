<?php
    include "../connection.php";
 
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];

       
        $query = "UPDATE contact SET status = 'Now' WHERE id = '$delete_id'";
        $result = mysqli_query($conn, $query);

        $query = "DELETE FROM message WHERE id='$delete_id'";
        $result = mysqli_query($conn, $query);

        header("Location: contact.php?success=deleted");
        exit();
    }
?>
