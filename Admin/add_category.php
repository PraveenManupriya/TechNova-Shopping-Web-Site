<?php
include "../connection.php";

if (isset($_POST['submit'])) {   
    $categoryName = $_POST['categoryName'];

    $image = $_FILES['categoryImage']['name'];
    $temp_name = $_FILES['categoryImage']['tmp_name'];

 
    $imageExtension = pathinfo($image, PATHINFO_EXTENSION);
    $uniqueImageName = uniqid('category_', true) . '.' . $imageExtension;

    $folder = "../uploads/" . $uniqueImageName;

    if (empty($categoryName) || empty($uniqueImageName)) {
        header("Location: categories.php?error=empty");
        exit();
    }

    $check = "SELECT * FROM categories WHERE name='$categoryName'";
    $check_result = mysqli_query($conn, $check);
    if (mysqli_num_rows($check_result) > 0) {
        header('location:categories.php?error=category_exists');
        exit();
    } else {
        $query = "INSERT INTO categories (name, image) 
                  VALUES('$categoryName', '$uniqueImageName')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            move_uploaded_file($temp_name, $folder);
            header('location:categories.php?success=category_insert');
            exit(); 
        }
    }
}
?>
