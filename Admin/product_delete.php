<?php
    include "../connection.php";
    if(isset($_GET['delete_id'])){
        $delete_id = $_GET['delete_id'];

        $query = "DELETE FROM products WHERE product_id='$delete_id'";
        $result = mysqli_query($conn,$query);
        header("location:product.php?success=deleted");
        exit();

    }

?>