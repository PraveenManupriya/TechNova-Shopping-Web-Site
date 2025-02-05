<?php include "sidebar.php"?>
    <style>
        .status.active{
            color: #28a745;
            font-weight: 800;
        }
        .status.inactive{
            color: #dc3545;
            font-weight: 800;
        }
        i{
            font-size: 25px;
            margin-right: 5px;
        }
    </style>
    <main class="main-content">
        <section id="dashboard" class="section">
            <h2>Dashboard</h2>
            <div class="stats-grid">

            <div class="stat-box">
                <h3><i class='bx bx-dollar-circle'></i>Eevenue</h3>
                <?php
                    $query = "SELECT * FROM orders";
                    $sresult = mysqli_query($conn, $query); 
                    if (mysqli_num_rows($sresult) > 0) { 
                        $total=0;
                        while ($row = mysqli_fetch_assoc($sresult)) {
                            $total = $total + $row['total'];
                        }                  
                        ?>
                <h2 class="box-number">Rs.
                    <?php echo $total; ?>.00
                </h2>
                <?php
                    } else {
                        echo "<h2 class='box-number'>Rs.0.00</h2>"; 
                    }
                ?>
                </div>
                <div class="stat-box">
                    <h3><i class='bx bx-shopping-bag'></i>Products</h3>
                    <?php
                        $query = "SELECT * FROM products";
                        $sresult = mysqli_query($conn, $query); 
                        if (mysqli_num_rows($sresult) > 0) { 
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($sresult)) { 
                                $count++;
                            }
                            ?>
                    <h2 class="box-number">
                        <?php echo $count; ?>
                    </h2>
                    <?php
                        } else {
                            echo "<h2 class='box-number'>0</h2>"; 
                        }
                    ?>
                </div>

                <div class="stat-box">
                    <h3><i class='bx bx-universal-access'></i>Administrators</h3>
                    <?php
                        $query = "SELECT * FROM admin_login";
                        $sresult = mysqli_query($conn, $query); 
                        if (mysqli_num_rows($sresult) > 0) { 
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($sresult)) { 
                                $count++;
                            }
                            ?>
                    <h2 class="box-number">
                        <?php echo $count; ?>
                    </h2>
                    <?php
                        } else {
                            echo "<h2 class='box-number'>0</h2>"; 
                        }
                    ?>
                </div>

                <div class="stat-box">
                    <h3><i class='bx bx-group'></i>Customers</h3>
                    <?php
                        $query = "SELECT * FROM users WHERE type='customer'";
                        $sresult = mysqli_query($conn, $query); 
                        if (mysqli_num_rows($sresult) > 0) { 
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($sresult)) { 
                                $count++;
                            }
                            ?>
                    <h2 class="box-number">
                        <?php echo $count; ?>
                    </h2>
                    <?php
                        } else {
                            echo "<h2 class='box-number'>0</h2>"; 
                        }
                    ?>
                </div>

                
                <div class="stat-box">
                    <h3><i class='bx bx-list-ul'></i>Categories</h3>
                    <?php
                        $query = "SELECT * FROM categories";
                        $sresult = mysqli_query($conn, $query); 
                        if (mysqli_num_rows($sresult) > 0) { 
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($sresult)) { 
                                $count++;
                            }
                            ?>
                    <h2 class="box-number">
                        <?php echo $count; ?>
                    </h2>
                    <?php
                        } else {
                            echo "<h2 class='box-number'>0</h2>"; 
                        }
                    ?>
                </div>

                <div class="stat-box">
                    <h3><i class='bx bx-line-chart'></i>Orders</h3>
                    <?php
                        $query = "SELECT * FROM orders";
                        $sresult = mysqli_query($conn, $query); 
                        if (mysqli_num_rows($sresult) > 0) { 
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($sresult)) { 
                                $count++;
                            }
                            ?>
                    <h2 class="box-number">
                        <?php echo $count; ?>
                    </h2>
                    <?php
                        } else {
                            echo "<h2 class='box-number'>0</h2>"; 
                        }
                    ?>
                </div>

                <div class="stat-box">
                    <h3> <i class='bx bx-objects-vertical-bottom' ></i>Stock Depleted</h3>
                    <?php
                        $query = "SELECT * FROM products WHERE stock = 0";
                        $sresult = mysqli_query($conn, $query); 
                        if (mysqli_num_rows($sresult) > 0) { 
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($sresult)) { 
                                $count++;
                            }
                            ?>
                    <h2 class="box-number">
                        <?php echo $count; ?>
                    </h2>
                    <?php
                        } else {
                            echo "<h2 class='box-number'>0</h2>"; 
                        }
                    ?>
                </div>


                <div class="stat-box">
                    <h3> <i class='bx bx-chat'></i>Messages</h3>
                    <?php
                        $query = "SELECT * FROM contact";
                        $sresult = mysqli_query($conn, $query); 
                        if (mysqli_num_rows($sresult) > 0) { 
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($sresult)) { 
                                $count++;
                            }
                            ?>
                    <h2 class="box-number">
                        <?php echo $count; ?>
                    </h2>
                    <?php
                        } else {
                            echo "<h2 class='box-number'>0</h2>"; 
                        }
                    ?>
                </div>

                <div class="stat-box">
                    <h3><i class='bx bx-user-check'></i>Active</h3>
                    <?php
                        $query = "SELECT * FROM users WHERE is_logged_in ='1'";
                        $sresult = mysqli_query($conn, $query); 
                        if (mysqli_num_rows($sresult) > 0) { 
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($sresult)) { 
                                $count++;
                            }
                            ?>
                    <h2 class="box-number">
                        <?php echo $count; ?>
                    </h2>
                    <?php
                        } else {
                            echo "<h2 class='box-number'>0</h2>"; 
                        }
                    ?>
                </div>

                <div class="stat-box">
                    <h3><i class='bx bx-heart'></i>Wishlist</h3>
                    <?php
                        $query = "SELECT * FROM wishlist";
                        $sresult = mysqli_query($conn, $query); 
                        if (mysqli_num_rows($sresult) > 0) { 
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($sresult)) { 
                                $count++;
                            }
                            ?>
                    <h2 class="box-number">
                        <?php echo $count; ?>
                    </h2>
                    <?php
                        } else {
                            echo "<h2 class='box-number'>0</h2>"; 
                        }
                    ?>
                </div>

                <div class="stat-box">
                    <h3><i class='bx bx-cart-add' ></i></i>New Orders</h3>
                    <?php
                        $query = "SELECT * FROM orders WHERE order_status = 'Pending' AND confirm = 'confirm'";
                        $sresult = mysqli_query($conn, $query); 
                        if (mysqli_num_rows($sresult) > 0) { 
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($sresult)) { 
                                $count++;
                            }
                            ?>
                    <h2 class="box-number">
                        <?php echo $count; ?>
                    </h2>
                    <?php
                        } else {
                            echo "<h2 class='box-number'>0</h2>"; 
                        }
                    ?>
                </div>  
                
                <div class="stat-box">
                    <h3><i class='bx bx-list-check'></i>Order Fulfilled</h3>
                    <?php
                        $query = "SELECT * FROM orders WHERE order_status = 'completed'";
                        $sresult = mysqli_query($conn, $query); 
                        if (mysqli_num_rows($sresult) > 0) { 
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($sresult)) { 
                                $count++;
                            }
                            ?>
                    <h2 class="box-number">
                        <?php echo $count; ?>
                    </h2>
                    <?php
                        } else {
                            echo "<h2 class='box-number'>0</h2>"; 
                        }
                    ?>
                </div>  

                <div class="stat-box">
                    <h3><i class='bx bx-cart-alt'></i>Order Cancelled</h3>
                    <?php
                        $query = "SELECT * FROM orders WHERE confirm = 'Cancelled' ";
                        $sresult = mysqli_query($conn, $query); 
                        if (mysqli_num_rows($sresult) > 0) { 
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($sresult)) { 
                                $count++;
                            }
                            ?>
                    <h2 class="box-number">
                        <?php echo $count; ?>
                    </h2>
                    <?php
                        } else {
                            echo "<h2 class='box-number'>0</h2>"; 
                        }
                    ?>
                </div>

                <div class="stat-box">
                    <h3><i class='bx bx-error' ></i>Not Verified </h3>
                    <?php
                        $query = "SELECT * FROM users WHERE is_verified = 0 ";
                        $sresult = mysqli_query($conn, $query); 
                        if (mysqli_num_rows($sresult) > 0) { 
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($sresult)) { 
                                $count++;
                            }
                            ?>
                    <h2 class="box-number">
                        <?php echo $count; ?>
                    </h2>
                    <?php
                        } else {
                            echo "<h2 class='box-number'>0</h2>"; 
                        }
                    ?>
                </div>
            </div>
            
            <div class="cart-show">
                <?php include 'barchart.php'?>

                <div class="active-table">
                    <h2>Active List</h2>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Active Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                $query = "SELECT * FROM users WHERE is_logged_in = '1' OR is_logged_in = '0' AND type='customer'";
                                $sresult = mysqli_query($conn, $query);

                                if (mysqli_num_rows($sresult) > 0) {
                                    while ($row = mysqli_fetch_assoc($sresult)) {
                                        $status = $row['is_logged_in'] == '1' ? 'Active' : 'Inactive';
                                        $statusClass = $row['is_logged_in'] == '1' ? 'active' : 'inactive';
                                        echo "
                                            <tr>
                                                <td>".$row['name']."</td>
                                                <td class='status ".$statusClass."'>".$status."</td>
                                            </tr>
                                        ";
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="script.js"></script>
</body>

</html>