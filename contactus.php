<?php 
session_start();
include("includes/db.php");  
include("functions/functions.php");
?>

<?php
include 'config.php'; // Include connection file

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if all required POST values are set
    if (isset($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['message'])) {
        // Extract POST data
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if the email already exists in the database
        $query = "SELECT * FROM contact WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // User with the same email exists
            echo '<script>alert("This application has been sent successfully") </script>';
        } else {
            // Insert new record into the database
            $query = "INSERT INTO contact(name, phone, email, message) VALUES('$name', '$phone', '$email', '$message')";

            if (mysqli_query($conn, $query)) {
                // Data inserted successfully
                echo '<script>alert("Message Sent Successfully!")</script>';
                echo '<script>window.location="./contactus.php"</script>';
                exit; // Exit script after redirection
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        }
    } else {
        // Missing required fields
        echo '<script>alert("Please fill all the required fields")</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AroInsa Medicine Solution</title>
 <!--link to the Css page-->   <link rel="stylesheet" href="contactus.css">
 <link rel="stylesheet" href="head.css" />
<link rel="stylesheet" href="footer.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<!--font/text--><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<!--Boxicon/sign--><link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!--link of the icon on tab-->
    <link rel="icon" type="image/png" href="./image/icon.png" />
    <!-- scroll -->
      <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

</head>
<body>
  
  
    <!--header(from logo to login sign)-->
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
        <li><a href="Ask a doctor.php">Ask a Doctor</a></li>
        <li><a href="Article.php">Article</a></li>
        <li><a href="contactus.php"class="active">Contact</a></li>
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





   <!-- box gula -->
            <div class="row2" data-aos="fade-up"  data-aos-delay="50" data-aos-duration="200" >
                <div class="col2">
                    <div class="aboutitem">
                        <i class='bx bxs-phone-call' ></i>
                       
    <h3>Call Details</h3>
       <hr>
    <p>+880-176220119</p>
    <p>+880-1558711356</p>
                    </div>
                </div>
                 <div class="col2">
                    <div class="aboutitem">
                   <i class='bx bxs-envelope' ></i>
                   
    <h3> Email us</h3>
       <hr>
    <p>u2008020@student.cuet.ac.bd</p>
    <p>u2008023@student.cuet.ac.bd</p>
                    </div>
                </div>
                 <div class="col2">
                    <div class="aboutitem">
        <i class='bx bxs-location-plus' ></i>
    <h3>Location</h3>
    <hr>
    <p>+880-176220119</p>
    <p>Shugondha R/A,Chattogram-4000,Bangladesh</p>
                    </div>
                </div>
            </div>
   
 





















<!-- animate likka -->
<div class="content1"data-aos="flip-left"  data-aos-delay="100" data-aos-duration="3000" data-aos-offset="100">
<h1>Contact Us</h1>
<h1>Contact Us</h1>


</div>

















    <!--Contact box-->
    <div class="hello"data-aos="fade-up"  data-aos-delay="100" data-aos-duration="3000" data-aos-offset="100">
          <div class="contact-in">
        <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3689.672357323005!2d91.833367!3d22.365997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjLCsDIxJzU3LjYiTiA5McKwNTAnMDAuMSJF!5e0!3m2!1sen!2sbd!4v1710360817696!5m2!1sen!2sbd" width="100" height="auto" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
            <div class="contact-form">
                <h1>Get in Touch</h1>
                <form action="#" class="ff" method="POST">
                <!-- <form class="ff" > -->
                    <input type="text" placeholder="Name" name="name" class="contact-form-txt"/>
                    <input type="number" placeholder="phone number" name="phone" class="contact-form-txt"/>
                    <input type="text" placeholder="Email" name="email" class="contact-form-txt"/>
                    <textarea placeholder="Message" name="message" class="contact-form-textarea"></textarea>
                    <input type="submit" name="submit" class="contact-from-btn" />
                </form>
            </div>
               </div>
          </div>
    </div>


















<!-- about us -->
<section class="about-us">
    <div class="container">
        <div class="about-content"data-aos="fade-up"  data-aos-delay="100" data-aos-duration="1000">
            <h1>For more Query</h1>
            <p>Visit the AroInsa Medicine Solution  <br>from the following link.</p>
<button class="btn-primary"><a href="Aboutus.php">About Us</a></button>

        </div>
<div class="about-image" data-aos="fade-up"  data-aos-delay="1500" data-aos-duration="1500">
    <img src="./image/About us new small.png">
</div>
    </div> 
</section>   

<!-- why choose AroInsa -->

<section class="steps-section-container" data-aos="fade-in"     data-aos-delay="200" data-aos-offset="200">
<div class="steps-bg">
  <h2 class="section-title" data-text="?Choose AroInsa">?Choose AroInsa</h2>
  <div class="steps-container grid">
    <!-- step1 -->
    <div class="hoverr">
    <div class="steps-card" data-aos="zoom-in"  data-aos-delay="300" data-aos-duration="3000"   data-aos-offset="300" >
      
      <div class="steps-carb-number">01</div>
        <h3 class="steps-card-title">
          Instant Product Selection</h3>
          <p class="steps-card-des">
            We have several varieties products you can choose from.
          </p>
       
    </div>
    </div>
    <!-- step2 -->
      <div class="hoverr">
    <div class="steps-card" data-aos="zoom-in"  data-aos-delay="700" data-aos-duration="3000"    data-aos-offset="300">
      <div class="steps-carb-number">02</div>
        <h3 class="steps-card-title">
          Place an order</h3>
          <p class="steps-card-des">
        Once your order is set,we move to the next step which is the shipping.
          </p>
        
      
    </div>
    </div>
      <!-- step3 -->
      <div class="hoverr">
    <div class="steps-card" data-aos="zoom-in"  data-aos-delay="1000" data-aos-duration="3000"  data-aos-offset="300"  >
      <div class="steps-carb-number">03</div>
        <h3 class="steps-card-title">
          Get order Delivered</h3>
          <p class="steps-card-des">
            Our delivery process is easy,you receive the order direct to your home.
          </p>
        
      
    </div>
    </div>
  </div>    
</div>






</section>

<!-- scroll to the top button -->
<button id="btnScrollToTop" onclick="scrollToTop()" data-aos="fade-up" data-aos-delay="800" data-aos-duration="3000" data-aos-offset="250">
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

 <!-- item -->
  <div class="shop" id="shop">
    <!-- item -->
                       </div>

 <!-- item -->








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
              <span class="ithree"><i class="bx bxl-messenger"></i></span>
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
 
<!-- Animation -->

      <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
      offset: 100,
        duration: 1000,
    });
  </script>


</body>
</html>
 <script src="Data.js"></script> 
<script src="main.js"></script> 