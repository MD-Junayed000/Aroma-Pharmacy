<?php
session_start();
include("includes/db.php");

include("functions/functions.php");
  ?>


<?php

if(isset($_GET['pro_id'])){
  $pro_id=$_GET['pro_id'];
  $get_product="select * from products where product_id='$pro_id'";
  $run_product=mysqli_query($con,$get_product);
  $row_product=mysqli_fetch_array($run_product);
  $p_cat_id=$row_product['p_cat_id'];
  $p_title=$row_product['product_title'];
  $p_price=$row_product['product_price'];
  $p_quantity = $row_product['product_quantity']; // Fetch quantity
  $p_dos = $row_product['product_dose']; // Correct column name
  $p_side = $row_product['product_side']; 
  $p_Warnings = $row_product['product_Warnings']; 
  $p_mini = $row_product['product_mini']; 
   // Correct column name
  $p_desc=$row_product['product_desc'];
  $p_img1=$row_product['product_img1'];
  $p_img2=$row_product['product_img2'];
  $p_img3=$row_product['product_img3'];
  $get_p_cat="select * from product_category where p_cat_id='$p_cat_id'";
  $run_p_cat=mysqli_query($con,$get_p_cat);
  $row_p_cat=mysqli_fetch_array($run_p_cat);
  $p_cat_id=$row_p_cat['p_cat_id'];
  $p_cat_title=$row_p_cat['p_cat_title'];

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
    <link rel="stylesheet" href="styledetails.css">
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
    <!--link of the icon on tab-->
    <link rel="icon" type="image/png" href="./image/icon.png" />
    <!--link of font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="  crossorigin="anonymous"   referrerpolicy="no-referrer"/>
    <!-- ===== Fontawesome CDN Link ===== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- ===== Link Swiper's CSS ===== -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
        <li><a href="index.php">Home</a></li>
        <li><a href="shop.php" class="active">Product & Services</a></li>
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
<!-- header section End  -->

<section class="content" id="content">
  <div class="container">
    <div class="col-md-12">
      <ul class="breadcrumb">
     
        <li><span>Product Details</span></li>


          </ul>

           </div></div></section>  
      
    

   

    
  








<div class="grid">


<div class="slides">

<div class="mySlides fade">
  <div class="numbertt"></div>
  <img src="admin_area/product_images/<?php echo $p_img1 ?>" width="450" height="450">
  
</div>

<div class="mySlides fade">
  <div class="numbertt"></div>
  <img src="admin_area/product_images/<?php echo $p_img2 ?>" width="450" height="450">
  
</div>

<div class="mySlides fade">
  <div class="numbertt"></div>
  <img src="admin_area/product_images/<?php echo $p_img3 ?>" width="450" height="450">

</div>

<a class="prv" onclick="plusSlides(-1)">&#10094;</a>
<a class="net" onclick="plusSlides(1)">&#10095;</a>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- owl carousel js file cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- custom js file link  -->
<script src="js/main.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>




<div class="co-md-6">
  <div class="bx">
    <div class="flex">
    <h1 class="text-center"><?php echo $p_title ?></h1>
    <p><?php echo $p_mini; ?></p>
    </div>
   <?php addCart(); ?>
   
    <form action="details.php?add_cart=<?php echo $pro_id ?>" method="post" class="form-horizontal">
      <div class="form-group">
        <label class="col-md-5 control-label" >Purchase Quantity</label>
        <div class="col-md-7">
        <div>
    <button type="button" id="decrement" class="dec">-</button>
    <input type="" name="product_qty" id="product_qty" class="form-control" min="0" step="1" value="1">
    <button type="button" id="increment" class="inc">+</button>
</div>

<script>
    const decrementButton = document.getElementById("decrement");
    const incrementButton = document.getElementById("increment");
    const qtyInput = document.getElementById("product_qty");

    decrementButton.addEventListener("click", () => {
        let currentValue = parseInt(qtyInput.value);
        if (currentValue > 0) {
            qtyInput.value = currentValue - 1;
        }
    });

    incrementButton.addEventListener("click", () => {
        let currentValue = parseInt(qtyInput.value);
        qtyInput.value = currentValue + 1;
    });
</script>

        </div>
      </div>
  
      <div class="boxa" id="details">
  <h4>Description</h4>
  <p><?php echo $p_desc ?></p>
 
</div>

<div class="lex">
<label class="label" >Price</label>
    <p class="price"><i class="fa-solid fa-bangladeshi-taka-sign"><?php echo $p_price;?></i></p>
    <span class="quantity"> <?php echo nl2br($p_quantity);?></span> <!-- Display quantity as text -->
</div>
    <p >
      <button class="btn btn-primary" type="submit"><i class='fa fa-shopping-cart'></i>Add to cart</button>
     <span class="shopmore"><a href="shop.php"><i class="fa-sharp fa-solid fa-arrow-left"></i>Shop More</a></span>
     
   
    
 
    </p>
  </form>

  </div>
 
  
  
</div>
</div>











<div class="hot">

<h2>Medicine Overview</h2>

</div>















<div class="content">





<div class="para">
<img src="image/dose.png"  class="post-image">
<div class="post" >
                 
                       <div class="post-preview">
                       <h4>Dosage and Administration
                       </h4>
                     
                   
                        <p class="preview-text"><?php echo nl2br($p_dos); ?></p>
                     
                       </div>
                        </div>

</div>










                        
                        </div>





                        <div class="content1">

                        <div class="para">
<img src="image/warning.png"  class="post-image">
<div class="post" >
                 
                       <div class="post-preview">
                       <h4>Warnings and Precautions
                       </h4>
                     
                   
                        <p class="preview-text"><?php echo nl2br($p_Warnings); ?></p>
                     
                       </div>
                        </div>

</div>
  

                        </div>


                        <div class="content2">

<div class="para">
<img src="image/side-effect.png"  class="post-image">
<div class="post" >

<div class="post-preview">
<h4>Side Effects
</h4>


<p class="preview-text"><?php echo nl2br($p_side); ?></p>

</div>
</div>

</div>


</div>


<div class="content3">

<!-- <div class="para"> -->

<div class="post" >

<div class="post-preview">
  <div class="laga">
<img src="image/limitation.png"  class="post-image">
<h4>Disclaimer
</h4>
</div>

<p class="preview-text">The information provided is accurate to our best practices, but it does not replace professional medical advice. We cannot guarantee its completeness or accuracy. The absence of specific information about a drug should not be seen as an endorsement. We are not responsible for any consequences resulting from this information, so consult a healthcare professional for any concerns or questions.</p>

</div>
</div>

<!-- </div> -->


</div>


















  <?php
$get_product="select * from products order by 1 LIMIT 0,0";
$run_product=mysqli_query($con,$get_product);
while ($row=mysqli_fetch_array($run_product)) {

  $pro_id=$row['product_id'];
  $product_title=$row['product_title'];
   $product_price=$row['product_price'];
    $product_img1=$row['product_img1'];

    echo "
    <div class='d-3'>
    <div class='product same-height'>
    <a href='details.php?pro_id=$pro_id'>
    <img src='admin_area/product_images/$product_img1' class='img-responsive' width='150' >

    </a>
    <div class='tet'>
    <h3> <a href='details.php?pro_id=$pro_id'>$product_title</a> </h3>
    <p class='price'>$product_price </p>

    </div>
    </div>
    </div>



    ";

}

    ?>

</div>


<!--footer all-->
<footer>
        <div class="row">
            <div class="col">
                <a href="Aboutus.html">
                <img src="./image/icon.png"class=logofoot height="50" weidth="40">
                <p>Visit Aroma Pharmacy</p><p>To unlock a Healthier you </p>                </a>
                <div class="social-icons">
          
             <span class="itwo"><i class="bx bxl-whatsapp"></i></span>
              <span class="ithree"><i class="bx bxl-messenger"></i></span>
                          <span class="ione"><i class="bx bxl-facebook-circle"></i></span>
              <span class="ifour"><i class="bx bxl-instagram-alt"></i></span>
            </div>
            </div>
            <div class="col">
            <h3>Our Details <div class="underline"><span></span></div></h3>

            <p class="email-id"><a href="mailto:u2008023@student.cuet.ac.bd">u2008023@student.cuet.ac.bd</a></p>
            <h4><p>+880-1876220119</p></h4>

            </div>
    
            <div class="col">
                <h3>Links <div class="underline"><span></span></div></h3>
                <ul>
                    <li><a href="home.html"><p></p>Home</a></li>
                    <li><a href="Product and services.html">Product & Services</a></li>
                    <li><a href="">Ask a doctor</a></li>

                    <li><a href="Article.html">Article</a></li>
                    <li><a href="contactus.html">  Contact </a></li>
                    
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
        <p class="copyright"> &copy2024 Aroma Pharmacy.All Rights Reserved; Designed by  <span class="design"> MUHAMMAD JUNAYED </span>        </p>        </p>
    </footer> 

</body></html>