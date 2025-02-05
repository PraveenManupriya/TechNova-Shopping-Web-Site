<?php
include "../connection.php";

if (isset($_POST['submit'])) {   
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productStock = $_POST['productStock'];  
    $productCategory = $_POST['productCategory'];     
    
    $image = $_FILES['productImage']['name'];
    $temp_name = $_FILES['productImage']['tmp_name'];

 
    $imageExtension = pathinfo($image, PATHINFO_EXTENSION);
    $uniqueImageName = uniqid('product_', true) . '.' . $imageExtension;

    $folder = "../uploads/" . $uniqueImageName;

    if (empty($productName) || empty($productDescription)|| empty($productPrice)|| empty($productStock)|| empty($productCategory)|| empty($uniqueImageName)) {
        header("Location: product.php?error=empty");
        exit();
    }


    $check = "SELECT * FROM products WHERE name='$productName'";
    $check_result = mysqli_query($conn, $check);
    if (mysqli_num_rows($check_result) > 0) {
        header('location:product.php?error=product_exists');
        exit();
    } else {
        $query = "INSERT INTO products (name, description, stock, price, image, category) 
                  VALUES('$productName', '$productDescription', '$productStock', '$productPrice', '$uniqueImageName', '$productCategory')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            move_uploaded_file($temp_name, $folder);
            header('location:product.php?success=product_insert');
            exit(); 
        }
    }
}
?>
