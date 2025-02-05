<?php
    include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TECH NOVA </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            border: none;
            outline: none;
            font-family: 'Poppins', sans-serif;
            list-style: none;
        }

        :root {
            --main-color:#ef2828;
            --second-color: #fff;
            --third-color: #3d3d3d;
            --main-font-color: #000;
            --second-font-color: #fff;
            --border-color: #08080838;
        }


        .product-categories {
            width: 100%;
            background-color: var(--second-color);
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 60px;
            color: var(--main-color);
        }

        .product-categories #categoryList{
            margin-top: -25px;
        }
        .product-categories h2 {
            font-size: 20px;
            margin-right: 40px;
        }

        .product-categories ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .product-categories li {
            margin: 0 15px;

        }

        .product-categories li a {
            text-decoration: none;
            color: var(--main-font-color);
            font-size: 16px;
        }

        .product-categories li a:hover {
            color: var(--main-color);
        }


        .products-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin-top: 10px;
            padding: 20px;

        }

        .product-item {
            background-color: var(--second-color);
            border-radius: 10px;
            border: 1px solid var(--border-color);
            text-align: center;
        }

        .product-item:hover {
            box-shadow: 0px 0px 10px rgba(16, 16, 16, 0.186);
        }

        .product-item img {
            width: 100%;
            height: 200px;
            object-fit: contain;
            border-radius: 10px;
            padding: 15px 60px;

        }

        .product-details {
            width: 100%;
            background-color: var(--bg-color);
            padding: 10px;
        }

        .product-item h3 {
            margin: 5px 0;
            font-size: 20px;
            color: var(--font-color);
        }

        .product-item p {
            font-size: 18px;
            font-weight: 600;
            color: var(--main-color);
        }

        .product-item span {
            font-size: 13px;
            margin: 5px;

        }

        .cart-button {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 30px;

        }

        .cart-button button {
            background: none;
        }

        .cart-button i {
            font-size: 18px;
            color: var(--third-color);
            transition: all 0.3s ease-in-out;
        }

        .cart-button i:hover {
            transform: scale(1.2);
            color: var(--main-color);
        }

        .product-item .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: var(--second-color);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 12px;
        }

        .product-item .btn:hover {
            background-color: var(--main_color);
        }

        .product-item {
            display: block;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .product-item[style*="display: none"] {
            opacity: 0;
            visibility: hidden;
        }


        /* Search Bar CSS */
        /* .search-bar {
            position: relative;
            margin-top: 25px;
            display: flex;
            justify-content: center;
        } */

        .search-bar {
            position: sticky;
            top: 120px; 
            display: flex;
            justify-content: center;
            background-color: var(--second-color); 
            padding: 10px;
            z-index: 10;
           
        }

        /* #searchInput {
            width: 100%;
            max-width: 400px;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
        } */

        #searchInput {
            width: 100%;
            max-width: 450px;
            padding: 10px;
            border: 1px solid var(--border-color, #ccc);
            border-radius: 5px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        #searchInput:focus {
            border-color: var(--main-color);
            box-shadow: 0 0 5px rgba(255, 215, 0, 0.5);
        }

        #searchInput::placeholder {
            color: var(--placeholder-color, #aaa);
        }


        .search-bar button {
            background-color: var(--main-color);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .search-bar button:hover {
            background-color: var(--hover-color, #e57d1f); /* Darker shade of #ff9823 for hover */
            transform: scale(1.05);
        }

        .search-bar button:active {
            background-color: var(--active-color, #cc6f1b); /* Even darker shade for active */
            transform: scale(0.95);
        }

        @media (max-width: 1200px) {
        .products-grid {
            grid-template-columns: repeat(4, 1fr);
        }

        .product-categories h2 {
            font-size: 18px;
        }

        .product-categories ul {
            flex-direction: column;
            align-items: flex-start;
        }

        .product-categories li {
            margin: 10px 0;
        }

        .product-categories li a {
            font-size: 14px;
        }
    }

    @media (max-width: 992px) {
        .products-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .product-categories h2 {
            font-size: 16px;
        }

        .product-categories li a {
            font-size: 14px;
        }

        #searchInput {
            max-width: 350px;
        }

        .search-bar button {
            font-size: 14px;
            padding: 10px 18px;
        }
    }

    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .product-categories {
            padding: 8px;
        }

        .product-categories h2 {
            font-size: 14px;
        }

        .product-categories ul {
            flex-direction: column;
            align-items: flex-start;
        }

        .product-categories li {
            margin: 8px 0;
        }

        .product-categories li a {
            font-size: 12px;
        }

        #searchInput {
            max-width: 300px;
        }

        .search-bar button {
            font-size: 14px;
            padding: 10px 18px;
        }
    }

    @media (max-width: 576px) {
        .products-grid {
            grid-template-columns: 1fr;
        }

        .product-categories h2 {
            font-size: 14px;
        }

        .product-categories li {
            margin: 5px 0;
        }

        .product-categories li a {
            font-size: 12px;
        }

        #searchInput {
            max-width: 250px;
        }

        .search-bar button {
            font-size: 14px;
            padding: 10px 16px;
        }

        .cart-button {
            flex-direction: column;
            align-items: flex-start;
        }

        .cart-button button {
            margin-top: 10px;
        }
    }

    .hamburger-icon {
        display: none; 
        font-size: 30px;
        cursor: pointer;
        margin-bottom: 10px;
    }

    @media (max-width: 768px) {
        .hamburger-icon {
            display: block; 
        }

        .product-categories ul {
            display: none; 
            flex-direction: column; 
            align-items: flex-start;
        }

        .product-categories ul.active {
            display: block; 
        }
    }

