<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TECH NOVA</title>
   <link rel="stylesheet" href="style.css">
   <link rel="shortcut icon" href="logo.png" type="image/x-icon">
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
    --main-color:#ef2828; 
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
    background-position:center;
    background-repeat: no-repeat;
    object-fit: cover;
}

.main_container {
    width: 100%;
    max-width: 1000px;
    background: var(--second-color);
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    display: flex;
}

.container {
    display: flex;
    flex: 1;
}

.left {
    flex: 1;
    padding: 40px;
}

.right {
    flex: 1;
    background: var(--main-color);
    color: var(--second-color);
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

h1 {
    margin-bottom: 10px;
    font-size: 28px;
    color: var(--third-color);
}

h2 {
    margin-bottom: 15px;
    font-size: 24px;
}

p {
    margin: 10px 0;
    line-height: 1.6;
}

.input_group {
    margin-bottom: 20px;
    position: relative;
}

.input_group input {
    width: 100%;
    padding: 12px;
    border: 1px solid var(--border-color);
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

.input_group input:focus {
    border-color: var(--main-color);
}

.input_group p {
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
    border: 1px solid white;
}
button a{
    color: var(--second-color);
}



button:hover,button a:hover {
    background-color: var(--second-font-color);
    color: var(--main-color);
}

.display_err {
    color: red;
    font-size: 14px;
    margin-bottom: 15px;
}

.display_suc {
    color: green;
    font-size: 14px;
    margin-bottom: 15px;
}


.success {
    border-color: #4caf50; 
}

.error {
    border-color: red; 
}

   </style>
</head>

<body>
<div class="alert">
    <div class="success">
            
            <?php
                if (isset($_GET['success']) && $_GET['success'] === "registered") {
                    echo 'Registration complete! Welcome aboard!';
                }
                ?>
           
    </div>
    <div class="error">
    <?php
        if (isset($_GET['error']) && $_GET['error'] === "empty") {
            echo 'Please fill out all required fields!';
        }
        if (isset($_GET['error']) && $_GET['error'] === "invalid_email") {
            echo 'Invalid email address. Please try again!';
        }
        if (isset($_GET['error']) && $_GET['error'] === "user_exists") {
            echo 'This user is already registered!';
        }
        if (isset($_GET['error']) && $_GET['error'] == 'weak_password') {
            echo "Password must be at least 6 characters long and include uppercase, lowercase letters, and a number.";
        }
        if (isset($_GET['error']) && $_GET['error'] == 'password_mismatch') {
            echo "Password and Confirm Password do not match.";
        }
        if (isset($_GET['error']) && $_GET['error'] == 'invalid_phone') {
            echo "Invalid phone number. Please enter a valid phone number.";
        }
        if (isset($_GET['error']) && $_GET['error'] == 'image_upload_failed') {
            echo "Image upload failed. Please try again.";
        }
        ?>

    </div>
</div>
    <div class="main_container">
        <div class="container">
            <div class="right">
                <h2>Welcome Back!</h2>
                <p>If you already have an Account,
                <p>please sign in to continue!</p>
                </p>
                <button >
                    <a href="login.php">SIGN IN</a>
                </button>
            </div>
            <div class="left">
                <form action="register_back_end.php" method="POST" id="form" enctype="multipart/form-data">
                    <h1>Create Account</h1>
                    <p>Fill in your personal information.</p>
                   

                    <div class="input_group">
                        <input type="text" name="name" id="name" placeholder="Enter your name">
                    </div>
                    <div class="input_group">
                        <input type="text" name="username" id="username" placeholder="Choose a username">
                    </div>
                    <div class="input_group">
                        <input type="text" name="email" id="email" placeholder="Enter your Email Address">
                    </div>
                    <div class="input_group">
                        <input type="text" name="phone" id="phone" placeholder="Enter your phone number">
                    </div>
                   
                    <div class="input_group">
                        <input type="password" name="password" id="password" placeholder="Create a Password">
                    </div>
                    <div class="input_group">
                        <input type="password" name="c_password" id="c_password" placeholder="Confirm your Password">
                    </div>
                    <div class="input_group">
                        <span>Upload Profile Picture</span>
                        <input type="file" name="profile_picture" id="profile_picture">
                    </div>
                 
                    <div class="input_group">
                        <button type="submit" name="submit">SIGN UP</button>
                    </div>
                </form>
            </div>

        </div>

    </div>

</body>

</html>