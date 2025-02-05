
    <?php
       
        include "connection.php";
    
        if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) {
            $product_id = intval($_GET['product_id']);
        } else {
            $product_id = 0;
        }
    
        if ($product_id === 0) {
            echo "Product not found. Invalid product ID.";
            exit();
        }
    
        $sql = "SELECT * FROM products WHERE product_id = $product_id";
        $result = $conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            $product = $result->fetch_assoc();
        } else {
            echo "Product not found. Query returned 0 results.";
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="shortcut icon" href="logo.png" type="image/x-icon">
        <style>
            :root{
                --main-color:#ef2828;
                --second-color:#fff;
                --third-color:#3d3d3d;
                --main-font-color:#000;
                --second-font-color:#fff;
                --border-color: #08080838;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Roboto', sans-serif;
            }

            body {
                background-color: var(--second-color);
                color: var(--main-font-color);
            }

            .single-product-container {
                max-width: 1200px;
                margin: 60px auto;
                display: flex;
                flex-wrap: wrap;
                gap: 40px;
                padding: 40px;
                background-color: var(--second-color);
                border: 1px solid var(--border-color);
                border-radius: 12px;
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            }

            .single-product-gallery {
                flex: 1;
                width: 400px;
                height: 450px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .single-product-gallery img {
                max-width: 100%;
                height: 100%;
                object-fit: contain;
                padding: 20px;
                border: 1px solid var(--border-color);
                border-radius: 10px;
                transition: transform 0.3s ease-in-out;
            }

            .single-product-gallery img:hover {
                transform: scale(1.05);
            }

            .single-product-info {
                flex: 1;
                padding: 20px;
            }

            .single-product-info h2 {
                font-size: 32px;
                margin-bottom: 15px;
                color: var(--third-color);
            }

            .single-price {
                font-size: 28px;
                color: var(--main-color);
                font-weight: bold;
                margin-bottom: 20px;
            }

            .single-description {
                font-size: 16px;
                color: #4d4d4d;
                margin-bottom: 25px;
                line-height: 1.8;
            }

            .available-qty h5 {
                font-size: 18px;
                color: var(--third-color);
                margin-bottom: 10px;
            }

            .available-qty span {
                color: var(--main-color);
                font-weight: bold;
            }

            /* Buttons */
            .single-btn-spv {
                display: flex;
                gap: 20px;
                margin-top: 30px;
            }

            .single-add-to-cart,
            .single-buy-now {
                padding: 15px 25px;
                border: none;
                font-size: 18px;
                cursor: pointer;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                color: var(--second-font-color);
                transition: background-color 0.3s ease;
            }

            .single-add-to-cart {
                background-color: var(--main-color);
                box-shadow: 0 4px 10px rgba(255, 152, 35, 0.3);
            }
            .single-add-to-cart a{
                color: var(--second-font-color);
            }
            .single-buy-now {
                background-color: var(--third-color);
                box-shadow: 0 4px 10px rgba(61, 61, 61, 0.3);
            }

            .single-add-to-cart:hover {
                background-color:rgb(230, 0, 0);
                box-shadow: 0 6px 15px rgba(255, 152, 35, 0.4);
            }

            .single-buy-now:hover {
                background-color: #2c2c2c;
                box-shadow: 0 6px 15px rgba(61, 61, 61, 0.4);
            }

            .single-add-to-cart i,
            .single-buy-now i {
                font-size: 20px;
            }


            @media (max-width: 768px) {
                .single-product-container {
                    flex-direction: column;
                    text-align: center;
                }

                .single-btn-spv {
                    flex-direction: column;
                    gap: 15px;
                }
            }

        </style>
    </head>
    
    <body>
        <div class="shipping-header">
            <h3>Our Shop</h3>
            <span> < <a href="index.php" class="shipping-tag">Home</a></span>
        </div>

    <div class="single-product-container">
        <div class="single-product-gallery">
            <?php if (isset($product['image'])): ?>
                <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image" class="main-image">
            <?php else: ?>
                <p>Image not available.</p>
            <?php endif; ?>
        </div>
    
        <div class="single-product-info">
            <p class="single-price">
                LKR <?php echo isset($product['price']) ? htmlspecialchars($product['price']) : '0.00'; ?>
            </p>
    
            <h2><?php echo isset($product['name']) ? htmlspecialchars($product['name']) : 'Product Name Not Available'; ?></h2>
    
            <p class="single-description">
                <?php echo isset($product['description']) ? htmlspecialchars($product['description']) : 'No description available.'; ?>
            </p>
    
            <div class="available-qty">
                <h5>Available Quantity:
                    <span><?php echo isset($product['stock']) ? htmlspecialchars($product['stock']) : '0'; ?></span>
                </h5>
            </div>
        
            <div class="single-btn-spv">
                <?php echo "<a href='add-to-cart.php?product_id=" . $_GET['product_id'] . "'> <button class='single-add-to-cart'><i class='fa-solid fa-cart-plus'></i> Add to Cart </button></a>"?>
            </div>  
        </div>
    </div>
    </body>
    </html>