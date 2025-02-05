<?php
    include "../connection.php";
   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TECH NOVA</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../logo.png" type="image/x-icon">
    <style>
        .number{
            position: absolute;
            width: 23px;
            height: 23px;
            background-color: rgb(0, 0, 11);
            box-shadow: 5px 4px 10px rgba(220, 220, 220, 0.29);
            text-align: center;
            border-radius: 50%;
            margin-top: -10px;
            font-size: 14px;
        }
        i{
            font-size: 18px;
            margin: 0 10px;
        }
    </style>
</head>

<body>
    <nav class="sidebar" aria-label="Admin Navigation">
        <h2>TECH NOVA Panel</h2>

        <ul role="navigation">
            <li><a href="index.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="administrators.php"><i class='bx bxs-user'></i>Administrators</a></li>
            <li><a href="user.php"><i class='bx bxs-group'></i>Customers</a></li>
            <li><a href="categories.php"><i class='bx bx-category-alt' ></i> Categories</a></li>
            <li><a href="product.php"><i class='bx bxs-shopping-bag' ></i> Products
            <?php
                $query = "SELECT * FROM products WHERE stock = 0";
                $sresult = mysqli_query($conn, $query); 
                if (mysqli_num_rows($sresult) > 0) { 
                    $count = 0;
                    while ($row = mysqli_fetch_assoc($sresult)) { 
                        $count++;
                    }
                ?>
                <span class="number"> <?php echo $count?></span>
                <?php
                }else{
                    echo '<span class="number">0</span>';
                }
                ?>
                
            </a></li>

            <li><a href="order.php"><i class='bx bxs-cart-download' ></i> Orders 
                <?php
                $query = "SELECT * FROM orders WHERE order_status = 'Pending' AND confirm = 'confirm'";
                $sresult = mysqli_query($conn, $query); 
                if (mysqli_num_rows($sresult) > 0) { 
                    $count = 0;
                    while ($row = mysqli_fetch_assoc($sresult)) { 
                        $count++;
                    }
                ?>
                <span class="number"> <?php echo $count?></span>
                <?php
                }else{
                    echo '<span class="number">0</span>';
                }
                ?>
            </a></li>
            <li><a href="contact.php"><i class='bx bxs-envelope' ></i>Massages 
                <?php
                $query = "SELECT * FROM contact WHERE status = 'Now'";
                $sresult = mysqli_query($conn, $query); 
                if (mysqli_num_rows($sresult) > 0) { 
                    $count = 0;
                    while ($row = mysqli_fetch_assoc($sresult)) { 
                        $count++;
                    }
                ?>
                <span class="number"> <?php echo $count?></span>
                <?php
                }else{
                    echo '<span class="number">0</span>';
                }
                ?>
            </a></li>
            <li><a href="favorites.php"><i class='bx bxs-heart' ></i>Favorites</a></li>
            <li><a href="active_users.php"><i class='bx bxs-user-check' ></i>Activity Log</a></li>
            <li><a href="logout.php"><i class='bx bxs-log-out' ></i>Logout</a></li>
        </ul>
       
    </nav>