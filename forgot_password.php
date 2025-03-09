<?php
session_start();
include("includes/db.php");
include("functions/functions.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'Contact Form/PHPMailer/Exception.php';
require 'Contact Form/PHPMailer/PHPMailer.php';
require 'Contact Form/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $get_customer = "SELECT * FROM customers WHERE customer_email='$email'";
    $run_customer = mysqli_query($con, $get_customer);
    $count_customer = mysqli_num_rows($run_customer);

    if ($count_customer == 1) {
        $token = bin2hex(random_bytes(50));
        $expire_time = date("Y-m-d H:i:s", strtotime('+1 hour'));

        $insert_token = "INSERT INTO password_resets (email, token, expire_time) VALUES ('$email', '$token', '$expire_time')";
        $run_token = mysqli_query($con, $insert_token);

        if ($run_token) {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "aroinsamedicinesolution@gmail.com"; // your email address
                $mail->Password = 'exec vnii foid iizq'; // your app password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('aroinsamedicinesolution@gmail.com', 'Aroma Pharmacy');
                $mail->addAddress($email);
                $mail->isHTML(true);

                $mail->Subject = 'Password Reset Request';
                $mail->Body = "
                <h2>Password Reset</h2>
                <p>Click the link below to reset your password:</p>
                      <a href='http://localhost/Aroma-Pharmacy/reset_password.php?token=$token'>Reset Password</a>
                ";
                $mail->send();
                echo "<script>alert('Password reset link has been sent to your email.');</script>";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "<script>alert('Failed to insert token.');</script>";
        }
    } else {
        echo "<script>alert('Email not found.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aroma Pharmacy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- owl carousel css file cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="head.css">
    <link rel="stylesheet" href="forget.css">
  

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <!--font/text-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"  />
    <!--Boxicon/sign-->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
    <!--link of the icon on tab-->
    <link rel="icon" type="image/png" href="./image/icon.png" />
    <!--link of font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="  crossorigin="anonymous"   referrerpolicy="no-referrer"/>
    <!-- ===== Fontawesome CDN Link ===== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- ===== Link Swiper's CSS ===== -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>
<body>
  
 <!-- header section starts  -->
 <header>
    <a href="index.php" class="logo"><img src="./image/Medical Care23.png" title="" /></a>
    <ul class="navigation-menu">
        <div class="search-form">
            <form id="searchForm" action="search.php" method="GET">
                <input type="text" placeholder="Search..." name="search" id="searchInput">
                <span class="search" id="searchIcon"><i class="bx bx-search"></i></span>
            </form>
        </div>
        <li><a href="index.php"class="active">Home</a></li>
        <li><a href="shop.php" >Product & Services</a></li>
        <li><a href="Ask a doctor.php">Ask a Doctor</a></li>
        <li><a href="Article.php">Article</a></li>
        <li><a href="contactus.php">Contact</a></li>
    </ul>
    <a href="cart.php">
        <div class="cart">
            <i class="bx bx-cart"></i> 
            <div id="cartAmount" class="cartAmount"><?php echo item(); ?></div>
        </div>
    </a>
    <div class="user-info23">
        <?php
            if (!isset($_SESSION['customer_email'])) {
                echo "<a href='checkout.php' class='loginbtn5'><i class='bx bxs-user-detail'></i><p>Login/<br>Register</p></a>";
            } else {
                $customer_email = $_SESSION['customer_email'];
                $get_customer = "SELECT customer_name, customer_image FROM customers WHERE customer_email='$customer_email'";
                $run_customer = mysqli_query($con, $get_customer);
                $row_customer = mysqli_fetch_array($run_customer);
                $customer_name = $row_customer['customer_name'];
                $customer_image = $row_customer['customer_image'];
                echo "
                <a href='customer/my_account.php?my_order' class='loginbtn5'>
                    <img src='./customer/customer_images/$customer_image' class='profile-img' alt='Profile Image'>
                    <span>$customer_name</span>
                </a>";
            }
        ?>
    </div>
</header>

<script>
        // Add a click event listener to the search icon
        document.getElementById('searchIcon').addEventListener('click', function() {
            document.getElementById('searchForm').submit();
        });

        // Handle pressing Enter in the search input
        document.getElementById('searchInput').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                document.getElementById('searchForm').submit();
            }
        });
    </script>
    <!-- header section End  -->
     
    <div class="image"><img src="./image/security.png"></div>

<div class="full-page">
  <div id='login-form' class='login-page' style="display: block;">
    <!-- formbox -->
    <div class="form-box">
      <div class='button-box'>
        <div id='btnlogin11'></div>
        <button type='button'  class='toggle-btn'>Forget Password</button>

      </div>
      <!-- login form -->
      <form action="" method="post">
      <label>Enter Email Address:</label>
        <input type='email' class='input-field' placeholder='Email ID'name="email" required>
        <div class="lmail"><i class='bx bxs-envelope'></i></div>
        
       
        <button type='submit' name="submit" class='submit-btn'>Send Password Reset Link</button>
        <div class="login-register">
          <p>Go Back to<a href="checkout.php" class="register-link" > Login</a></p>
        </div>
      </form>
     
    </div>
  </div>
</div>










</body>
</html>
