<?php
 session_start();
 include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TECH NOVA</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<div class="alert">
    <div class="success">
        <?php
            if (isset($_GET['error']) && $_GET['error'] === "success") {
                echo 'Your information has been successfully updated!';
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
            <?php 
           
            $user_id = $_SESSION['user_id'];
            $query = "SELECT * FROM order_details WHERE user_id='$user_id' ORDER BY order_id DESC LIMIT 1";
            $result = mysqli_query($conn,$query);

            if(mysqli_num_rows($result)>0){
                if ($row = mysqli_fetch_assoc($result)) { 
                 
                
            ?>
            <div class="checkout-body">
                <div class="container-top">
                        <i class='bx bxs-check-circle'></i>
                        <h4>Your order is successfully placed <p>Thank you for purchasing our products!</p></h4>
                        
                </div>
               
                <div class="container-body">
                    <h2>Customer information</h2>
                    <p>Full Name : <span><?php echo $row['name']?></span></p>
                    <p>Phone : <span><?php echo $row['phone']?></span></p>
                    <p>Email : <span><?php echo $row['email']?></span></p>
                    <p>Address : <span><?php echo $row['address']?></span></p>
                    <p>Shipping Method : <span>Delivery -<span class="bold"><?php echo $row['shipping_method']?></span></span></p>
                    <p>Payment Method : <span><?php echo $row['payment_method']?></span></p>
                    <p>Shipping Status : <span class="status"><?php echo $row['order_status']?></span></p>
                </div>
            </div>
            <?php
                }
            }?>
            <a href="shipping-continue.php"><button>Continue Shipping</button></a>
        </div>
       

        <div class="chechout-right">
            <?php
            $user_id = $_SESSION['user_id'];
            $query = "SELECT * FROM order_details WHERE user_id='$user_id' ORDER BY order_id DESC LIMIT 1";
            $result = mysqli_query($conn,$query);

            if(mysqli_num_rows($result)>0){
                if ($row = mysqli_fetch_assoc($result)) { 
                 
                
            ?>
            
            <h3>Order number : # <?php echo $row['order_id'];?></h3>
            <?php
                }
                }?>
                
            <?php
            $user_id = $_SESSION['user_id'];
            $query = "SELECT cart.quantity, products.name, products.price, products.image, products.product_id
                FROM cart
                JOIN products ON cart.product_id = products.product_id
                WHERE cart.user_id = '$user_id'
            ";
            
            $result = mysqli_query($conn, $query); 
            $total_price = 0; 
            $tax=0;
            $discount=0;
            $shipping_fee = 0;
        
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) { 
                $subtotal = $row['quantity'] * $row['price'];
                $total_price += $subtotal;
                $tax += 5;
                $discount = 2;
                $shipping_fee = 0;
            ?>
            <div class="cart-detail">
                <div class="cart-top">
                    <div class="cart-img">
                    <img src="uploads/<?php echo $row['image'];?>" alt="product image">
                    </div>
                    <div class="cart-details">
                        <h4><?php echo $row['name'];?></h4>
                        <span>Quantity : <span class="count"><?php echo $row['quantity'];?></span></span>
                        
                    </div>
                    <h4><span class="price">Rs.<?php echo $subtotal;?>.00</span></h4>
                </div>
                
                <?php 
            }
        } else {
            echo ' <span>No product</span>';
        }
        ?>
               
            </div>
        
            <div class="cart-body">
                <div class="item-price">
                    <p>Sub Total : </p>
                    <span class="sub-total">Rs.<?php echo $total_price;?>.00</span>
                </div>
                <div class="item-price">
                    <p>Shipping fee : </p>
                    <span class="tax">Rs.<?php echo $shipping_fee;?>.00</span>
                </div>
                <div class="item-price">
                    <p>Discount : </p>
                    <span class="discount"><?php echo $discount;?>%</span>
                </div>
                <div class="item-price">
                    <p>Tax : </p>
                    <span class="tax">Rs.<?php echo $tax;?>.00</span>
                </div>
                <div class="item-price">
                    <p class="bold">Total</p>
                    <span class="total bold">Rs.<?php echo ($total_price +$tax)- 100 * $discount;?>.00</span>
                </div>
            </div>

        </div>

    </div>
</body>

</html>