<?php
    include "connection.php";
    session_start();
 
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        $user_id = 0; 
    }
    
    $query = "SELECT * FROM users WHERE is_banned = 1 AND user_id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        
        $query = "UPDATE users SET is_logged_in = 0 WHERE user_id = '$user_id'";
        mysqli_query($conn, $query);

        header("Location: login.php");
        exit();
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TECH NOVA</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
</head>

<body>
    <!-- header -->
    <header class="header">
        <div class="header-top">

            <!-- <span><i class='bx bx-phone-call'></i>077-389-1726</span> -->

            <div class="info">

            <?php
                $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $image = $row['profile_picture'];
                    echo "<a href='user-profile.php'><img src='$image' alt='profile image' id='profile'></a>";
                }
                ?>

            <?php
            
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];

                $query = "SELECT * FROM users WHERE user_id ='$user_id'";
                $sresult = mysqli_query($conn, $query); 
                if (mysqli_num_rows($sresult) > 0) { 
                   
                    if ($row = mysqli_fetch_assoc($sresult)) { 
                    $username = $row['username'];
                    
            ?>
            <a href="user-profile.php"><?php echo $username;?></a>
                <a href="messages.php"><i class='bx bx-message' style="font-size: 20px;margin-top: 5px;margin-right: -17px"></i></a>
                <?php
                $query = "SELECT * FROM message WHERE user_id='$user_id'";
                $sresult = mysqli_query($conn, $query); 
                if (mysqli_num_rows($sresult) > 0) { 
                    $count = 0;
                    while ($row = mysqli_fetch_assoc($sresult)) { 
                        $count++;
                    }
                ?>
                <span class="cart-number">
                    <?php echo $count?>
                </span>
                <?php
                    }else{
                        echo '<span class="cart-number shipping">0</span>';
                    }
                    ?>

                
                <?php
                    }
                }?>
                <a href="logout.php" class="status">Logout</a>
                <a>ENG</a>
                 <a href="#" id="themeToggle">
                    <i class="bx bx-bulb" id="lightIcon"></i>
                    <i class="bx bx-moon" id="darkIcon" style="display: none;"></i>
                </a>
            <?php
            }else{
                echo '<a href="login.php">Login</a>
                <a>ENG</a>
                <a href="#" id="themeToggle">
                    <i class="bx bx-bulb" id="lightIcon"></i>
                    <i class="bx bx-moon" id="darkIcon" style="display: none;"></i>
                </a>';
                
            }
            ?>
            
                
            </div>
        </div>
        <div class="header-body">
            <div class="logo">
                <img src="logo.png" alt="logo">
                <span>TECH NOVA</span>
            </div>
            
            <h3><i class='bx bx-phone-call'></i>077-389-1726</h3>
        </div>

    </header>

    <div class="alert">
       
        <div class="success">
            
            <?php
                if (isset($_GET['success']) && $_GET['success'] === "login") {
                    echo  $row['username'] , '  Welcome to our website!' ;
                }
                if (isset($_GET['success']) && $_GET['success'] === "insertCart") {
                    echo 'Product added to cart successfully!';
                }
                if (isset($_GET['success']) && $_GET['success'] === "confirm") {
                    echo 'Order is successful! Please check your profile for details.';
                }
                if (isset($_GET['success']) && $_GET['success'] === "insert") {
                    echo 'Success! The item is now in your wishlist!';
                }
            ?>
          
        </div>

        <div class="error">
            
        <?php
            if (isset($_GET['success']) && $_GET['success'] === "removeItem") {
                echo 'Product removed from cart successfully!';
            }
            if (isset($_GET['success']) && $_GET['success'] === "outOfStock") {
                echo 'Sorry, the product is currently out of stock.';
            }
            if (isset($_GET['error']) && $_GET['error'] === "exsist") {
                echo 'Oops! You already have a wishlist with that name.';
            }
            if (isset($_GET['success']) && $_GET['success'] === "wishlist-deleted") {
                echo 'Your wishlist has been successfully deleted!';
            }
        ?>

        </div>
    </div>

    <div class="header-bottom">
        <div class="all-categary">
            <a href="#" id="categary">ALL CATEGORIES</a>
        </div>
        
        <div class="link">
            <a href="index.php">Home</a>
            <a href="#headphones">Products</a>
            <a href="product.php">Shop</a>
            <a href="contact.php">Contact Us</a>
        </div>

        <div class="shipping">
            <a href="#" id="wishlist-open"><i class='bx bx-heart'></i></a>
            <?php
                
                $query = "SELECT * FROM wishlist WHERE user_id='$user_id'";
                $sresult = mysqli_query($conn, $query); 
                if (mysqli_num_rows($sresult) > 0) { 
                    $count = 0;
                    while ($row = mysqli_fetch_assoc($sresult)) { 
                        $count++;
                    }

            ?>
            <span class="number"><?php echo $count?></span>
            <?php
                }else{
                    echo '<span class="number">0</span>';
                }
            ?>
            
            <a href="#" id="cart-open"><i class='bx bx-cart'></i></a>
            <?php
                $query = "SELECT * FROM cart";
                $sresult = mysqli_query($conn, $query); 
                if (mysqli_num_rows($sresult) > 0) { 
                    $count = 0;
                    while ($row = mysqli_fetch_assoc($sresult)) { 
                        $count++;
                    }
            ?>
            <span class="cart-number">
                <?php echo $count?>
            </span>
            <?php
                }else{
                    echo '<span class="cart-number">0</span>';
                }
                ?>
        </div>
        <div class="hamburger" id="hamburger-icon">
            <i class="bx bx-menu"></i>
        </div>

    </div>

    <!-- shiping cart -->
    <div class="cart" id="cart">
        <div class="cart-detail">
        <?php
            
        $query = "SELECT cart.quantity, products.name, products.price, products.image, products.product_id
            FROM cart
            JOIN products ON cart.product_id = products.product_id
            WHERE cart.user_id = '$user_id'
        ";
        
        $result = mysqli_query($conn, $query); 
        $total_price = 0; 
        $tax=0;
        
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) { 
                $subtotal = $row['quantity'] * $row['price'];
                $total_price += $subtotal;
                $tax += 5;
            ?>

            <div class="cart-top">
                <img src="uploads/<?php echo $row['image'];?>" alt="product image">
                <div class="cart-details">
                    <h4>
                        <?php echo $row['name'];?>
                    </h4>
                    <p><span class="count">
                            <?php echo $row['quantity'];?>
                        </span> x <span class="price">
                            <?php echo $row['price'];?>
                        </span></p>
                </div>
                <?php echo "<a href='cart-delete.php?product_id=" . $row['product_id'] . "'><i class='bx bx-trash'></i></a>" ?>
            </div>

            <div class="liner"></div>
            <?php 
            }
                  
        } else {
            echo ' <span>No product</span>';
        }
        ?>
        </div>

        <div class="cart-body">
            <div class="item-price">
                <p>Sub Total</p>
                <span class="sub-total">Rs.
                    <?php echo $total_price?>.00
                </span>
            </div>
            <div class="item-price">
                <p>Tax</p>
                <span class="tax">Rs.<?php echo $tax?>.00</span>
            </div>
            <div class="item-price">
                <p class="total">Total</p>
                <span class="total">Rs.
                    <?php echo $total_price + $tax?>.00
                </span>
            </div>
        </div>

        <div class="cart-bottom">
            <a href="view-cart.php">View Cart</a>
            <a href="Shipping-info.php">Checkout</a>
        </div>
    </div>

     <!-- wishlist cart -->
     <div class="wishlist-cart" id="wishlist-cart">
        <div class="cart-detail">
        <?php
            
        $user_id = $_SESSION['user_id'];
        $query = "SELECT wishlist.product_id, products.name, products.price, products.image, products.product_id
            FROM wishlist
            JOIN products ON wishlist.product_id = products.product_id
            WHERE wishlist.user_id = '$user_id'
        ";
        $result = mysqli_query($conn, $query); 
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) { 
               
            ?>

            <div class="cart-top">
                <img src="uploads/<?php echo $row['image'];?>" alt="product image">
                <div class="cart-details">
                    <h4>
                        <?php echo $row['name'];?>
                    </h4>
                    <p>
                        Rs.<?php echo $row['price'];?>
                    </p>
                    
                </div>
                <?php echo "<a href='wishlist-delete.php?product_id=" . $row['product_id'] . "'><i class='bx bx-trash'></i></a>" ?>
            </div>

            <div class="liner"></div>
            <?php 
            }
                  
        } else {
            echo ' <span>No wishlist</span>';
        }
        ?>
        </div>
    </div>



    <!-- categary cart -->
    <div class="home-container">

        <div class="categary-cart">
            <div class="categary-body">
                <ul></ul>
                <li><a href="#mobiles">Mobiles </a></li>
                <li><a href="#headphones">Headphones </a></li>
                <li><a href="#laptops">Laptops </a></li>
                <li><a href="#smartwatchs">Smartwatches </a></li>
                <li><a href="#tablets">Tablets </a></li>
                </ul>
            </div>
        </div>
        <div class="home-page">
            <div class="home-left">
                <span>Get up to 50% off today only!</span>
                <h2>TECH NOVA Collections</h2>
                <a href="product.php"><button>Shop Now</button></a>
            </div>
            <div class="home-right">
                <div class="home-image">
                    <img src="top_image.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- Categary -->
    <div class="categary-container">
        <div class="top-categaries">
            <div class="categary-up">
                
            <!-- Christmas Decoration -->
            <div class="floating-marquee">
                <img src="https://media.tenor.com/YErtpshgj7UAAAAi/santa-dance-santa-floss.gif" alt="Christmas Season" width="50%" height="200px">
            </div>
            <div class="christmas">
                <img src="images/christmas.png" alt="" width="100%" height="400px">
            </div>
            <div>
                <h1>Top Categories</h1>
                <p>Explore our best-selling categories, featuring top-quality products that meet your needs. 
                    From powerful laptops to immersive headphones, stylish smartwatches, and the latest mobile phones, 
                    these categories are favorites among our customers. Browse and find the perfect product for you today!.</p>
            </div>
            <div class="categary-scroll">
                <div class="categary-down">
                <?php
                $query = "SELECT * FROM categories";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)){
                ?>
                    <div class="categary">
                            <div class="categary-image">
                            <img src="uploads/<?php echo $row['image'];?>" alt="category image">
                            </div>
                            <span> <?php echo $row['name'];?></span>
                    </div>
                    <?php
                    }
                }?>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Product cart -->
    <div class="product product1" id="headphones">
        <h3>Discover Our Headphones</h3>
        <div class="product-item">
            <?php
            $query = "SELECT * FROM products WHERE category=1 LIMIT 4 ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="item">
                <div class="item-side">
                <?php
                    echo "<a href='add-to-cart.php?product_id=" . $row['product_id'] . " & category=" . $row['category'] . "'><i class='bx bxs-cart-alt'></i></a>
                        <a href='single-product-view.php?product_id=" . $row['product_id'] . "'><i class='bx bx-show-alt'></i></a>
                        <a href='add-wishlist.php?product_id=" . $row['product_id'] . "'><i class='bx bxs-heart'></i></a>";
                    ?>
                </div>
                <div class="item-image">
                    <img src="uploads/<?php echo $row['image'];?>" alt="product image">
                </div>
                <div class="item-detail">
                    <p>
                        <?php echo $row['name'];?>
                    </p>
                    <span>Rs.
                        <?php echo $row['price'];?>
                    </span>
                </div>
            </div>
            <?php }
                }?>
        </div>
    </div>


    <!-- Product cart -->
    <div class="product" id="mobiles">
        <h3>Discover Our Mobiles</h3>
        <div class="product-item">
            <?php
            $query = "SELECT * FROM products WHERE category=3 LIMIT 4 ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="item">
                <div class="item-side">
                <?php
                    echo "<a href='add-to-cart.php?product_id=" . $row['product_id'] . " & category=" . $row['category'] . "'><i class='bx bxs-cart-alt'></i></a>
                        <a href='single-product-view.php?product_id=" . $row['product_id'] . "'><i class='bx bx-show-alt'></i></a>
                        <a href='add-wishlist.php?product_id=" . $row['product_id'] . "'><i class='bx bxs-heart'></i></a>";
                    ?>
                </div>
                <div class="item-image">
                    <img src="uploads/<?php echo $row['image'];?>" alt="product image">
                </div>
                <div class="item-detail">
                    <p>
                        <?php echo $row['name'];?>
                    </p>
                    <span>Rs.
                        <?php echo $row['price'];?>
                    </span>
                </div>
            </div>
            <?php }
                }?>
        </div>
    </div>

    <!-- product cart show -->
    <div class="product-cart-container">
        <div class="product-cart" id="bg1">
            <div class="cart-left">
                <span>Headphones</span>
                <h3>Music</h3>
                <a href="product.php">View Collection</a>
            </div>
            <div class="cart-right">
                <img src="images/headphone collection/09.png" alt="">
            </div>
        </div>
        <div class="product-cart" id="bg2">
            <div class="cart-left">
                <span>Up To 35% OFF</span>
                <h3>Tablet</h3>
                <a href="product.php">View Collection</a>
            </div>
            <div class="cart-right">
                <img src="images/tablet collection/07.png" alt="">
            </div>
        </div>
        <div class="product-cart" id="bg3">
            <div class="cart-left">
                <span>Sale Offer 20% OFF This Week</span>
                <h3>Watch</h3>
                <a href="product.php">View Collection</a>
            </div>
            <div class="cart-right">
                <img src="images/smartwatch collection/12.png" alt="">
            </div>
        </div>
    </div>


    <!-- Product cart -->
    <div class="product" id="smartwatchs">
        <h3>Discover Our Smartwatchs</h3>
        <div class="product-item">
            <?php
            $query = "SELECT * FROM products WHERE category=2 LIMIT 4 ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="item">
                <div class="item-side">
                

                <?php
                    echo "<a href='add-to-cart.php?product_id=" . $row['product_id'] . " & category=" . $row['category'] . "'><i class='bx bxs-cart-alt'></i></a>
                        <a href='single-product-view.php?product_id=" . $row['product_id'] . "'><i class='bx bx-show-alt'></i></a>
                        <a href='add-wishlist.php?product_id=" . $row['product_id'] . "'><i class='bx bxs-heart'></i></a>";
                    ?>

                </div>
    
                <div class="item-image">
                    <img src="uploads/<?php echo $row['image'];?>" alt="product image">
                </div>
                <div class="item-detail">
                    <p>
                        <?php echo $row['name'];?>
                    </p>
                    <span>Rs.
                        <?php echo $row['price'];?>
                    </span>
                </div>
            </div>
            <?php }
                }?>
        </div>
    </div>

    <div class="product-banner">
        <div class="image-section">
            <img src="./images/mobile collection/11.png" alt="Smart">
        </div>
        <div class="content-section">
            <div class="product-category-top">
                <span class="liner"></span>
                <span class="category-text">Summer Collection</span>
            </div>
            <h1>Relish The Flavour of Fresh Warmth </h1>
            <p>Introducing our latest mobile phone – where cutting-edge technology meets sleek design. 
                With a stunning display, fast performance, and a long-lasting battery, 
                Experience the future of mobile technology with a phone that combines both style and substance.</p>
            <a href="product.php"><button class="shop-btn">Shop Now</button></a>
        </div>
    </div>

    <!-- Product cart -->
    <div class="product" id="tablets">
        <h3>Discover Our Tablets</h3>
        <div class="product-item">
            <?php
            $query = "SELECT * FROM products WHERE category=5 LIMIT 4 ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="item">
                <div class="item-side">
                <?php
                    echo "<a href='add-to-cart.php?product_id=" . $row['product_id'] . " & category=" . $row['category'] . "'><i class='bx bxs-cart-alt'></i></a>
                        <a href='single-product-view.php?product_id=" . $row['product_id'] . "'><i class='bx bx-show-alt'></i></a>
                        <a href='add-wishlist.php?product_id=" . $row['product_id'] . "'><i class='bx bxs-heart'></i></a>";
                    ?>
                </div>
                <div class="item-image">
                    <img src="uploads/<?php echo $row['image'];?>" alt="product image">
                </div>
                <div class="item-detail">
                    <p>
                        <?php echo $row['name'];?>
                    </p>
                    <span>Rs.
                        <?php echo $row['price'];?>
                    </span>
                </div>
            </div>
            <?php }
                }?>
        </div>
    </div>

    <!-- Product cart -->
    <div class="product" id="laptops">
        <h3>Discover Our Laptops</h3>
        <div class="product-item">
            <?php
            $query = "SELECT * FROM products WHERE category=4 LIMIT 4 ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="item">
                <div class="item-side">
                <?php
                    echo "<a href='add-to-cart.php?product_id=" . $row['product_id'] . " & category=" . $row['category'] . "'><i class='bx bxs-cart-alt'></i></a>
                        <a href='single-product-view.php?product_id=" . $row['product_id'] . "'><i class='bx bx-show-alt'></i></a>
                        <a href='add-wishlist.php?product_id=" . $row['product_id'] . "'><i class='bx bxs-heart'></i></a>";
                    ?>
                </div>
                <div class="item-image">
                    <img src="uploads/<?php echo $row['image'];?>" alt="product image">
                </div>
                <div class="item-detail">
                    <p>
                        <?php echo $row['name'];?>
                    </p>
                    <span>Rs.
                        <?php echo $row['price'];?>
                    </span>
                </div>
            </div>
            <?php }
                }?>
        </div>
    </div>


    <footer>
        <div class="footer-top">
            <img src="logo.png" alt="logo image" class="footer-logo">
            <h2>TECH NOVA</h2>
            <div class="footer-section-wrapper">
                <div class="footer-social">
                    <a>077 389 1726</a>
                </div>
                <div class="footer-social">
                    <a href="#">Facebook</a>
                </div>
                <div class="footer-social">
                    <a href="#">Twitter</a>
                </div>
            </div>

            <div class="footer-newsletter">
                <h3>Subscribe to our newsletter</h3>
                <form>
                    <input type="email" placeholder="Enter your email" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>

            <ul class="footer-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="product.php">Products</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Privacy Policy</a></li>
            </ul>
        </div>

        <div class="footer-bottom">
            <p>Copyright © 2024 Ecommerce. All rights reserved.</p>
        </div>
    </footer>

    
    
