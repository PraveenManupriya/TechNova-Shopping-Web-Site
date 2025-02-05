<?php
include "../connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TECH NOVA</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../logo.png" type="image/x-icon">
    <style>
        /* Add your existing CSS styles here */
        :root {
            --bg-color: #f4f7fa;
            --font-color: #333;
            --sidebar-color: #006da0;
            --sidebar-font-color: #ddd;
            --btn-color: #1abc9c;
            --btn-hover-color: #16a085;
            --focus-color: #6ba5ac;
            --transition-speed: 0.3s;
        }

        body {
            background-color: var(--bg-color);
            font-family: Arial, sans-serif;
            color: var(--font-color);
        }

        .submenu-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .submenu {
            background-color: var(--sidebar-color);
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            color: var(--sidebar-font-color);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all var(--transition-speed) ease-in-out;
        }

        .submenu h3 {
            font-size: 24px;
            color: var(--sidebar-font-color);
            margin-bottom: 10px;
        }

        .submenu_top i {
            cursor: pointer;
            font-size: 24px;
            color: var(--sidebar-font-color);
        }

        .form-inline input[type="text"],
        .form-inline input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid var(--focus-color);
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-inline input:focus {
            border-color: var(--focus-color);
            outline: none;
        }

        .btn-primary {
            background-color: var(--btn-color);
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color var(--transition-speed) ease-in-out;
        }

        .btn-primary:hover {
            background-color: var(--btn-hover-color);
        }

        .submenu_top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>

<div class="submenu-wrapper">
    <div class="submenu" id="submenu">
        <div class="submenu_top">
            <h3>Category Update</h3>
            <a href="categories.php"><i class='bx bx-x' id="close"></i></a>
        </div>
        <?php
        if (isset($_GET['update_id'])) {
            $update_id = $_GET['update_id'];
            $query = "SELECT * FROM categories WHERE id = '$update_id'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
        ?>
        <form id="addCategoryForm" method="POST" action="update_category_back_end.php?update_id=<?php echo $update_id; ?>" class="form-inline" enctype="multipart/form-data">
            <input type="text" name="categoryName" value="<?php echo $row['name']; ?>" required>
            <input type="file" name="categoryImage">
            <button type="submit" name="submit" class="btn-primary">Update Category</button>
        </form>
        <?php
            } else {
                echo "Category not found.";
            }
        } else {
            echo "No category selected for update.";
        }
        ?>
    </div>
</div>

</body>
</html>
