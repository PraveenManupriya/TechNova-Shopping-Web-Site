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
            if (isset($_GET['success']) && $_GET['success'] === "banned") {
                echo 'Success! The user has been banned!';
            }
            ?>
    
    </div>
    
</div>

<main class="main-content">
    <section id="users" class="section">
        <h2>Manage Users</h2>

        <h3>User List</h3>
        <div class="search">
            <form action="#" method="POST">
                <input type="text" id="userSearch" name="userSearch" placeholder="Search username..." class="search-box"
                    aria-label="Search users">
                <button type="submit" name="userSearchBtn" class="btn-primary">Search</button>
                <a href="user.php"><i class='bx bx-refresh  refresh'></i></a>
            </form>
        </div>
        <table class="table" aria-label="User Table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Verified</th>
                    <th>Actions</th>
                    <th>Banned</th>
                </tr>
            </thead>
            <tbody id="userList">
                <?php
                    if (isset($_POST['userSearchBtn'])) {
                        $search = $_POST['userSearch'];
                        $query = "SELECT * FROM users WHERE username LIKE '%$search%'";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['user_id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['type'] . "</td>";
                                echo "<td>" . ($row['is_verified'] ? "Yes" : "No") . "</td>";
                            
                                echo "<td>
        
                                        <button class='delete'><a href='user_delete.php?delete_id=" . $row['user_id'] . "'><i class='bx bx-trash'> </i></a></button>
                                    </td>";

                                    echo "<td><button class='update'>" . ($row['is_banned'] ? "<a  href='account_unban.php?user_id=" . $row['user_id'] . "'>Unban</a>" : "<a href='account_ban.php?user_id=" . $row['user_id'] . "'>Ban</a>") ." </button></td>";


                            
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No Users Found</td></tr>";
                        }
                    } else {
                        $query = "SELECT * FROM users WHERE type='customer'";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['user_id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['type'] . "</td>";
                                echo "<td>" . ($row['is_verified'] ? "Yes" : "No") . "</td>";
                            
                                echo "<td>
                                     
                                        <button class='delete'><a href='user_delete.php?delete_id=" . $row['user_id'] . "'><i class='bx bx-trash'> </i></a></button>
                                    </td>";

                                    echo "<td><button class='update'>" . ($row['is_banned'] ? "<a  href='account_unban.php?user_id=" . $row['user_id'] . "'>Unban</a>" : "<a href='account_ban.php?user_id=" . $row['user_id'] . "'>Ban</a>") ." </button></td>";


                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No Users Found</td></tr>"; 
                        }
                    }
                ?>
            </tbody>
        </table>
    </section>
</main>