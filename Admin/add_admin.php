<?php
// Include the database connection file
include('../connection.php'); // Make sure the path to your connection file is correct

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Basic validation: check if fields are empty
    if (empty($name) || empty($username) || empty($email) || empty($password)) {
        header('Location: administrators.php?error=empty'); // Redirect to administrators.php with error message
        exit();
    }

    // Check if the username or email already exists (using prepared statements for security)
    $check_query = "SELECT * FROM admin_login WHERE username = ? OR email = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($stmt, 'ss', $username, $email); // 'ss' means two string parameters
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        header('Location: administrators.php?error=user_exists'); // Redirect to administrators.php with error message
        exit();
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert data into the database using prepared statements for security
    $insert_query = "INSERT INTO admin_login (name, username, email, password) VALUES (?, ?, ?, ?)";
    $stmt_insert = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($stmt_insert, 'ssss', $name, $username, $email, $hashed_password); // 'ssss' means four string parameters

    if (mysqli_stmt_execute($stmt_insert)) {
        header('Location: administrators.php?success=user_insert'); // Redirect to administrators.php with success message
        exit();
    } else {
        header('Location: administrators.php?error=db_error'); // Redirect to administrators.php if there is a database error
        exit();
    }
}
?>
