<?php
include "../connection.php"; 

if (isset($_POST['submit'])) {
    $update_id = $_GET['update_id'];

    
    $query = "SELECT * FROM categories WHERE id = '$update_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);


    $categoryName = mysqli_real_escape_string($conn, $_POST['categoryName']);

    

    $image = $_FILES['categoryImage']['name'];
    $temp_name = $_FILES['categoryImage']['tmp_name'];
    

    if ($image) {
        $imageExtension = pathinfo($image, PATHINFO_EXTENSION);
        $uniqueImageName = uniqid('category_', true) . '.' . $imageExtension; 
        $folder = "../uploads/" . $uniqueImageName;

  
        move_uploaded_file($temp_name, $folder);
    } else {
        
        $uniqueImageName = $row['image'];
    }


    $query = "UPDATE categories SET 
                name='$categoryName',
                image='$uniqueImageName' 
              WHERE id='$update_id'";
    
    $result = mysqli_query($conn, $query);
    if ($result) {
        header('location:categories.php?success=categories_update');
        exit();
    } else {
        header('location:categories.php?error=update_failed');
        exit();
    }
}
?>
