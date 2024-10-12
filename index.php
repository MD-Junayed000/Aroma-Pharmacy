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
    <title>AroInsa Medicine Solution</title>
     <!--link of the icon on tab-->
     <link rel="icon" type="image/png" href="./image/icon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- owl carousel css file cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <!-- custom css file link  -->
    
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="head.css">
    <link rel="stylesheet" href="footer.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <!--font/text-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"  />
    <!--Boxicon/sign-->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
   
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



    
    
           
    
       
   
    
 <div class="slideshow-container">
     
     <div class="mySlides fade">
       <div class="numbertext"></div>
       <video
     
         autoplay
         muted
         loop
       
         height="250"
         width="100000"
       >
       <source src="med.mp4" ></video>
       
     </div>
   
    
     </div>
  
  <div class="custom-shape-divider-bottom-1696038172">
         <svg
           data-name="Layer 1"
           xmlns="http://www.w3.org/2000/svg"
           viewBox="0 0 1200 120"
           preserveAspectRatio="none"
         >
           <path
             d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
             opacity=".25"
             class="shape-fill"
           ></path>
           <path
             d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
             opacity=".5"
             class="shape-fill"
           ></path>
           <path
             d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"
             class="shape-fill"
           ></path>
         </svg>
       </div>
   

    
 
   <!--eikan teke Product Categories er kaj start-->
   
<section class="products"id="products" data-aos="fade-up"  data-aos-delay="100">
   <h1 class="heading"> Product <span><a href="Product and services.html">Categories</a></span> </h1>
</section>

<div class="lagoo" data-aos="fade-up" data-aos-duration="1000"data-aos-delay="300">
   <div class="lagoo2">
     <div class="swiper mySwiper container">
       <div class="swiper-wrapper content">
         <!-- 0class -->
         <div class="swiper-slide card">
           <div class="card-content">
             <div class="image">
               <img src="./image/otc.png" alt="" />
             </div>

           

            <h3>OTC</h3>
            <p>Over-the-counter (OTC) medicines are those that can be sold directly to people without a prescription.</p>
   
           </div>
         </div>
    
          <!-- 2class -->
         <div class="swiper-slide card">
           <div class="card-content">
             <div class="image">
               <img src="./image/skin.png" alt="" />
             </div>

    

            <h3>Skin Care</h3>
            <p>Nourish your skin with the best skin care products and medicine at AroInsa.</p>
   
           </div>
         </div>
          <!-- 3class -->
         <div class="swiper-slide card">
           <div class="card-content">
             <div class="image">
               <img src="./image/device.png" alt="" />
             </div>

           

            <h3>Device and Equipments</h3>
       <p>A range of tools designed to ensure patient safety.Include electronic prescription systems for efficient prescription management</p>
   
           </div>
         </div>
          <!-- 4class -->
         <div class="swiper-slide card">
           <div class="card-content">
             <div class="image">
               <img src="./image/prescription.png" alt="" />
             </div>


            <h3>Prescription</h3>
            <p> prescription Medicine that can only be made available to a patient on the written instruction of an authorised health professional.</p>
   
           </div>
         </div>
          <!-- 5class -->
         <div class="swiper-slide card">
           <div class="card-content">
             <div class="image">
               <img src="./image/personal care.png" alt="" />
             </div>


            <h3>Personal Care</h3>
            <p>Personal care means providing care that is related to the patient's body, appearance, hygiene, and movement.</p>
   
           </div>
         </div>
         <!--1class -->
         <div class="swiper-slide card">
           <div class="card-content">
             <div class="image">
               <img src="./image/vitamin.png" alt="" />
             </div>

          

            <h3>Vitamin</h3>
       <p> Dietary supplements, available in various forms such as tablets, capsules, liquids, and powders. </p>
   
           </div>
         </div>

   
       </div>
     </div>

     <div class="swiper-button-next"></div>
     <div class="swiper-button-prev"></div>
     <div class="swiper-pagination"></div>
   </div>

   <!-- Swiper JS -->
   <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

   <!-- Initialize Swiper -->
   <script>
     var swiper = new Swiper(".mySwiper", {
       slidesPerView: 3,
       spaceBetween: 20,
       slidesPerGroup: 3,
       loop: true,
       loopFillGroupWithBlank: true,
       pagination: {
         el: ".swiper-pagination",
         clickable: true,
       },
       navigation: {
         nextEl: ".swiper-button-next",
         prevEl: ".swiper-button-prev",
       },
     });
   </script>
   </div>
<script>
  
</script>


<!--Voucher humb section-->

   <section class="humb "data-aos="zoom-in-down"   data-aos-delay="100"  data-aos-duration="2000">
     <div class="main-humb">
       <div class="humb-1">
         <img src="./image/voucher 1.jpg" />
       </div>

       <div class="humb-1">
         <img src="./image/voucher3.jpg" />
       </div>

       <div class="humb-1">
         <img src="./image/voucher2.jpg" />
       </div>
     </div>
   </section>








<!-- hot start -->
<div class="hot">    
    <div class="box">
        <div class="container">
            <div class="col-md-121">
                <h2>Latest this Week</h2>
           
          <!-- dynamic latest this week images section start  -->
          <div class=" col-sm-4" >
          <div class="row1" id="row1">
                   <?php

                   getPro();


                     ?>
 </div>
