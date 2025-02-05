<?php
session_start();

include 'connection.php';
$user_id = $_SESSION['user_id']; 


$order_query = "SELECT cart.cart_id, products.product_id, products.name, cart.quantity, products.price, cart.added_at
    FROM cart
    JOIN products ON cart.product_id = products.product_id
    WHERE cart.user_id = '$user_id'
    ORDER BY cart.added_at DESC";

$order_result = mysqli_query($conn, $order_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TECH NOVA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
</head>
<body>


<div class="order-success-container">
    <h1>Thank You for Your Order!</h1>

    <?php 
    // Only display the order summary if there are orders
    if (mysqli_num_rows($order_result) > 0) {
        $total_price = 0;  // Variable to calculate the total price
    ?>
        <p>Your order has been placed successfully. Below is a summary of your order:</p>

        <div class="order-summary">
            <h2>Order Summary</h2>
            <table>
                <thead>
                    <tr>
                    
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price (Rs.)</th>
                        <th>Subtotal (Rs.)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Loop through the order results and display them
                    while ($order = mysqli_fetch_assoc($order_result)) {
                        $subtotal = $order['quantity'] * $order['price'];
                        $total_price += $subtotal;
                    ?>
                    <tr>
                        
                        <td><?php echo htmlspecialchars($order['name']); ?></td>
                        <td>
                            <form action="cart_update.php" method="POST" style="display:inline;">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($order['product_id']); ?>">
                                <input type="number" name="quantity" value="<?php echo htmlspecialchars($order['quantity']); ?>" min="1" required>
                                <input type="submit" name="update_quantity" value="Update">
                            </form>
                        </td>
                        <td><?php echo number_format($order['price'], 2); ?></td>
                        <td><?php echo number_format($subtotal, 2); ?></td>
                        <td>
                            <form action="cart_delete.php" method="POST" style="display:inline;">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($order['product_id']); ?>">
                                <input type="submit" name="remove" value="Remove">
                            </form>
                        </td>
                    </tr>
                    <?php } // End while ?>
                </tbody>
            </table>

            <h3 class="total">Total Price: Rs. <?php echo number_format($total_price, 2); ?></h3>
           
        </div>
    <?php 
    } 
    ?>
           

    <a href="cart_clear.php" class="continue">Checkout</a>
</div>

</body>
</html>
