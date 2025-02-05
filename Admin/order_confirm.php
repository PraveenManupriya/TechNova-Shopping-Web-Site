<?php
include "../connection.php";

if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];

    $query = "UPDATE orders SET order_status = 'Processing' WHERE order_id = '$order_id'";
    mysqli_query($conn, $query);
    header('Location:order.php?success=confirm');


    $query = "SELECT * FROM order_details";
    $result=mysqli_query($conn, $query);
    if(mysqli_num_rows($result)){
        $row=mysqli_fetch_assoc($result);
        $order_id=$row['id'];
    }
    $query = "UPDATE order_details SET order_status = 'Processing' WHERE id = '$order_id'";
    mysqli_query($conn, $query);
    header('Location:order.php?success=confirm');
}

?>