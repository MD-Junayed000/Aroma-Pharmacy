<?php
session_start();
include("includes/db.php");
include("functions/functions.php");

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $current_time = date("Y-m-d H:i:s");

    $get_token = "SELECT * FROM password_resets WHERE token='$token' AND expire_time > '$current_time'";
    $run_token = mysqli_query($con, $get_token);
    $count_token = mysqli_num_rows($run_token);

    if ($count_token == 1) {
        if (isset($_POST['reset_password'])) {
            $new_password = mysqli_real_escape_string($con, $_POST['new_password']);

            $row_token = mysqli_fetch_array($run_token);
            $email = $row_token['email'];

            $update_password = "UPDATE customers SET customer_pass='$new_password' WHERE customer_email='$email'";
            $run_update = mysqli_query($con, $update_password);

            if ($run_update) {
                $delete_token = "DELETE FROM password_resets WHERE token='$token'";
                mysqli_query($con, $delete_token);

                echo "<script>alert('Your password has been updated. Please login.')</script>";
                echo "<script>window.open('checkout.php','_self')</script>";
            } else {
                echo "<script>alert('Failed to update password. Please try again.')</script>";
            }
        }
    } else {
        echo "<script>alert('Invalid or expired token.')</script>";
        echo "<script>window.open('forgot_password.php','_self')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AroInsa Medicine Solution</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- owl carousel css file cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="forget.css">
    <link rel="stylesheet" href="head.css">

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

<header>
        <a href="index.php" class="logo"><img src="./image/Medical Care23.png" title="" /></a>
        <ul class="navigation-menu">
            <div class="search-form">
                <form id="searchForm" action="search.php" method="GET">
                    <input type="text" placeholder="Search..." name="search" id="searchInput">
                    <div id="searchSuggestions" class="search-suggestions"></div>
                    <span class="search" id="searchIcon"><i class="bx bx-search"></i></span>
                </form>
            </div>
            <li><a href="index.php">Home</a></li>
            <li><a href="shop.php">Product & Services</a></li>
            <li><a href="Ask a doctor.php" > Ask a Doctor</a></li>
            <li><a href="Article.php">Article</a></li>
            <li><a href="contactus.php">Contact</a></li>
        </ul>
        <a href="cart.php">
            <div class="cart">
                <i class="bx bx-cart"></i> 
                <div id="cartAmount" class="cartAmount"><?php echo item(); ?></div>
            </div>
        </a>
        <div>
            <?php
                if (!isset($_SESSION['customer_email'])) {
                    echo "<a href='checkout.php' class='loginbtn5'><i class='bx bxs-user-detail'></i></a>";
                } else {
                    $customer_email = $_SESSION['customer_email'];
                    $get_customer = "SELECT customer_name FROM customers WHERE customer_email='$customer_email'";
                    $run_customer = mysqli_query($con, $get_customer);
                    $row_customer = mysqli_fetch_array($run_customer);
                    $customer_name = $row_customer['customer_name'];
                    echo "<a href='customer/my_account.php?my_order' class='loginbtn5'>$customer_name</a>";
                }
            ?>
            
        </div>
    </header>
    <!-- header section End  -->

    <div class="image"><img src="./image/security.png"></div>

<div class="full-page">
  <div id='login-form' class='login-page' style="display: block;">
    <!-- formbox -->
    <div class="form-boxs">
      <div class='button-box'>
        <div id='btnlogin'></div>
        <button type='button'  class='toggle-btn'>Get New Password</button>

      </div>
      <!-- login form -->
      <form action="" method="post">
      <label>Enter New Password:</label>
        <input type="password" name="new_password" class='input-field' placeholder='Password' required>
        <div class="lmail"><i class='bx bxs-lock-alt'></i>
        
       
        <button type='submit' name="reset_password" class='submit-btns'>Reset Password</button>
       
      </form>
     
    </div>
  </div>
</div>















</body>
</html>
