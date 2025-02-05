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

<main class="main-content">

    <section id="products" class="section">
      
        <div class="table-container">
            <table class="table" aria-label="Product Table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th> 
                        <th>Product Name</th>
                        <th>Favorite Count</th>
                    </tr>
                </thead>
                <tbody id="productList">
                <?php

                $query = "SELECT 
                        wishlist.id AS wishlist_id, 
                        products.name AS product_name, 
                        products.image AS product_image,
                        COUNT(wishlist.product_id) AS favorites_count
                    FROM 
                        products 
                    INNER JOIN 
                        wishlist ON products.product_id = wishlist.product_id
                    GROUP BY 
                        products.product_id
                    ORDER BY 
                        favorites_count DESC;
                ";


                $result = mysqli_query($conn, $query);


                if (!$result) {
                    echo "Error: " . mysqli_error($conn);
                    exit; 
                }

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['wishlist_id'] . "</td>";
                        echo "<td><img src='../uploads/" . $row['product_image'] . "' alt='Product Image' style='width: 100px; height: auto;'></td>";
                        echo "<td>" . $row['product_name'] . "</td>";
                        echo "<td>" . $row['favorites_count'] . " favorites</td>";  
                    }
                } else {
                    echo "<tr><td colspan='4'>No products found</td></tr>";
                }
                ?>


                </tbody>
            </table>
        </div>

    </section>


    
</main>