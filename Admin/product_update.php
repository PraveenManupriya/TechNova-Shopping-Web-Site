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
.form-inline input[type="number"],
.form-inline select,
.form-inline input[type="file"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid var(--focus-color);
    border-radius: 4px;
    box-sizing: border-box;
}

.form-inline input[type="text"]:focus,
.form-inline input[type="number"]:focus,
.form-inline select:focus,
.form-inline input[type="file"]:focus {
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
            <h3>Product Update</h3>
            <a href="product.php"><i class='bx bx-x' id="close"></i></a>
        </div>
        <?php
        if (isset($_GET['update_id'])) {
            $update_id = $_GET['update_id'];
            $query = "SELECT * FROM products WHERE product_id = '$update_id'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
        ?>
        <form id="addProductForm" method="POST" action="update_product_back_end.php?update_id=<?php echo $update_id; ?>" class="form-inline" enctype="multipart/form-data">
            <input type="text" name="productName" value="<?php echo htmlspecialchars($row['name']); ?>" required>
            <input type="text" name="productDes" value="<?php echo htmlspecialchars($row['description']); ?>" required>
            <input type="number" name="productPrice" value="<?php echo htmlspecialchars($row['price']); ?>" required>
            <input type="number" name="productStock" value="<?php echo htmlspecialchars($row['stock']); ?>" required>
            <select name="productCategory">
            <?php
                $categories_query = "SELECT id, name FROM categories";
                $categories_result = mysqli_query($conn, $categories_query);
                while ($category = mysqli_fetch_assoc($categories_result)) {
                    echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
                }
                ?>
            </select>
            <input type="file" name="productImage">
            <button type="submit" name="submit" class="btn-primary">Update Product</button>
        </form>
        <?php
            }
        }
        ?>
    </div>
</div>

</body>
</html>