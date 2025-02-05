<?php
include "connection.php";

$searchInput = mysqli_real_escape_string($conn, $_POST["search"]);

if (empty($searchInput)) {
    echo "<h5>Please enter a search term.</h5>";
    exit;
}

$query = "SELECT * FROM `products` WHERE `name` LIKE '%$searchInput%'";
$result = mysqli_query($conn, $query);
$num = mysqli_num_rows($result);

if ($num == 0) {
    echo "<h5>No results found</h5>";
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='product-item'>
                <div class='product-image'>
                    <img src='uploads/{$row['image']}' alt='product image'>
                </div>
                <div class='product-details'>
                    <h3>{$row['name']}</h3>
                    <span class='des'>{$row['description']}</span>
                    <p>Rs. {$row['price']}.00</p>
                    <div class='product-text'>
                        <div class='cart-button'>
                            <button class='add-to-cart'><a href='add-to-cart.php?product_id={$row['product_id']}'><i class='fa-solid fa-cart-plus'></i></a></button>
                            <a href='single-product-view.php?product_id={$row['product_id']}' class='view'><i class='fa-solid fa-circle-info'></i></a>
                        </div>
                    </div>
                </div>
            </div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
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
    </style>
</head>

</html>
