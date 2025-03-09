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
    <title>Aroma Pharmacy</title>
    <link rel="stylesheet" href="Article.css">
    <link rel="stylesheet" href="head.css" />
    <link rel="stylesheet" href="footer.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="./image/icon.png" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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
        <li><a href="Ask a doctor.php">Ask a Doctor</a></li>
        <li><a href="Article.php"class="active">Article</a></li>
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


















  <!-- JavaScript for Search Icon Click Behavior -->
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

 <!-- Blog Posts Section -->
 <div class="hero">
        <video autoplay loop muted plays-inline class="background-clip">
            <source src="hands_-_34211 (Original).mp4" type="video/mp4">
        </video>
        <div class="video-content">
            <h1>“Eat healthily, sleep well, breathe deeply, move harmoniously.”</h1>
            <p>Jean-Pierre Barral</p>
        </div>
    </div>

    <div class="content clearfix">
        <div class="main-content">
            <h1 class="recent-post-title" data-text="Recent "> Posts</h1>

            <?php
                // Database connection
                $conn = new mysqli("localhost", "root", "", "aroinsa");


                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch articles from the database
                $sql = "SELECT title, author, date, content, image_path, read_more_link FROM articles ORDER BY date DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Sanitize title for ID
                        $sanitizedTitle = preg_replace('/[^a-zA-Z0-9_-]/', '', str_replace(' ', '_', strtolower($row["title"])));

                        echo '<div class="post" id="' . $sanitizedTitle . '" data-aos="fade-left" data-aos-offset="200" data-aos-delay="100" data-aos-duration="3000">';
                        echo '<img src="admin_area/uploads/' . basename($row["image_path"]) . '" alt="Browser does not support" class="post-image">';
                        echo '<div class="post-preview">';
                        echo '<h2><a href="' . $row["read_more_link"] . '">' . $row["title"] . '</a></h2>';
                        echo '<i class="bx bxs-user">' . $row["author"] . '</i>&nbsp;';
                        echo '<i class="bx bxs-calendar">' . date('F j, Y', strtotime($row["date"])) . '</i>';
                        echo '<p class="preview-text">' . $row["content"] . '</p>';
                        echo '<a href="' . $row["read_more_link"] . '" class="btn read-more">Read More</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No articles found.</p>";
                }

                $conn->close();
            ?>
        </div>
    </div>

    <!-- Scroll to Top Button -->
    <button id="btnScrollToTop" onclick="scrollToTop()" data-aos="fade-up" data-aos-delay="2000" data-aos-duration="3000" data-aos-offset="250">
        <i class='bx bx-up-arrow-alt'></i>
    </button>
    <script>
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: "smooth"
            });
        }

        // Check if the URL contains a fragment and scroll to that element
        window.addEventListener('load', function() {
            const hash = window.location.hash;
            if (hash) {
                const targetElement = document.querySelector(hash);
                if (targetElement) {
                    targetElement.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    </script>

  <!--footer all-->
  <footer>
        <div class="row">
            <div class="col">
                <a href="Aboutus.php">
                <img src="./image/icon.png"class=logofoot height="50" weidth="40">
                <p>Visit Aroma Pharmacy</p><p>To unlock a Healthier you </p>
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
 
            <p class="email-id"><a href="mailto:u2008023@student.cuet.ac.bd">u2008023@student.cuet.ac.bd</a></p>
            <h4><p>+880-1876220119</p></h4>
        
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
        <p class="copyright"> &copy2024 Aroma Pharmacy.All Rights Reserved; Designed by  <span class="design"> MUHAMMAD JUNAYED </span>        </p>
        </p>
    </footer>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>