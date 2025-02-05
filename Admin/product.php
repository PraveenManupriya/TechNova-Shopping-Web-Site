<?php include "sidebar.php" ?>
<style>
    /* alert */
@keyframes slideDown {
    10% {
        transform: translateX(40px); 
        opacity: 0;
    }
    80% {
        transform: translateX(0); 
        opacity: 1; 
    }
   
   
}

.alert {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: end;
    font-size: 14px;
    font-weight: 500; 
    margin: 0; 
    border-radius: 8px;
    transition: all 8s ease; 
    position: fixed; 
    top: 50px; 
    transform: translateX(20%);
    padding: 0 30px;
    z-index: 1000;
    animation: slideDown 5s ease;
    opacity: 0; 
    animation-fill-mode: forwards;
}

.success, .error {
    color: white;
    margin-bottom: 10px; 
    padding: 0 30px;
}

.success {
    background-color: #4CAF50;
}

.error {
    background-color: #F44336;
}
</style>

<div class="alert">
    <div class="success">
        <?php
            if (isset($_GET['success']) && $_GET['success'] === "product_insert") {
                echo 'The product has been successfully added!';
            }
            if (isset($_GET['success']) && $_GET['success'] === "product_update") {
                echo 'Success! Your product has been updated!';
            }
            if (isset($_GET['success']) && $_GET['success'] === "deleted") {
                echo 'Success! The product has been deleted!';
            }
            ?>
    
    </div>
    <div class="error">
    <?php
        if (isset($_GET['error']) && $_GET['error'] === "empty") {
            echo 'Please fill out all required fields!';
        }
        if (isset($_GET['error']) && $_GET['error'] === "product_exists") {
            echo 'The product you are trying to add already exists!';
        }
        if (isset($_GET['error']) && $_GET['error'] === "update_failed") {
            echo 'The product update was unsuccessful. Please try again.';
        }
        ?>

    </div>
</div>

<main class="main-content">

    <section id="products" class="section">
        <h2>Manage Products</h2>
        <button id="addProductBtn" class="btn-primary" aria-controls="addProductForm">Add New Product</button>
        <form id="addProductForm" method="POST" style="display:none;" action="add_product.php"
            enctype="multipart/form-data" class="form-inline">
            <input type="text" name="productName" placeholder="Product Name" >
            <input type="text" name="productDescription" placeholder="Product Description" >
            <input type="number" name="productStock" placeholder="Stock" >
            <input type="number" name="productPrice" placeholder="Price" >

            <select name="productCategory">
            <?php
                $categories_query = "SELECT id, name FROM categories";
                $categories_result = mysqli_query($conn, $categories_query);
                while ($category = mysqli_fetch_assoc($categories_result)) {
                    echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
                }
                ?>
            </select>


            <input type="file" name="productImage" >
            <button type="submit" name="submit" class="btn-primary">Add Product</button>
        </form>



        <h3>Product List</h3>
        <div class="search">
            <form action="#" method="POST">
                <input type="text" id="productSearch" name="productSearch" placeholder="Search products..."
                    class="search-box" aria-label="Search products">
                <button type="submit" name="productSearchBtn" class="btn-primary">Search</button>
                <a href="product.php"><i class='bx bx-refresh  refresh'></i></a>
            </form>
        </div>
      
        <div class="table-container">
            <table class="table" aria-label="Product Table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th> 
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="productList">
                <?php
                    if (isset($_POST['productSearchBtn'])) {
                        $search = $_POST['productSearch'];
                        
                        $query = "SELECT * FROM products WHERE name LIKE '%$search%'";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['product_id'] . "</td>";
                                echo "<td><img src='../uploads/" . $row['image'] . "' alt='Product Image'></td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['description'] . "</td>"; 
                                echo "<td>" . $row['price'] . "</td>";
                                echo "<td>" . $row['stock'] . "</td>";
                                echo "<td>" . $row['category'] . "</td>";
                            
                                echo "<td>
                                        <button class='update'><a href='product_update.php?update_id=" . $row['product_id'] . "'><i class='bx bx-edit'></i></a></button>
                                        <button class='delete'><a href='product_delete.php?delete_id=" . $row['product_id'] . "'><i class='bx bx-trash'></i></a></button>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No Products Found</td></tr>"; 
                        }
                    } else {
                        $query = "SELECT * FROM products ORDER BY  CASE WHEN stock = 0 THEN 1 ELSE 2 END, product_id DESC;";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['product_id'] . "</td>";
                                echo "<td><img src='../uploads/" . $row['image'] . "' alt='Product Image' ></td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['description'] . "</td>";
                                echo "<td>" . $row['price'] . "</td>";
                                echo "<td>" . $row['stock'] . "</td>";
                                echo "<td>" . $row['category'] . "</td>";
                            
                                echo "<td>
                                        <button class='update'><a href='product_update.php?update_id=" . $row['product_id'] . "'><i class='bx bx-edit'> </i></a></button>
                                        <button class='delete'><a href='product_delete.php?delete_id=" . $row['product_id'] . "'><i class='bx bx-trash'> </i></a></button>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No Products Available</td></tr>";
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>

    </section>
    <script>
        function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        }
        document.getElementById('addProductBtn').addEventListener('click', function () {
            const form = document.getElementById('addProductForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        });

    </script>

    
</main>