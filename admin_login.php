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
    width: 35%;
    max-width: 800px;
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

button ,button a{
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

button:hover,button a:hover {
    background-color: var(--second-font-color);
    color: var(--main-color);
}

.forgetPass {
    margin-top: 10px;
    text-align: right;
}

.forgetPass a {
    color: var(--main-color);
    font-size: 14px;
    transition: color 0.3s ease;
    
}

.forgetPass a:hover {
    color:rgb(249, 52, 52); 
}



    </style>
</head>

<body>
<div class="alert">
    
    <div class="error">
    <?php
        if (isset($_GET['error']) && $_GET['error'] === "empty") {
            echo 'Please fill out all required fields!';
        }
        if (isset($_GET['error']) && $_GET['error'] === "notMatch") {
            echo 'username or password does not matching!';
        }
        if (isset($_GET['error']) && $_GET['error'] === "userNotFound") {
            echo 'user not found!';
        }
       ?>

    </div>
</div>

    <div class="main_container">
        <div class="container">
            <div class="left">
                <form action="admin_login_back_end.php" method="POST" id="form">
                    <h1>ADMIN LOGIN</h1>
                    <div class="input_group">
                        <input type="text" name="username" id="username" placeholder="Enter your  email">
                        <p></p>
                    </div>
                    <div class="input_group">
                        <input type="password" name="password" id="password" placeholder="Enter your password">
                        <p></p>
                    </div>
                   
                    <div class="input_group">
                        <button type="submit" name="submit">SIGN IN</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</body>

</html>