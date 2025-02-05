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
        <h2>Manage Administrators</h2>
        <button id="addAdminBtn" class="btn-primary" aria-controls="addProductForm">Add New Administrator</button>
        <form id="addAdminForm" method="POST" style="display:none;" action="add_admin.php" class="form-inline">
            <input type="text" name="name" placeholder="Administrator Name" >
            <input type="text" name="username"  placeholder="Username" >
            <input type="text" name="email" placeholder="Email" >
            <input type="password" name="password" placeholder="Password" >

            <button type="submit" name="submit" class="btn-primary">Add Administrator</button>
        </form>
        <h3>Administrator List</h3>
        <div class="search">
            <form action="#" method="POST">
                <input type="text" id="userSearch" name="userSearch" placeholder="Search username..." class="search-box"
                    aria-label="Search users">
                <button type="submit" name="userSearchBtn" class="btn-primary">Search</button>
                <a href="administrators.php"><i class='bx bx-refresh  refresh'></i></a>
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
                    <th>Actions</th>
                    
                </tr>
            </thead>
            <tbody id="userList">
            <?php
                    
                    if (isset($_POST['userSearchBtn'])) {
                        $search = $_POST['userSearch'];
                        $query = "SELECT * FROM admin_login WHERE username LIKE '%$search%'";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['type'] . "</td>";
                            
                                if ($row['type'] === 'admin') {
                                    echo "<td>
                                            <button class='delete'><a href='admin_delete.php?delete_id=" . $row['id'] . "'><i class='bx bx-trash'></i></a></button>
                                          </td>";
                                } else {
                                    echo "<td>No action available</td>";
                                }

                           
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No Administrator Found</td></tr>";
                        }
                    } else {
                        $query = "SELECT * FROM admin_login ";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['type'] . "</td>";
                               
                            
                                if ($row['type'] === 'admin') {
                                    echo "<td>
                                            <button class='delete'><a href='admin_delete.php?delete_id=" . $row['id'] . "'><i class='bx bx-trash'></i></a></button>
                                          </td>";
                                } else {
                                    echo "<td>No action available</td>";
                                }

                                  
                                echo "</tr>";
                                
                            }
                        } else {
                            echo "<tr><td colspan='7'>No Administrator Found</td></tr>"; 
                        }
                    }
               
                   

                ?>

            </tbody>
        </table>
    </section>
</main>
<script>
        document.getElementById('addAdminBtn').addEventListener('click', function () {
            const form = document.getElementById('addAdminForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        });

    </script>
