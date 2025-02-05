<?php include "sidebar.php"?>
<style>
    /* alert */
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
        
            if (isset($_GET['success']) && $_GET['success'] === "deleted") {
                echo 'Success! The user has been deleted!';
            }
            if (isset($_GET['success']) && $_GET['success'] === "reply_sent") {
                echo 'Success! The user has been replyed!';
            }
            ?>
    
    </div>
    
</div>

<main class="main-content">
    <section id="users" class="section">
        <h2>Contact</h2>

        <div class="search">
            <form action="#" method="POST">
                <input type="text" id="userSearch" name="userSearch" placeholder="Search name..." class="search-box"
                    aria-label="Search users">
                <button type="submit" name="userSearchBtn" class="btn-primary">Search</button>
                <a href="contact.php"><i class='bx bx-refresh  refresh'></i></a>
            </form>
        </div>

        <h3>Inbox</h3>
        <table class="table" aria-label="User Table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="userList">
                <?php
                
                    if (isset($_POST['userSearchBtn'])) {
                        $search = $_POST['userSearch'];
                        $query = "SELECT * FROM contact WHERE name LIKE '%$search%'";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['user_id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";                                
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['phone'] . "</td>";            
                                echo "<td>" . $row['subject'] . "</td>";
                                echo "<td>" . $row['massage'] . "</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "<td> <button class='update'><a href='reply_massage.php?id=" . $row['id'] . "'>Replay</a></button>
                                <button class='delete'><a href='reply_massage_delete.php?delete_id=" . $row['id'] . "'><i class='bx bx-trash'></i></a></button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No Massages </td></tr>";
                        }
                    } else {
                        $query = "SELECT * FROM contact  ORDER BY id  DESC";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['user_id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['phone'] . "</td>";                             
                                echo "<td>" . $row['subject'] . "</td>";
                                echo "<td>" . $row['massage'] . "</td>";
                                echo "<td class='status'>" . $row['status'] . "</td>";
                                echo "<td> <button class='update'><a href='reply_massage.php?id=" . $row['id'] . "'>Replay</a></button>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No Massages </td></tr>"; 
                        }
                    }
                ?>
            </tbody>
        </table>

        <div style="height: 150px;"></div>
        <h3>Sent</h3>
        <table class="table" aria-label="User Table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Subject</th>
                    <th>Massage</th>
                    <th>Replied</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="userList">
            <?php

                $query = "SELECT * FROM message ORDER BY message.id DESC ";

                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                       
                        echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['content']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['reply']) . "</td>";
                        echo "<td>";
                        echo "<button class='delete'>
                                <a href='reply_massage_delete.php?delete_id=" . htmlspecialchars($row['id']) . "' 
                               
                                <i class='bx bx-trash'></i>
                                </a>
                            </button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No Messages</td></tr>";
                }
            ?>

            </tbody>
        </table>
    </section>
</main>