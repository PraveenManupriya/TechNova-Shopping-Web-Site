<?php
session_start();
include '../connection.php'; 

$query = "SELECT username FROM users WHERE is_logged_in = 1"; 
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TECH NOVA</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="website/style.css">
    <link rel="shortcut icon" href="../logo.png" type="image/x-icon">
    <style>
        .active{
            color: #16a044;
            font-weight: 800;
        }
    </style>
</head>
<body>
    <?php include "sidebar.php"?>
    <main class="main-content">

            <table class="table" aria-label="Product Table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th> 
                        <th>Phone</th>
                        <th>Type</th>
                        <th>Login</th>
                    </tr>
                </thead>
                <tbody id="productList">
                <?php
                        $query = "SELECT * FROM users WHERE is_logged_in = 1";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['user_id'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['phone'] . "</td>";
                                echo "<td>" . $row['type'] . "</td>";
                                echo "<td>
                                        <label class='active'>active</label>
                                        
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td>No active users found.</td></tr>";
                        }
                    
                ?>
                </tbody>
            </table>
       
    
</body>
</html>