</body>
<script>


    document.getElementById('cart-open').addEventListener('click', function () {
        const submenu = document.getElementById('cart');


        if (submenu.style.display === "none") {
            submenu.style.display = "block";
        } else {
            submenu.style.display = "none";
        }

    });

    document.getElementById('wishlist-open').addEventListener('click', function () {
        const submenu = document.getElementById('wishlist-cart');


        if (submenu.style.display === "none") {
            submenu.style.display = "block";
        } else {
            submenu.style.display = "none";
        }

    });


    document.getElementById('themeToggle').addEventListener('click', function() {
    const body = document.body;
    const lightIcon = document.getElementById('lightIcon');
    const darkIcon = document.getElementById('darkIcon');

    // Toggle dark mode class
    body.classList.toggle('dark-mode');

    // Toggle the visibility of icons
    if (body.classList.contains('dark-mode')) {
        lightIcon.style.display = 'none';
        darkIcon.style.display = 'inline';
    } else {
        lightIcon.style.display = 'inline';
        darkIcon.style.display = 'none';
    }
});

</script>

<!-- Hamburger -->
<script>
    const hamburgerIcon = document.getElementById("hamburger-icon");
    const navLinks = document.querySelector(".header-bottom .link");

    hamburgerIcon.addEventListener("click", () => {
        navLinks.classList.toggle("show");
    });
</script>



</html>