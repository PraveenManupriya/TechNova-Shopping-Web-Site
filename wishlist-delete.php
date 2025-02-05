<?php
    include "connection.php";
    if(isset($_GET['product_id'])){
        $product_id = $_GET['product_id'];

        $query = "DELETE FROM wishlist WHERE product_id='$product_id'";
        $result = mysqli_query($conn,$query);
        header("location:index.php?success=wishlist-deleted");
        exit();

    }

?>