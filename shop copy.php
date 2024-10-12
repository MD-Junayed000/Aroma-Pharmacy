<?php 
session_start();
include("includes/db.php");  
include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AroInsa Medicine Solution</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="styleshop.css">
    <link rel="stylesheet" href="head.css">
    <link rel="stylesheet" href="footer.css" />
    <link rel="icon" type="image/png" href="./image/icon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"  />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>
<div>
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


<section class="home" id="home">
    <h1 class="heading"><span>BEST OFFERS FOR YOU</span></h1>
    <div class="slideshow-container">
        <?php
        $get_slider = "SELECT * FROM slider LIMIT 0,1";
        $run_slider = mysqli_query($con, $get_slider);
        while ($row = mysqli_fetch_array($run_slider)) {
            $slider_name = $row['slider_name'];
            $slider_image = $row['slider_image'];
            $slider_url = $row['slider_url'];
            echo "<div class='mySlides fade'>
            <a href='$slider_url'><img src='admin_area/slider_images/$slider_image' width='1400' height='400'></a>
            </div>";
        }
        ?>
        <?php
        $get_slider = "SELECT * FROM slider LIMIT 1,10";
        $run_slider = mysqli_query($con, $get_slider);
        while ($row = mysqli_fetch_array($run_slider)) {
            $slider_name = $row['slider_name'];
            $slider_image = $row['slider_image'];
            $slider_url = $row['slider_url'];
            echo "<div class='mySlides fade'>
            <a href='$slider_url'><img src='admin_area/slider_images/$slider_image' width='1400' height='400'></a>
            </div>";
        }
        ?>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>
    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span> 
        <span class="dot" onclick="currentSlide(2)"></span> 
        <span class="dot" onclick="currentSlide(3)"></span> 
        <span class="dot" onclick="currentSlide(4)"></span> 
        <span class="dot" onclick="currentSlide(5)"></span> 
    </div>
</section>



<!-- javaslide -->

<script>
let slideIndex = 0;
const slideInterval = 5000; // Interval time for changing slides in milliseconds

function showSlides() {
  const slides = document.getElementsByClassName("mySlides");
  const dots = document.getElementsByClassName("dot");

  // Hide all slides
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  // Remove active class from all dots
  for (let i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }

  // Increment slide index and loop back if necessary
  slideIndex++;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }

  // Show the current slide
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
}

// Function to manually go to a specific slide
function plusSlides(n) {
  slideIndex += n;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  } else if (slideIndex < 1) {
    slideIndex = slides.length;
  }
  showSlides();
}

// Function to go to a specific slide by dot click
function currentSlide(n) {
  slideIndex = n;
  showSlides();
}

// Set up automatic slide change
document.addEventListener("DOMContentLoaded", () => {
  showSlides(); // Show the first slide
  setInterval(showSlides, slideInterval); // Change slides every `slideInterval` milliseconds
});
</script>















    <section class="deal" id="deal">
        <div class="icons-container">
            <?php
            $get_boxes = "SELECT * FROM boxes_section";
            $run_box = mysqli_query($con, $get_boxes);
            while ($row = mysqli_fetch_array($run_box)) {
                $box_id = $row['box_id'];
                $box_title = $row['box_title'];
                $box_desc = $row['box_desc'];
                $box_icon = $row['box_icon'];
            ?>
                <div class="icons">
                    <i class="<?php echo $box_icon; ?>"></i>
                    <h3><?php echo $box_title ?></h3>
                    <p><?php echo $box_desc ?></p>
                </div>
            <?php } ?>
      
    </section>

    <section class="content" id="content">
        <div class="container">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><span>OUR SERVICES</span></li>
                </ul>
            </div>
        </div>
    </section>  
    <div class="col-m-9">
        <?php
        if (!isset($_GET['p_cat']) && !isset($_GET['cat_id'])) {
            echo "<div class='boxi'>
            <h1></h1>
            <p> </p>
            </div>";
        }
        ?>
    </div>
  <div class="position">
    
    <div class="content1" id="content1">
        <div class="container1">
            <div class="col-md-3">
                <?php include("includes/sidebar.php"); 
                
                
                ?>
            </div>
        </div>
    </div>
    <div class="header2"> 

<p>**In Stock & Ready to Ship🛒**</p> 
</div> 
    <div class="contt" id="contar">
        
        <div class="ro">
            
        <?php
if (!isset($_GET['p_cat']) && !isset($_GET['cat_id'])) {
    $per_page = 9;//total ek page e koita items takbe
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start_from = ($page - 1) * $per_page;
    $get_product = "SELECT * FROM products ORDER BY 1 DESC LIMIT $start_from, $per_page";
    $run_pro = mysqli_query($con, $get_product);
    while ($row = mysqli_fetch_array($run_pro)) {
        $pro_id = $row['product_id'];
        $pro_title = $row['product_title'];
        $pro_price = $row['product_price'];
        $pro_quantity = $row['product_quantity']; // Fetch quantity
        $pro_img1 = $row['product_img1'];
        echo "<div class='col-md-4 col-sm-6 sing'>
        <div class='prod'>
        <a href='details.php?pro_id=$pro_id'>
        <img src='admin_area/product_images/$pro_img1' class='img-responsive' width='300' height='300'>
        </a>
        <h3><a href='details.php?pro_id=$pro_id'>$pro_title</a></h3>
        <p class='pric'><i class='fa-solid fa-bangladeshi-taka-sign'></i> $pro_price</p>
        <p class='quantity'>Available Quantity: <br>$pro_quantity</p> <!-- Display quantity as text -->
        <form action='shop.php?add_cart=$pro_id' method='post' class='form-horizontal'>
            <div class='form-group'>
                <label class='col-md-5 control-label'>Product Quantity</label>
                <div class='col-md-7'>
                    <input type='number' name='product_qty' class='form-control' min='1' step='1' value='1'>
                </div>
            </div>
            <p class='buttons'>
            <a href='details.php?pro_id=$pro_id' class='btn btn-default'>View Details</a>
                <button type='submit'class='btn btn-primary'><i class='fa fa-shopping-cart'></i> Add to Cart</button>
            </p>
        </form>
        </div>
        </div>";
    }
?>
</div>
<center>
    <ul class="pagination">
        <?php
        $query = "SELECT * FROM products";
        $result = mysqli_query($con, $query);
        $total_record = mysqli_num_rows($result);
        $total_pages = ceil($total_record / $per_page);
        echo "<li><a href='shop.php?page=1'>First Page</a></li>";
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<li><a href='shop.php?page=".$i."'>".$i."</a></li>";
        }
        echo "<li><a href='shop.php?page=$total_pages'>Last Page</a></li>";
        ?>
    </ul>
</center>
<?php } ?>
            <div class="products">
                <?php
                echo getPcatPro();
                echo getCatPro(); 
              
                ?> 
                
            </div> 
            
        </div>
        
    </div>
  
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

</div>








<footer>
        <div class="row">
            <div class="col">
                <a href="Aboutus.html">
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
            <div class="pay2"></div>
            </div>
        </div>
        <hr>
        <p class="copyright"> &copy2024 AroInsa Medicine Solution. All Rights Reserved; Designed by <span class="design">IFFAT ARA</span> & <span class="design">MUHAMMED JUNAYED</span></p>
    </footer> 
</html>
</body>


<?php
// Add to cart functionality
if(isset($_GET['add_cart'])){
    $pro_id = $_GET['add_cart'];
    $product_qty = $_POST['product_qty'];
    addCart($pro_id, $product_qty);
}
?>
