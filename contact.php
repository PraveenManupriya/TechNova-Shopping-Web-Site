
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TECH NOVA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --main-color: #ff9823;
            --second-color: #fff;
            --third-color: #3d3d3d;
            --main-font-color: #000;
            --second-font-color: #fff;
            --border-color: #08080838;
        }

        .box-container {
            display: flex;
            align-items: center;
            justify-content: space-around;
            width: 100%;
            height: 280px;
            margin: 20px 0;
            padding: 40px;
        }

        .box {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 400px;
            height: 250px;
            border-radius: 10px;
            box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.2);
        }

        .box i {
            font-size: 50px;
            color: var(--main-color);
            border: 3px solid var(--main-color);
            border-radius: 50%;
            padding: 10px;
            margin: 10px 0;
        }

        .form-container {
            width: 100%;
            padding: 0 100px;
        }

        .form {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .left {
            width: 50%;
            margin-right: 10px;
        }

        .right {
            width: 50%;
            margin-left: 10px;
        }

        .input-box {
            width: auto;
        }

        input[type="text"], textarea {
            width: 100%;
            border: 1px solid var(--border-color);
            padding: 15px;
            border-radius: 10px;
            margin: 10px 0;
        }

        input[type="submit"] {
            width: 250px;
            height: 45px;
            background-color: var(--main-color);
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            color: var(--second-font-color);
            margin-bottom: 50px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        input[type="submit"]:hover {
            transform: translateX(0.5px) scale(1.05);
        }
    </style>
</head>

<body>
<div class="alert">
       
       <div class="success">
           
           <?php
               if (isset($_GET['success']) && $_GET['success'] === "submit") {
                   echo  'Your message has been sent successfully! We will get back to you shortly.' ;
               }
              
            
               ?>
         
       </div>
       <div class="error">
           
       <?php
       
           if (isset($_GET['error']) && $_GET['error'] === "invalid_email") {
               echo 'Invalid email address. Please try again!';
           }
           if (isset($_GET['error']) && $_GET['error'] === "empty") {
            echo 'Please fill out all required fields!';
            }
      
           ?>

       </div>
 </div>
    <main>
        <div class="header-body">
            <div class="logo">
                <img src="logo.png" alt="logo">
                <span>TECH NOVA</span>
            </div>

            <h3><i class='bx bx-phone-call'></i>077-389-1726</h3>
        </div>
        <div class="shipping-header">
            <h3>Contact</h3>
            <span><a href="index.php" class="shipping-tag">Home</a> > <a href="contact.php">Contact</a></span>
        </div>

        <div class="box-container">
            <div class="box">
                <i class='bx bx-home-alt-2'></i>
                <h2>Address</h2>
                <p>123'Abc,Galle</p>
            </div>
            <div class="box">
                <i class='bx bx-envelope'></i>
                <h2>Email Address</h2>
                <p>technova@gmail.com</p>
            </div>
            <div class="box">
                <i class='bx bx-phone'></i>
                <h2>Phone</h2>
                <p>077-389-1726</p>
            </div>
        </div>

        <div class="form-container">
            <h1>Get In Touch</h1>
            <form action="contact_back_end.php" method="POST">
                <div class="form">
                    <div class="left">
                        <div class="input-box">
                            <input type="text" name="name"  placeholder="Full Name">
                        </div>
                        <div class="input-box">
                            <input type="text" name="address" placeholder="Address" >
                        </div>
                    </div>
    
                    <div class="right">
                        <div class="input-box">
                            <input type="text" name="email" placeholder="Email" >
                        </div>
                        <div class="input-box">
                            <input type="text" name="phone" placeholder="Phone" >
                        </div>
                    </div>
                </div>
                <input type="text" name="subject" placeholder="Subject" >
                <textarea name="massage" rows="4" placeholder="Massage" ></textarea>
                <input type="submit" name="submit" value="Send Massage">
            </form>
        </div>
    </main>
</body>

</html>