</div><!-- hot End -->
 </div>
         </div>
    </div>
</div>

    


                   




<!-- Blog Section -->
<section class="blog" id="Article"data-aos="zoom-in"data-aos-delay="100" data-aos-duration="1000"  data-aos-offset="200">
<div class="blog-cent">

<section class="product1"id="product1">
    <h1 class="heading"> Health <span><a href="Product and services.html">Article</a></span> </h1>
</section>
  <p>"Boost Your Well-Being: Essential Health Tips from Our Pharmacy Experts"</p>

</div>
<div class="main-blog">
  <!-- edit -->
  <div class="blog-info"data-aos="fade-right"data-aos-delay="80" data-aos-duration="3000"  data-aos-offset="200">
    <div class="blog-img">
      <img src="./image/Ramadan final.jpg">
    </div>
    <h4>Healthy Ramadan Choices</h4>
    <h2>          During Ramadan, the “Sultan of 11 Months,” millions of Muslims around the world focus on inner reflection and fast from dusk until dawn. If you fast during Ramadan, not only do you change your eating and sleeping patterns, but your body’s biological clock also undergoes a series of changes both physically and mentally. Dehydrated and hungry due to fasting, your body slows down your metabolism in order to use energy as efficiently as possible.</h2>
 
  
  
  
  </div>


 <!-- edit -->
 <div class="blog-info"data-aos="fade-left"data-aos-delay="80" data-aos-duration="3000"  data-aos-offset="200">
    <div class="blog-img">
      <img src="./image/physical exercise.jpg">
    </div>
    <h4>Practicing mindfulness during my morning meditatio</h4>
    <h2>   Regular physical activity is one of the most important things you can do for your health. Being physically active can improve your brain health, help manage weight, reduce the risk of disease, strengthen bones and muscles, and improve your ability to do everyday activities.</h2>

  
  
  </div>


</div>












<!-- scroll to the top button -->
<button id="btnScrollToTop" onclick="scrollToTop()" data-aos="fade-up" data-aos-delay="3000" data-aos-duration="3000" data-aos-offset="250">
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









    
    <!---Voucher link to java5--->
    <script src="vou.js"></script>
<!--( product er jonno java)-->
<script src="slide.js"></script>
   
    


    <!--(oi banner ta kaj koranor jonno / animation er jonno Javascript disi)-->
   
    <script src="home.js"></script>



<!-- Animation -->

      <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      offset: 100,
        duration: 1000,
    });
  </script>




<!-- gallery section ends -->



<!-- jquery cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- owl carousel js file cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- custom js file link  -->

<!--footer all-->
<footer>
        <div class="row">
            <div class="col">
                <a href="Aboutus.php">
                <img src="./image/icon.png"class=logofoot height="50" weidth="40">
                <p>Visit AroInsa Medicine Solution</p><p>To unlock a Healthier you </p>
                </a>
                <div class="social-icons">
          
             <span class="itwo"><i class="bx bxl-whatsapp"></i></span>
              <span class="ithree"><a href="www.linkedin.com/in/
mohammad-junayed-ete20
"><i class='bx bxl-linkedin-square'></i></a></span>
                          <span class="ione"><i class="bx bxl-facebook-circle"></i></span>
              <span class="ifour"><i class="bx bxl-instagram-alt"></i></span>
            </div>
            </div>
            <div class="col">
            <h3>Our Details <div class="underline"><span></span></div></h3>
            <p class="email-id"><a href="mailto:u2008020@student.cuet.ac.bd">u2008020@student.cuet.ac.bd</a></p>
            <p class="email-id"><a href="mailto:u2008023@student.cuet.ac.bd">u2008023@student.cuet.ac.bd</a></p>
            <h4><p>+880-1876220119</p></h4>
            <h4><p>+880-1558711356</p></h4>
            </div>
    
            <div class="col">
                <h3>Links <div class="underline"><span></span></div></h3>
                <ul>
                    <li><a href="index.php"><p></p>Home</a></li>
                    <li><a href="shop.php">Product & Services</a></li>
                    <li><a href="Ask a doctor.php">Ask a doctor</a></li>

                    <li><a href="Article.php">Article</a></li>
                    <li><a href="contactus.php">  Contact </a></li>
                    
                </ul>
            </div>
            <div class="col">
            <h3>Health Article<div class="underline"><span></span></div></h3>
            <form class="news">
              
                <i class='bx bxs-envelope' id="one"></i>
                <input type="email" placeholder="Enter your email id" required>
                <button><i class='bx bx-right-arrow-alt' id="two"></i></button>
            </form>
            <p class="pay">Secured Payment Gateways</p>
            <div class="pay2">
           
            </div>
            </div>
            
    
        </div>
        <hr>
        <p class="copyright"> &copy2024 AroInsa Medicine Solution.All Rights Reserved; Designed by <span class="design">IFFAT ARA </span> & <span class="design"> MUHAMMED JUNAYED </span>
        </p>
    </footer>


</body>
</html>

<script type="text/javascript" src="main.js"></script>