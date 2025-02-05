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
            if (isset($_GET['success']) && $_GET['success'] === "category_insert") {
                echo 'The category has been successfully added!';
            }
            if (isset($_GET['success']) && $_GET['success'] === "categories_update") {
                echo 'Success! Your category has been updated!';
            }
            if (isset($_GET['success']) && $_GET['success'] === "deleted") {
                echo 'Success! The category has been deleted!';
            }
            ?>
    
    </div>
    <div class="error">
    <?php
        if (isset($_GET['error']) && $_GET['error'] === "empty") {
            echo 'Please fill out all required fields!';
        }
        if (isset($_GET['error']) && $_GET['error'] === "category_exists") {
            echo 'The category you are trying to add already exists!';
        }
        if (isset($_GET['error']) && $_GET['error'] === "update_failed") {
            echo 'The category update was unsuccessful. Please try again.';
        }
        ?>

    </div>
</div>
<main class="main-content">
    <section id="products" class="section">
        <h2>Manage Categories</h2>
        <button id="addCategoryBtn" class="btn-primary" aria-controls="addCategoryForm">Add New Categories</button>
        <form id="addCategoryForm" method="POST" style="display:none;" action="add_category.php"
             class="form-inline" enctype="multipart/form-data">
            <input type="text" name="categoryName" placeholder="Category Name" >
            <input type="file" name="categoryImage" >
            <button type="submit" name="submit" class="btn-primary">Add Category</button>
        </form>



        <h3>Category List</h3>
        <div class="search">
            <form action="#" method="POST">
                <input type="text" id="categorySearch" name="categorySearch" placeholder="Search category..."
                    class="search-box" aria-label="Search category">
                <button type="submit" name="categorySearchBtn" class="btn-primary">Search</button>
                <a href="categories.php"><i class='bx bx-refresh  refresh'></i></a>
            </form>
        </div>
        <span class="display_success">
        <?php
            if(isset($_GET['success'])){
                if($_GET['success']=="deleted"){
                    echo 'Delete Successful';
                }
            }
            ?>
        </span>
        <div class="table-container">
            <table class="table" aria-label="Product Table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th> 
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="productList">
                <?php
                    if (isset($_POST['categorySearchBtn'])) {
                        $search = $_POST['categorySearch'];
                        
                        $query = "SELECT * FROM categories WHERE name LIKE '%$search%'";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td><img src='../uploads/" . $row['image'] . "' alt='category Image'></td>";
                                echo "<td>" . $row['name'] . "</td>";
                               
                            
                                echo "<td>
                                        <button class='update'><a href='category_update.php?update_id=" . $row['id'] . "'><i class='bx bx-edit'></i></a></button>
                                        <button class='delete'><a href='category_delete.php?delete_id=" . $row['id'] . "'><i class='bx bx-trash'></i></a></button>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No Products Found</td></tr>"; 
                        }
                    } else {
                        $query = "SELECT * FROM categories ORDER BY id DESC";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td><img src='../uploads/" . $row['image'] . "' alt='category Image' ></td>";
                                echo "<td>" . $row['name'] . "</td>";
                            
                                echo "<td>
                                        <button class='update'><a href='category_update.php?update_id=" . $row['id'] . "'><i class='bx bx-edit'> </i></a></button>
                                        <button class='delete'><a href='category_delete.php?delete_id=" . $row['id'] . "'><i class='bx bx-trash'> </i></a></button>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No Category Available</td></tr>";
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
        document.getElementById('addCategoryBtn').addEventListener('click', function () {
            const form = document.getElementById('addCategoryForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        });

    </script>
</main>