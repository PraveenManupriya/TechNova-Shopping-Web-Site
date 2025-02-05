<?php
 include 'connection.php';
 session_start();
 
 if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
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
        .overview {
            overflow-y: scroll;
            max-height: 500px;
        }

    </style>
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
                if (isset($_GET['success']) && $_GET['success'] === "cancel") {
                    echo 'Your order has been successfully canceled!';
                }
                ?>  
        </div>
      
  </div>

    <div class="shipping-header">
        <h3>Message</h3>
        <span><a href="index.php" class="shipping-tag">Home</a> > <a href="messages.php">
            Messages</a></span>
    </div>

    <div class="account-information">
        <div class="user-cart">
            <div class="user-image">
                <img src="logo.png" alt="">
            </div>
            <h3>TECH NOVA</h3>
        </div>
        <div class="user-container">
            <h3>Message Status: Inbox</h3><br>
            <div class="overview" id="overview">
                <div class="order" id="order">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Replay</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                            $query = "SELECT * FROM message WHERE  message.user_id = '$user_id' GROUP BY message.id ORDER BY message.id DESC";

                            $sresult = mysqli_query($conn, $query);

                            if ($sresult && mysqli_num_rows($sresult) > 0) {
                                while ($row = mysqli_fetch_assoc($sresult)) {
                                    echo "<tr>";
                                    echo "<td class='bold'>#" . htmlspecialchars($row['id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['content']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['reply']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                
                                echo "<tr><td colspan='5'>No messages found.</td></tr>";
                            }
                            ?>


                            
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
    
            <div class="order" id="order">
                <h3>Message Status: Sent</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
               
                            $query = "SELECT * FROM contact WHERE user_id = '$user_id' ORDER BY id DESC";
                            $sresult = mysqli_query($conn, $query); 
                            if (mysqli_num_rows($sresult) > 0) {  
                                
                                while ($row = mysqli_fetch_assoc($sresult)) {   
                            ?>
                            <tr>
                                <td class="bold">#<?php echo $row['id'];?></td>
                                <td><?php echo $row['subject'];?></td>
                                <td ><?php echo $row['massage'];?></td> 
                                <td><?php echo $row['time'];?></td>
                                <td  class="status"><?php echo $row['status'];?></td>
                                <td><a href="message_delete.php?delete_id=<?php echo $row['id']; ?>"><button>Delete</button></a></td>
                                
                            </tr>
                           <?php
                                }
                                
                            } else {
    
                                echo "<tr><td colspan='5'>No messages found.</td></tr>";
                            }?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>