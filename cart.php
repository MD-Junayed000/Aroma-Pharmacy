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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- owl carousel css file cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="stylecart.css">
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
        <li><a href="Article.php">Article</a></li>
        <li><a href="contactus.php">Contact</a></li>
    </ul>
    <a href="cart.php"class="active">
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

 
<div class="col-md-9" id="cart">
  <div class="box">
    <form action="cart.php" method="post" enctype="multipart/form-data">
      <h1>Shopping Cart</h1>
      <?php
      $ip_add = getUserIp();
      $select_cart = "SELECT * FROM cart WHERE ip_add='$ip_add'";
      $run_cart = mysqli_query($con, $select_cart);
      $count = mysqli_num_rows($run_cart);
      ?>
      <p class="text-muted">Currently you have<span> <?php echo $count ?> items</span> in your cart</p>
      <div class="table-responsive"> <!-- Added this div for responsiveness -->
        <table class="table">
          <thead>
            <tr>
              <th>Product</th>
              <th>Product Name</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th>Attributes</th>
              <th colspan="1">Delete</th>
              <th colspan="1">Sub Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $total = 0;
            while ($row = mysqli_fetch_array($run_cart)) {
              $pro_id = $row['p_id'];
              $pro_qty = $row['qty'];
              $get_product = "SELECT * FROM products WHERE product_id='$pro_id'";
              $run_pro = mysqli_query($con, $get_product);
              while ($row = mysqli_fetch_array($run_pro)) {
                $p_title = $row['product_title'];
                $p_img1 = $row['product_img1'];
                $p_price = $row['product_price'];
                $p_quantity = $row['product_quantity']; // Fetch quantity
                $sub_total = $row['product_price'] * $pro_qty;
                $total += $sub_total;
            ?>
            <tr>
    <!-- Each td has a data-label corresponding to the respective th -->
    <td data-label="Product"><img src="admin_area/product_images/<?php echo $p_img1 ?>"></td>
    <td data-label="Product Name"><?php echo $p_title ?></td>
    <td data-label="Quantity"><?php echo $pro_qty ?></td>
    <td data-label="Unit Price">Taka <?php echo $p_price ?></td>
    <td data-label="Attributes"><?php echo $p_quantity ?></td>
    <td data-label="Delete"><input type="checkbox" name="remove[]" value="<?php echo $pro_id ?>"></td>
    <td data-label="Sub Total">Taka <?php echo $sub_total ?></td>
  </tr>
            <?php } } ?>
          </tbody>
        </table>
      </div> <!-- End of table-responsive div -->

      <div class="box-footer">
        <div class="pull-left">
          <h4>Total Price</h4>
        </div>
        <div class="pull-right">
          <h4>Taka <?php echo $total; ?></h4>
        </div>
      </div>

      <div class="box-footer">
        <div class="pull-left">
          <a href="shop.php" class="btn btn-default">
            <i class="fa fa-chevron-left"></i>Continue Shopping
          </a>
        </div>
        <div class="pull-right">
          <button class="btn btn-default" type="submit" name="update" value="update cart">
            <i class="fa fa-refresh"></i> Update Cart
          </button>
        </div>
      </div>
    </form>
  </div>

  <?php
  function update_cart() {
    global $con;
    if (isset($_POST['update'])) {
      foreach ($_POST['remove'] as $remove_id) {
        $delete_product = "DELETE FROM cart WHERE p_id='$remove_id'";
        $run_del = mysqli_query($con, $delete_product);
        if ($run_del) {
          echo "<script>window.open('cart.php','_self')</script>";
        }
      }
    }
  }
  echo @$up_cart = update_cart();
  ?>
</div>

 <div class="col-m-3">
  <div class="box" id="order-summary">
    <div class="box-header">
      <h3>Order Summary</h3>
    </div>
    <p class="text-muted">
      Shipping and additional costs are calculated based on the values you have entered
    </p>
    <div class="table-responsive">
      <table class="table">
        <tr>
          <td>Ordered Items</td>
          <th><?php echo $count ?></th>
        </tr>
        <tr>
          <td>Purchased Quantities</td>
          <td> ####</td>
        </tr>
        
        <tr class="with-border"> <!-- Class added here -->
          <td>Total</td>
          <td class="net">Taka <?php echo $total ?></td>
        </tr>
      </table>
    </div>
    <a href="checkout.php" class="checkout">
    Proceed to checkout<i class="fa fa-chevron-right"></i>
  </div>
</div>


</body>
</html>
<!-- footer section   -->
