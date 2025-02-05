<?php include "sidebar.php"; ?>
<style>
:root{
    --btn-color: #16a085;
    --btn-color-hover:  #2c3e50;
}
 .btn{
    display: block;
    text-decoration: none;
    color: #fff;
    font-weight: 600;
    background-color: var(--btn-color);
    text-align: center;
    padding: 10px;
    transition: 0.3s ease-in-out;
    border-radius: 10px;
 }
 .btn:hover{
    background-color: var(--btn-color-hover);
 }

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

<div class="alert">
    <div class="success">
        <?php
            if (isset($_GET['success']) && $_GET['success'] === "confirm") {
                echo 'order is currently being processed!';
            }
            if (isset($_GET['success']) && $_GET['success'] === "paymented") {
                echo ' payment has been successfully processed!';
            }
            if (isset($_GET['success']) && $_GET['success'] === "delivered") {
                echo ' order has been successfully delivered!';

            }
            if (isset($_GET['success']) && $_GET['success'] === "sendmail") {
                echo ' email has been successfully sent!';

            }
            ?>
    
    </div>
    <div class="error">
    <?php
        if (isset($_GET['error']) && $_GET['error'] === "empty") {
            echo 'Please fill out all required fields!';
        }
     
        ?>

    </div>
</div>
<main class="main-content">
    <section id="orders" class="section">
        <h2>Manage Orders</h2>

        <!-- Search Form -->
        <h3>Order List</h3>
        <div class="search">
            <form action="#" method="POST">
                <input type="text" id="orderSearch" name="orderSearch" placeholder="Search orders..." class="search-box"
                    aria-label="Search orders">
                <button type="submit" name="orderSearchBtn" class="btn-primary">Search</button>
                <a href="order.php"><i class='bx bx-refresh  refresh'></i></a>
            </form>
        </div>

        <!-- Orders Table -->
        <div class="table-container">
            <table class="table" aria-label="Orders Table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Order Date</th>
                        <th>User</th>
                        <th>Payment Method</th>
                        <th>Delivery Address</th>         
                        <th>Confirm Order</th> 
                        <th>Pending Payment</th>
                        <th>Delivery</th>
                        <th>Send Mail</th>
                        <th>Order Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $searchQuery = '';


                    if (isset($_POST['orderSearchBtn'])) {
                        $searchTerm = mysqli_real_escape_string($conn, $_POST['orderSearch']); 
                        $searchQuery = " AND (p.name LIKE '%$searchTerm%' OR u.username LIKE '%$searchTerm%')";
                    }
                    
                    $query1 = "SELECT o.order_id, o.id, p.name AS product_name, p.image,d.payment_method,d.address, o.quantity,o.order_date,o.is_mail, o.order_date,o.confirm, o.order_status, o.payment_status, u.username, u.email 
                               FROM orders AS o
                               JOIN products AS p ON o.product_id = p.product_id 
                               JOIN users AS u ON o.user_id = u.user_id 
                               JOIN order_details AS d ON o.order_id = d.order_id
                               WHERE 1=1 $searchQuery
                               ORDER BY o.order_status = 'Pending' DESC, o.id DESC";
        

                    $result1 = mysqli_query($conn, $query1);

                    if (mysqli_num_rows($result1) > 0) {
                        while ($row = mysqli_fetch_assoc($result1)) {
                            $order_status = $row['order_status'];
                            $payment_status = $row['payment_status'];
                           

                            echo "<tr>";
                            echo "<td><img src='../uploads/" . $row['image'] . "' alt='Product Image'></td>";
                            echo "<td>" . $row['product_name'] . "</td>";
                            echo "<td>" . $row['quantity'] . "</td>";
                            echo "<td>" . $row['order_date'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['payment_method'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";

                            echo "<td> 
                                    <a href='order_confirm.php?order_id=" . $row['order_id'] . "' class='btn' >$order_status</a>
                                </td>";
                            echo "<td>  
                                    <a href='payment_confirm.php?order_id=" . $row['order_id'] . "' class='btn'>$payment_status</a>
                            </td>";
                            echo "<td>  
                                <a href='delivery.php?order_id=" . $row['order_id'] . "' class='btn'>$order_status</a>
                            </td>"; 
                            

                            echo "<td>  
                            <a href='send_email.php?order_id=" . $row['order_id'] . "' class='btn'>" . ($row['is_mail']  ? "Sended" : "Send") . " </a>
                            </td>";
                           
                            echo "<td>" . $row['confirm'] . "</td>";

                            echo "</tr>";

                            }
                            } else {
                                echo "<tr><td colspan='6'>No orders found.</td></tr>";
                            }
                            ?>

                </tbody>
            </table>
        </div>
      
    </section>
</main>