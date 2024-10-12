<?php 
session_start();
if (!isset($_SESSION['customer_email'])) {
  echo "<script>window.open('../checkout.php','_self')</script>";
}else{

include("../includes/db.php");  
include("../functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AroInsa Medicine Solution</title>
     <!--link of the icon on tab-->
     <link rel="icon" type="image/png" href="../image/icon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- owl carousel css file cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="../styleacc.css">
    <link rel="stylesheet" href="../head.css">
    <link rel="stylesheet" href="../footer.css" />
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
 <!-- header section starts  -->
    <header>
    <a href="index.php" class="logo"><img src="../image/Medical Care23.png" title="" /></a>
    <ul class="navigation-menu">
        <div class="search-form">
            <form id="searchForm" action="search.php" method="GET">
                <input type="text" placeholder="Search..." name="search" id="searchInput">
                <span class="search" id="searchIcon"><i class="bx bx-search"></i></span>
            </form>
        </div>
        <li><a href="../index.php">Home</a></li>
            <li><a href="../shop.php">Product & Services</a></li>
            <li><a href="../Ask a doctor.php" > Ask a Doctor</a></li>
            <li><a href="../Article.php">Article</a></li>
            <li><a href="../contactus.php">Contact</a></li>
    </ul>
    <a href="../cart.php">
        <div class="cart">
            <i class="bx bx-cart"></i> 
            <div id="cartAmount" class="cartAmount"><?php echo item(); ?></div>
        </div>
    </a>
    <div class="user-info23">
        <?php
            if (!isset($_SESSION['customer_email'])) {
                echo "<a href='../checkout.php' class='loginbtn5'><i class='bx bxs-user-detail'></i></a>";
            } else {
                $customer_email = $_SESSION['customer_email'];
                $get_customer = "SELECT customer_name, customer_image FROM customers WHERE customer_email='$customer_email'";
                $run_customer = mysqli_query($con, $get_customer);
                $row_customer = mysqli_fetch_array($run_customer);
                $customer_name = $row_customer['customer_name'];
                $customer_image = $row_customer['customer_image'];
                echo "
                <a href='my_account.php?my_order' class='loginbtn5active'>
                    <img src='customer_images/$customer_image' class='profile-img' alt='Profile Image'>
                    <span>$customer_name</span>
                </a>";
            }
        ?>
    </div>
</header>
    <!-- header section End  -->

<section class="content" id="content">
  <div class="container">
    <div class="col-md-12">
      <ul class="breadcrumb">
     
        <li><span>My Account</span></li>
        

      </ul>

    </div>
</div></section> 




















 <div class="col-m-9">

  <!-- including my_order.php starts  -->

   <?php
     if (isset($_GET['my_order']))
     {
      include("my_order.php");
     }
     ?>

     <!-- including my_order.php End  -->

     <!-- including payoffline.php page starts  -->
<?php

if (isset($_GET['pay_offline'])){
  include("pay_offline.php");
}

  ?>

     <!-- including payoffline.php page End  -->
       <!-- including Edit_account.php page start  -->
         <?php
            if (isset($_GET['edit_act'])){
              include("edit_act.php");
            }
           ?>

         <!-- including Edit_account.php page End  -->
           <!-- including change_pass.php page Start  -->
         <?php
            if (isset($_GET['change_pass'])){
              include("change_password.php");
            }
           ?>

            <!-- including change_pass.php page End  -->
             <!-- including delete_pass.php page Start  -->

                <?php
            if (isset($_GET['delete_ac'])){
              include("delete_ac.php");
            }
           ?>

              <!-- including delete_pass.php page End  -->
               
 </div>

    
  
  <div class="content1" id="content1">
  <div class="container1">
    <div class="col-md-3">
      <?php
      include("includes/sidebar.php");  
      ?>
   
    </div>

</div>
     </div>

      

<?php } ?></body></html>