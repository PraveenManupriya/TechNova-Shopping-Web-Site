<?php
include "../connection.php"; 

if (isset($_POST['submit'])) {
    $update_id = $_GET['update_id'];

    
    $query = "SELECT * FROM products WHERE product_id = '$update_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);


    $productName = mysqli_real_escape_string($conn, $_POST['productName']);
    $productDes = mysqli_real_escape_string($conn, $_POST['productDes']);
    $productPrice = mysqli_real_escape_string($conn, $_POST['productPrice']);
    $productStock = mysqli_real_escape_string($conn, $_POST['productStock']);
    $productCategory = mysqli_real_escape_string($conn, $_POST['productCategory']);
    

    $image = $_FILES['productImage']['name'];
    $temp_name = $_FILES['productImage']['tmp_name'];
    

    if ($image) {
        $imageExtension = pathinfo($image, PATHINFO_EXTENSION);
        $uniqueImageName = uniqid('product_', true) . '.' . $imageExtension; 
        $folder = "../uploads/" . $uniqueImageName;

  
        move_uploaded_file($temp_name, $folder);
    } else {
        
        $uniqueImageName = $row['image'];
    }


    $query = "UPDATE products SET 
                name='$productName',
                description='$productDes',
                price='$productPrice',
                stock='$productStock',
                category='$productCategory',
                image='$uniqueImageName' 
              WHERE product_id='$update_id'";
    
    $result = mysqli_query($conn, $query);
    if ($result) {
        header('location:product.php?success=product_update');
        exit();
    } else {
        header('location:product.php?error=update_failed');
        exit();
    }
}
?>