.refresh{
    font-size: 40px;
    color: var(--main-color);
    margin-left: 8px;
    margin-top: 5px;
}
.bx-show-alt{
    font-size: 40px;
}
</style>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>


    <main>
        <div class="shipping-header">
            <h3>TECH NOVA</h3>
            <span><a href="index.php" class="shipping-tag">Home</a> > <a href="product.php">Shop</a></span>
        </div>
        <!-- <section class="product-categories">
            <ul>
                <h2>Categories</h2>
                <li><a href="#" onclick="filterProducts('all')">All Products</a></li>
                <li><a href="#" onclick="filterProducts('mobiles')">Mobiles</a></li>
                <li><a href="#" onclick="filterProducts('headphones')">Headphones</a></li>
                <li><a href="#" onclick="filterProducts('laptops')">Laptops</a></li>
                <li><a href="#" onclick="filterProducts('smartwatchs')">Smart Watches</a></li>
                <li><a href="#" onclick="filterProducts('tablets')">Tablets</a></li>
            </ul>
        </section> -->

        <section class="product-categories">
            <div class="hamburger-icon" onclick="toggleMenu()">&#9776;</div> <!-- Hamburger Icon -->
            <h2>Categories</h2>
            <ul id="categoryList">
                <li><a href="#" onclick="filterProducts('all')">All Products</a></li>
                <li><a href="#" onclick="filterProducts('mobiles')">Mobiles</a></li>
                <li><a href="#" onclick="filterProducts('headphones')">Headphones</a></li>
                <li><a href="#" onclick="filterProducts('laptops')">Laptops</a></li>
                <li><a href="#" onclick="filterProducts('smartwatchs')">Smart Watches</a></li>
                <li><a href="#" onclick="filterProducts('tablets')">Tablets</a></li>
            </ul>
        </section>


        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search for products">
            <button onclick="searchProduct(document.getElementById('searchInput').value)">Search</button>
            <a href="product.php"><i class='bx bx-refresh  refresh'></i></a>
        </div>

        <section class="products-grid" id="products-grid">
            <?php
                $query = "SELECT * FROM products WHERE category=3 ";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
            <div class="product-item" data-category="mobiles">
                <div class="product-image">
                    <img src="uploads/<?php echo $row['image'];?>" alt="product image">
                </div>
                <div class="product-details">
                    <h3>
                        <?php echo $row['name'];?>
                    </h3>
                    <span class="des">
                        <?php echo $row['description'];?>
                    </span>
                    <p>Rs.
                        <?php echo $row['price'];?>.00
                    </p>
                    <div class="product-text">
                        <div class="cart-button">
                        <?php
                                echo "<button class='add-to-cart'><a href='add-to-cart.php?product_id=" . $row['product_id'] . " & category=" . $row['category'] . "'><i class='fa-solid fa-cart-plus'></i></a></button>
                                <a href='single-product-view.php?product_id=" . $row['product_id'] . "' class='view'><i class='bx bx-show-alt' ></i></a>";
                            ?>

                        </div>
                    </div>
                </div>

            </div>
            <?php
                    }
                }?>


            <?php
                $query = "SELECT * FROM products WHERE category=1 ";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
            <div class="product-item" data-category="headphones">
                <div class="product-image">
                    <img src="uploads/<?php echo $row['image'];?>" alt="product image">
                </div>
                <div class="product-details">
                    <h3>
                        <?php echo $row['name'];?>
                    </h3>
                    <span class="des">
                        <?php echo $row['description'];?>
                    </span>
                    <p>Rs.
                        <?php echo $row['price'];?>.00
                    </p>
                    <div class="product-text">
                        <div class="cart-button">
                        <?php
                                echo "<button class='add-to-cart'><a href='add-to-cart.php?product_id=" . $row['product_id'] . " & category=" . $row['category'] . "'><i class='fa-solid fa-cart-plus'></i></a></button>
                                <a href='single-product-view.php?product_id=" . $row['product_id'] . "' class='view'><i class='bx bx-show-alt'></i></a>";
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php
                    }
                }?>


            <?php
                $query = "SELECT * FROM products WHERE category=4 ";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
            <div class="product-item" data-category="laptops">
                <div class="product-image">
                    <img src="uploads/<?php echo $row['image'];?>" alt="product image">
                </div>
                <div class="product-details">
                    <h3>
                        <?php echo $row['name'];?>
                    </h3>
                    <span class="des">
                        <?php echo $row['description'];?>
                    </span>
                    <p>Rs.
                        <?php echo $row['price'];?>.00
                    </p>
                    <div class="product-text">
                        <div class="cart-button">
                        <?php
                                echo "<button class='add-to-cart'><a href='add-to-cart.php?product_id=" . $row['product_id'] . " & category=" . $row['category'] . "'><i class='fa-solid fa-cart-plus'></i></a></button>
                                <a href='single-product-view.php?product_id=" . $row['product_id'] . "' class='view'><i class='bx bx-show-alt'></i></a>";
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php
                    }
                }?>


            <?php
                $query = "SELECT * FROM products WHERE category=2 ";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
            <div class="product-item" data-category="smartwatchs">
                <div class="product-image">
                    <img src="uploads/<?php echo $row['image'];?>" alt="product image">
                </div>
                <div class="product-details">
                    <h3>
                        <?php echo $row['name'];?>
                    </h3>
                    <span class="des">
                        <?php echo $row['description'];?>
                    </span>
                    <p>Rs.
                        <?php echo $row['price'];?>.00
                    </p>
                    <div class="product-text">
                        <div class="cart-button">
                            <?php
                                echo "<button class='add-to-cart'><a href='add-to-cart.php?product_id=" . $row['product_id'] . " & category=" . $row['category'] . "'><i class='fa-solid fa-cart-plus'></i></a></button>
                                <a href='single-product-view.php?product_id=" . $row['product_id'] . "' class='view'><i class='bx bx-show-alt'></i></a>";
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php
                    }
                }?>


            <?php
                $query = "SELECT * FROM products WHERE category=5 ";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
            <div class="product-item" data-category="tablets">
                <div class="product-image">
                    <img src="uploads/<?php echo $row['image'];?>" alt="product image">
                </div>
                <div class="product-details">
                    <h3>
                        <?php echo $row['name'];?>
                    </h3>
                    <span class="des">
                        <?php echo $row['description'];?>
                    </span>
                    <p>Rs.
                        <?php echo $row['price'];?>.00
                    </p>
                    <div class="product-text">
                        <div class="cart-button">
                        <?php
                                echo "<button class='add-to-cart'><a href='add-to-cart.php?product_id=" . $row['product_id'] . " & category=" . $row['category'] . "'><i class='fa-solid fa-cart-plus'></i></a></button>
                                <a href='single-product-view.php?product_id=" . $row['product_id'] . "' class='view'><i class='bx bx-show-alt'></i></i></a>";
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php
                    }
                }?>

        </section>

    </main>



  

    <script>
        function filterProducts(category) {
            const products = document.querySelectorAll('.product-item');
            products.forEach(product => {
                if (category === 'all' || product.dataset.category === category) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }

        window.onload = () => {
            filterProducts('all');
        };

        // function searchProduct(x){
        //     var searchInput = document.getElementById("searchInput");

        //     var form = new FormData();
        //     form.append("search", searchInput.value);

        //     var request = new XMLHttpRequest();
        //     request.onreadystatechange = function(){
        //         if(request.readyState == 4 && request.status == 200){
        //             var response =request.responseText;
        //             alert(response);
        //         }
        //     };

        //     request.open("POST", "searchProductProcess.php", true);
        //     request.send(form);
        // }

        function searchProduct() {
            var searchInput = document.getElementById("searchInput").value;

            var form = new FormData();
            form.append("search", searchInput);

            var request = new XMLHttpRequest();
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    document.getElementById("products-grid").innerHTML = request.responseText;
                }
            };

            request.open("POST", "searchProductProcess.php", true);
            request.send(form);
        }

        // function to display the menu by hamburger
        function toggleMenu() {
            var categoryList = document.getElementById('categoryList');
            categoryList.classList.toggle('active');
        }

    </script>
    <script src="script.js"></script>
</body>

</html>