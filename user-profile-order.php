<?php
 session_start();
 include "connection.php";
 $user_id = $_SESSION['user_id'];

?>
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
    <header class="header">
        <div class="header-body">
            <div class="logo">
                <img src="logo.png" alt="logo">
                <span>TECH NOVA</span>
            </div>
           
            <h3>077-389-1726</h3>
        </div>
    </header>
    
   

    <div class="shipping-header">
        <h3>Overview</h3>
        <span><a href="index.php" class="shipping-tag">Home</a> > <a href="user-profile.php">Account information</a>> <a href="user-profile-order.php">Order information</a></span>
    </div>

   
    <div class="account-information">
        <div class="user-cart">
            <div class="user-image">
                <img src="logo.png" alt="">
            </div>
            <div class="link">
                <a href="user-profile.php" class="active">Overview</a>
                <a href="user-orders.php">Orders</a>
                <a href="forgot_password.php">Change Password</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>

        <div class="order-information">
            <h2>Order Information</h2>
            <div class="order-top">
                <div class="order-head">
                <?php
                    $order_id = $_GET['order_id'];
                    $query = "SELECT * FROM orders";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                    ?>
                    <p class="bold">Order Number : #<?php echo $order_id?></p>
                    <p>Date : <?php echo $row['order_date']?></p>
                    <?php
                    }?>
                </div>
            </div>

            <?php
            
                $query = "SELECT * FROM users WHERE user_id='$user_id'";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                ?>
            <div class="order-body">
                <div class="information-container">
                    <h3>Customer Information</h3>
                    <p>Customer ID : #<?php echo $row['user_id']; ?></p>
                    <p>Name : <?php echo $row['name']; ?></p>
                    <p>Phone : <?php echo $row['phone']; ?></p>
                    <?php
                    
                    $query = "SELECT * FROM order_details WHERE user_id='$user_id'";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                    ?>
                    <p>Address : <?php echo $row['address']; ?></p>
                    <?php
                    }?>
                    
                </div>

                <div class="information-container">
                    <h3>Order Information</h3>
                    <?php
                        $order_id = $_GET['order_id']; 

                        $query = "SELECT *  FROM orders WHERE order_id = '$order_id' ";

                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            die("SQL Error: " . mysqli_error($conn));
                        }

                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            ?>
                            <p>Order Status : <span class="status"><?php echo htmlspecialchars($row['order_status']); ?></span></p>
                            <p>Payment Status : <span class="status"><?php echo htmlspecialchars($row['payment_status']); ?></span></p>
                            <p>Amount : Rs.<?php echo htmlspecialchars($row['total']); ?> (Discount)</p>
                            <?php
                        } else {
                            echo "<p>No order found with ID: $order_id</p>";
                        }
                        ?>


                </div>

                <div class="information-container">
                    <h3>Order Details</h3>
                    <div class="table-container">
                    <table>
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                    
                        $order_id = $_GET['order_id'] ; 

                        $query = "SELECT o.quantity, o.total, p.name, p.price, p.image, p.product_id
                                FROM orders o
                                JOIN products p ON o.product_id = p.product_id
                                WHERE o.order_id = '$order_id'";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                        
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['product_id']; ?></td>
                                <td><img src="uploads/<?php echo $row['image']; ?>" alt="Product Image" style="width:50px; height:auto;padding:5px;"></td>
                                <td><?php echo $row['name']; ?></td>
                                <td>Rs. <?php echo $row['price']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td class="bold">Rs. <?php echo $row['price'] * $row['quantity']; ?>.00</td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='6'>No products found for this order.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    </div>
                    <div class="order-bottom">

                        <a href="order_cancel.php?order_id=<?php echo $order_id?>"><button class="cancel">Cancel Order</button></a>
                        <a href="order_again.php?order_id=<?php echo $order_id?>"><button >Place Order Again</button></a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        } else {
            echo "<p>No user data found.</p>";
        }
    ?>
</body>
</html>
