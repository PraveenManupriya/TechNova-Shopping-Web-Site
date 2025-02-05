<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TECH NOVA</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">

</head>
<body>
<div class="alert">

    <div class="error">
    <?php
        if (isset($_GET['error']) && $_GET['error'] === "empty") {
            echo 'Please fill out all required fields!';
        }
        if (isset($_GET['error']) && $_GET['error'] === "invalid_email") {
            echo 'Invalid email address. Please try again!';
        }
      
        ?>

    </div>
</div>
    <div class="checkout-container">
        <div class="checkout-left">
            <div class="checkout-top">
                <div class="header-body">
                    <div class="logo">
                        <img src="logo.png" alt="logo">
                        <span>TECH NOVA</span>
                    </div>
                </div>
            </div>
            <form action="shipping-order-info.php" method="POST">
                <div class="checkout-body">

                    <h3>Shipping Infomation</h3>
                    
                    <input type="text" name="name" placeholder="Full Name">
                    <div class="form-middle">
                        <input type="text" name="email" placeholder="Email">
                        <input type="text" name="phone" placeholder="Phone">
                    </div>
                    <input type="text" name="country" placeholder="Country">
                    <div class="form-middle">
                        <input type="text" name="state" placeholder="State">
                        <input type="text" name="city" placeholder="City">
                    </div>
                    <input type="text" name="address" placeholder="Address">


                    <h3>Shipping Method</h3>
                    <div class="checkout-method">
                        <input type="radio" name="method" value="Free Shipping" checked><span> Delivery - <span class="bold">Free
                                Shipping</span></span>
                    </div>

                    <h3>Peyment Method</h3>
                    <div class="checkout-method">
                        <input type="radio" name="peyment" value="Cash on delivery (COD)"><span> Cash on delivery (COD)</span>
                        <p>Please pay money directly to the postman, If you choose cash on delivery method (COD)</p><br><br>
                        <input type="radio" name="peyment" value="Bank Transfer"><span> Bank Transfer</span>
                        <p>Please send money to our bank account ABC - 1234 234 45</p>
                    </div>

                </div>
                <div class="checkout-bottom">
                    <a href="view-cart.php">Back to cart</a>
                    <a href="#"><button type="submit" name="submit">Checkout</button></a>
                </div>
            </form>
        </div>


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

            if (mysqli_num_rows($order_result) > 0) {
                $total_price = 0;  
                $tax=0;
                $count=0;
            ?>

        <div class="chechout-right">
        <?php
                   $user_id = $_SESSION['user_id'];
                   $query = "SELECT * FROM cart WHERE user_id='$user_id'";
                   $result = mysqli_query($conn,$query);
       
                   if(mysqli_num_rows($result)>0){
                       while ($row = mysqli_fetch_assoc($result)) { 
                        $count += 1;
                       
                   ?>
            
                <?php
                }
               
            }
                   ?>
            <?php 
                   
                   while ($order = mysqli_fetch_assoc($order_result)) {
                       $subtotal = $order['quantity'] * $order['price'];
                       $total_price += $subtotal;
                       $tax += 5;
                    
                   ?>

            <div class="cart-detail">
                <div class="cart-top">
                    <div class="cart-img">
                        <img src="uploads/<?php echo $order['image'];?>" alt="product image">
                    </div>
                    <div class="cart-details">
                        <h4>
                            <?php echo $order['name'];?>
                        </h4>
                        <p>Qty : <span class="count">
                                <?php echo $order['quantity'];?>
                            </span></p>

                    </div>
                    <h4><span class="price">Rs.
                            <?php echo $subtotal?>.00
                        </span></h4>
                </div>

            </div>
            <?php
            }?>
            <div class="cart-body">
                <div class="item-price">
                    <p>Sub Total</p>
                    <span class="sub-total">Rs.
                        <?php echo $subtotal?>.00
                    </span>
                </div>
                <div class="item-price">
                    <p>Tax</p>
                    <span class="tax">Rs.
                        <?php echo $tax?>.00
                    </span>
                </div>
                <div class="item-price">
                    <p class="bold">Total</p>
                    <span class="total bold">Rs.
                        <?php echo $total_price + $tax?>.00
                    </span>
                </div>
            </div>

        </div>
        <?php }
                ?>
    </div>
</body>

</html>