
<?php 
session_start();
include("includes/db.php");  
include("functions/functions.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- scroll -->
      <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
      <title>Aroma Pharmacy</title>
    <!--link to the Css page-->
    <link rel="stylesheet" href="Ask a doctor.css" />
   
    <link rel="stylesheet" href="head.css" />
    <link rel="stylesheet" href="footer.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <!--font/text-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link   href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"   rel="stylesheet"  />
    <!--Boxicon/sign-->
    <link   rel="stylesheet"  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"  rel="stylesheet" />
    
     <!--link of the icon on tab-->
    <link rel="icon" type="image/png" href="./image/icon.png" />
    <!--link of font awesome-->
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"   integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="  crossorigin="anonymous"   referrerpolicy="no-referrer"/>
 
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
        <li><a href="index.php">Home</a></li>
        <li><a href="shop.php" >Product & Services</a></li>
        <li><a href="Ask a doctor.php"class="active">Ask a Doctor</a></li>
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
    <!-- header section End  -->
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
	
<section>
  <!-- ask a section -->
  <div class="leftside"> 
   <img src="./image/doctor.png ">
  </div>
  <div class="rightside"> 
   <h1>Online Medical Consultation</h1>
   <p>Phone number :<span> +880 1776-316056 </span>   <br>Email : <span>u2008023@student.cuet.ac.bd </span> </p>
   <div class="btn">
   <a href="whatsapp.php"><button><i class="fa-brands fa-square-whatsapp fa-2x" style="color: chartreuse;"></i> Call Support</button></a>
    <a href="./Contact Form/Contact form to email.php"><button><i class="fa-solid fa-envelope fa-2x" style="color: rgb(255, 150, 85);"       ></i> Mail the Doctor</button></a>
    </div>
    <a href="chat.php"><button ><i class="fa-solid fa-heart-pulse fa-2x" style="color: rgb(236, 56, 80);" ></i> Ask Aroma</button></a>
  </div>
  
 </section>















  

































    







<!-- Animation -->

      <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      offset: 100,
        duration: 1000,
    });
  </script>

<!-- scroll to the top button -->
<button id="btnScrollToTop" onclick="scrollToTop()" data-aos="fade-up" data-aos-delay="1200" data-aos-duration="1200" data-aos-offset="250">
  <i class='bx bx-up-arrow-alt'></i>
</button>
<script>
function scrollToTop(){
  window.scrollTo({
    top:0,
    left:0,
    behavior:"smooth"
  });
}
</script>





<?php


include("footer.php");
  ?>




</body>
</html>
 <script src="Data.js"></script> 
<script src="main.js"></script> 
