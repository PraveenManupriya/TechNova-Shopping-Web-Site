<?php
session_start();
include 'connection.php';
$user_id = $_SESSION['user_id']; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$order_query = "SELECT cart.cart_id, products.product_id, products.image,products.name, cart.quantity, products.price, cart.added_at
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
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
</head>
<body>
    <header class="header">
        <div class="header-body">
            <div class="logo">
                <img src="logo.png" alt="logo">
                <span>TECH NOVA</span>
            </div>
            
            <h3>077-389-1726</h3>
        </div>
       
    </header>

    <div class="alert">
        <div class="success">
            <?php
                if (isset($_GET['success']) && $_GET['success'] === "updated") {
                    echo 'Quantity updated successfully!';
                }
               
                ?>
           
        </div>
    </div>

    <div class="alert">
        <div class="error">
            <?php
                if (isset($_GET['error']) && $_GET['error'] === "out_of_stock") {
                    echo 'Product is out of stock!';
                }
               
                ?>
           
        </div>
    </div>

    <div class="shipping-header">
        <h3>Shipping Cart</h3>
        <span><a href="index.php" class="shipping-tag">Home</a> > <a href="view-cart.php" >Shipping Cart</a></span>
    </div>

    <?php 
    if (mysqli_num_rows($order_result) > 0) {
        $total_price = 0;  
        $tax=0;
    ?>
    <div class="shipping-body">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>IMAGE</th>
                        <th>PRODUCT</th>
                        <th>PRICE</th>
                        <th>QUANTITY</th>
                        <th>TOTAL</th>
                        <th>REMOVE</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                   
                    while ($order = mysqli_fetch_assoc($order_result)) {
                        $subtotal = $order['quantity'] * $order['price'];
                        $total_price += $subtotal;
                        $tax += 5;
                    ?>
                    <tr>
                        <td><img src="uploads/<?php echo $order['image'];?>" alt="product image"></td>
                        <td><?php echo $order['name'];?></td>
                        <td class="bold">Rs.<?php echo $order['price'];?></td>
                        <td>
                        <form action="cart-update.php" method="POST"> 
                            <input type="hidden" name="product_id" value="<?php echo $order['product_id']; ?>">  
                            <input type="number" name="quantity" value="<?php echo $order['quantity']; ?>">
                            <button type="submit" name="submit">Update</button>
                        </form>

                        </td>
                        <td  class="bold">Rs.<?php echo $subtotal?>.00</td>
                        <td><?php echo "<a href='cart-delete.php?product_id=" . $order['product_id'] . "'><i class='bx bx-trash'></i></a>" ?></td>
                    </tr>
                    <?php } 
                    ?>
                  
                </tbody>
            </table>
        </div>
    </div>

    <div class="shipping-border">
        <div class="liner"></div>
    </div>

    <div class="shipping-bottom">
            <h3>Cart Totals</h3>
            <div class="cart-detail">
                <p>Sub Total :</p>
                <p>Rs.<?php echo $total_price?>.00</p>
            </div>
            <div class="cart-detail">
                <p>Tax :</p>
                <p>Rs.<?php echo $tax?>.00</p>
            </div>
            <div class="cart-detail">
                <p>Total (Shipping fees not included) :</p>
                <p class="bold">Rs.<?php echo $total_price+$tax?>.00</p>
            </div>
            <?php $_SESSION['total'] = $total_price+$tax?>
        <a href="Shipping-info.php"><button>Proceed to Checkout</button></a>
    </div>
    <?php
    }?>
</body>
</html>