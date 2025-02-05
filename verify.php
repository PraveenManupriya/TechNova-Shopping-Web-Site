<?php
session_start();
include 'connection.php';

if (isset($_POST['verify'])) {
    // Sanitize user inputs
    $email = trim($_POST['email']);
    $verification_code = trim($_POST['verification_code']);

    // Check if both email and verification code are provided
    if (empty($email) || empty($verification_code)) {
        header("Location: verify.php?error=missing_data");
        exit();
    }

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND verification_code = ?");
    $stmt->bind_param("ss", $email, $verification_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];

        // Update verification status
        $update_stmt = $conn->prepare("UPDATE users SET is_verified = 1 WHERE user_id = ?");
        $update_stmt->bind_param("i", $user_id);
        if ($update_stmt->execute()) {
            header("Location: login.php?success=verified");
            exit();
        } else {
            header("Location: verify.php?error=update_failed");
            exit();
        }
    } else {
        // Invalid credentials
        header("Location: verify.php?error=invalid_credentials");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TECH NOVA - Email Verification</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            border: none;
            outline: none;
            font-family: 'Poppins', sans-serif;
        }

        :root {
            --main-color: #ef2828; 
            --second-color: #fff; 
            --third-color: #3d3d3d; 
            --main-font-color: #000; 
            --second-font-color: #fff; 
            --border-color: #08080838;
        }

        body {
            background-color: var(--second-color);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url(login_bg.png);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .main_container {
            width: 90%;
            max-width: 800px;
            background: var(--second-color);
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            display: flex;
        }

        .container {
            width: 80%;
            height: 300px;
            display: flex;  
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: auto;
        }

        .input_group {
            margin-bottom: 20px;
            position: relative;
        }

        input {
            width: 100%;
            max-width: 400px;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
            margin-bottom: 10px;
        }

        input:focus {
            border-color: var(--main-color);
        }

        p {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        button {
            background: var(--main-color);
            color: var(--second-color);
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.1s ease-in-out;
        }

        button:hover {
            background-color: var(--second-font-color);
            color: var(--main-color);
        }
    </style>
</head>
<body>
    <div class="main_container">
        <div class="container">
            <h2>Email Verification</h2>

            <div class="alert">
                
                <div class="error">
                <?php
                    if (isset($_GET['error']) && $_GET['error'] === "invalid_credentials") {
                        echo 'Invalid verification code. Please try again!';
                    }
                    if (isset($_GET['error']) && $_GET['error'] === "missing_data") {
                        echo 'Please fill out all required fields!';
                    }
                   
                    ?>

                </div>
            </div>

            <form action="verify.php" method="POST">
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>">

                <label for="verification_code">Enter Verification Code:</label>
                <input type="text" name="verification_code" id="verification_code" >

                <button type="submit" name="verify">Verify</button>
            </form>

        </div>
    </div>
</body>
</html>
