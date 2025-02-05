<?php
include "../connection.php";

if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];

    $query = "UPDATE orders SET payment_status = 'Completed' WHERE order_id = '$order_id'";
    mysqli_query($conn, $query);
    header('Location:order.php?success=paymented');


    $query = "SELECT * FROM order_details";
    $result=mysqli_query($conn, $query);
    if(mysqli_num_rows($result)){
        $row=mysqli_fetch_assoc($result);
        $order_id=$row['id'];
    }
    $query = "UPDATE order_details SET payment_status = 'Completed' WHERE id = '$order_id'";
    mysqli_query($conn, $query);
    header('Location:order.php?success=paymented');
}

?>