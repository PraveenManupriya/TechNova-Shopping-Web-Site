<?php
 include 'connection.php';
 session_start();
 $user_id = $_SESSION['user_id']; 
 if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TECH NOVA</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <style>
        .edit-profile{
            width: 100%;
            padding: 40px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            
        }
        .edit-profile input[type=text] {
            width: 100%;
            height: 40px;
            margin: 10px;
            border: 1px solid var(--border-color);
            padding: 20px;
        }
        .edit-profile input[type=file] {
            width: 100%;
            height: 40px;
            margin: 10px;
            border: 1px solid var(--border-color);
            padding: 10px;
        }
         span{
            margin-left: 10px;
        }
        .edit-profile button{
            width: 20%;
            height: 40px;
            background-color: var(--main-color);
            color: white;
            margin-left: 10px;
            margin-top: 20px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }
        .edit-profile button:hover{
            background-color: var(--second-color);
            border: 1px solid var(--main-color);
            color: var(--main-color);
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="header-top">

            <div class="info">
            <?php
                $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $image = $row['profile_picture'];
                    echo "<img src='$image' alt='profile image' id='profile'>";
                }
                ?>

            <?php
               
                $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                $sresult = mysqli_query($conn, $query); 
                if (mysqli_num_rows($sresult) > 0) { 
                   
                    if ($row = mysqli_fetch_assoc($sresult)) { 
                    
                    
            ?>
                <a href="user-profile.php"><?php echo $row['username'];?></a>
                <?php
                    }
                }?>
                <a href="logout.php" class="status">Logout</a>
                <a href="#">ENG</a>
            </div>
        </div>
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
                    echo 'Your profile has been successfully updated!';
                }
                if (isset($_GET['success']) && $_GET['success'] === "order_again") {
                    echo 'The order was successfully placed!';
                }
                ?>  
        </div>
      
  </div>
  <div class="alert">
        <div class="error">
            <?php
                if (isset($_GET['error']) && $_GET['error'] === "empty") {
                    echo 'Please fill out all required fields!';
                }
               
               
                if (isset($_GET['error']) && $_GET['error'] === "user_exists") {
                    echo 'This user name is already` registered!';
                   
                }
                if (isset($_GET['error']) && $_GET['error'] === "invalid_phone") {
                    echo 'Invalid phone number. Please enter a valid phone number.';
                }
                if (isset($_GET['error']) && $_GET['error'] === "cancel") {
                    echo 'The order was successfully canceled!';
                }
                ?>  
        </div>
      
  </div>

    <div class="shipping-header">
        <h3>Overview</h3>
        <span><a href="index.php" class="shipping-tag">Home</a> > <a href="user-profile.php">Account
            information</a></span>
    </div>

    <div class="account-information">
        <div class="user-cart">
            <div class="user-image">
            <?php
                $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $image = $row['profile_picture'];
                    echo "<img src='$image' alt='profile image' id='profile'>";
                }
                ?>

            </div>
            <div class="link">
                
                <a href="#overview" class="active">Overview</a>
                <a href="#edit-profile">Edit Profile</a>
                <a href="#order">Orders</a>
                <a href="forgot_password.php">Change Password</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
        <div class="user-container">
            <div class="overview" id="overview">
                <h3>Account information</h3>
                <?php
               
               $query = "SELECT * FROM users WHERE user_id = '$user_id'";
               $sresult = mysqli_query($conn, $query); 
               if (mysqli_num_rows($sresult) > 0) {  
                   if ($row = mysqli_fetch_assoc($sresult)) {   
              ?>
                <p>Register Date : <span><?php echo $row['created_at'];?></span></p>
                <p>Name : <span><?php echo $row['name'];?></span></p>
                <p>Email : <span><?php echo $row['email'];?></span></p>
                <p>Phone : <span>0<?php echo $row['phone'];?></span></p>
                <?php 
                   }
                }?>
            </div>
    
            <div class="order" id="order">
                <h3>Orders</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Order</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
               
                            $query = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY order_id DESC";
                            $sresult = mysqli_query($conn, $query); 
                            if (mysqli_num_rows($sresult) > 0) {  
                                
                                while ($row = mysqli_fetch_assoc($sresult)) {   
                            ?>
                            <tr>
                                <td class="bold">#<?php echo $row['order_id'];?></td>
                                <td><?php echo $row['order_date'];?></td>
                                <td class="status"><?php echo $row['order_status'];?></td>  
                                <td class="status"> <?php echo $row['confirm'];?></td>
                                <td><a href="user-profile-order.php?order_id=<?php echo $row['order_id']; ?>"><button>View</button></a></td>
                                
                            </tr>
                           <?php
                                }
                                
                            }?>
                            
                        </tbody>
                    </table>
                </div>
            </div> 
            <?php
            include 'connection.php';
            $query = "SELECT * FROM users WHERE user_id = '$user_id'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                if ($row = mysqli_fetch_assoc($result)) {
                    $name = $row['name'];
                    $username = $row['username'];
                    $email = $row['email'];
                    $phone = $row['phone'];
                    $image = $row['profile_picture'];
                }
                
            
        ?>
         <div class="edit-profile" id="edit-profile" style="margin-top: 100px;">
            <form action="edit_profile_back_end.php" method="POST" id="form" enctype="multipart/form-data">
                <h1>Edit Profile</h1>            
                <div class="input_group">
                    <input type="text" name="name" value="<?php echo $name; ?>">
                    <p></p>
                </div>
                <div class="input_group">
                    <input type="text" name="username" value="<?php echo $username; ?>">
                    <p></p>
                </div>
                
                <div class="input_group">
                    <input type="text" name="phone" value="<?php echo 0,$phone; ?>">
                    <p></p>
                </div>

                <div class="input_group">
                    <span>Change Profile Picture</span>
                    <input type="file" name="profile_picture" >
                    <p></p>
                </div>
              
                <div class="input_group">
                    <button type="submit" name="submit">Edit </button>
                </div>
            </form>
        </div>
         <?php
            }?> 
        </div>
        
    </div>

   
</body>

</html>