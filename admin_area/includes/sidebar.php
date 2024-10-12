<?php  
if (!isset($_SESSION['admin_email'])){

  echo "<script>window.open('login.php','_self')</script>";
  }else{

 

?>

<nav class="navbar navbar-inverse navbar-fixed-top" >
	<div class="navbar-header">
		
			<span class="sr-only"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>

		</button>
		<a href="index.php?dashboard" class="navbar-brand"><span>Admin Panel</span></a>
	</div>
	
		<div class="dropdown">
		 <button onclick="myFunction()" class="dropbtn"><i class="fa fa-user"></i> <?php echo $admin_name; ?></a></button>

			  <div id="myDropdown" class="dropdown-content">
    <a href="index.php?view_user"><i class="fa fa-fw-user"></i>Profile</a>
    <a href="index.php?view_product"><i class="fa fa-fw-envelope"></i>Products

     <span class="badge"><?php echo $count_pro ?></span></a>


    <a href="index.php?view_customer"><i class="fa fa-fw-users"></i>Customer 
      <span class="badge"><?php echo $count_cust ?></span></a>
    </a>
    <a href="index.php?view_product_cat"><i class="fa fa-fw-gear"></i>Product Categories
        <span class="badge"><?php echo $count_p_cat ?></span></a>
    </a>
   
    <a class="divider" href="logout.php"> Logout <i class="fa fa-fw fa-power-off"></i></a>

  </div>
				
		</div>	
	<div class="collapse navbar-collapse navbar-ex1-collapse">	
	<ul class="nav navbar-nav side-nav">
  <li>
    <a href="index.php?dashboard"><i class="fa fa-bar-chart"></i> Dashboard</a>
  </li>
  <li class="button-dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-users"></i>  Users <i class="fa fa-fw fa-caret-down"></i></a>

    <ul id="#users" class="dropdown-menu">
      <li>
        <a href="index.php?insert_user">Insert User</a>
      </li>
      <li>
        <a href="index.php?view_user">view User</a>
      </li>
      <li>
        <a href="index.php?user_profile=<?php echo $admin_id ?>">Edit Profile</a>
      </li>
     </ul>
  </li>
  
  <li class="button-dropdown" id="#products">
    <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#products"><i class="fa fa-fw fa-shopping-bag"></i> Product <i class="fa fa-fw fa-caret-down"></i></a>

    <ul class="dropdown-menu" id="products">
      <li>
        <a href="index.php?insert_product">Insert Product</a>
      </li>
      <li>
        <a href="index.php?view_product">view Product</a>
      </li>
     </ul>
  </li>
  <li class="button-dropdown" id="#products_cat">
    <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#products_cat"><i class="fa fa-fw fa-store"></i> Product Categories <i class="fa fa-fw fa-caret-down"></i></a>

    <ul id="#products_cat" class="dropdown-menu">
      <li>
        <a href="index.php?insert_product_cat">Insert Product Categories</a>
      </li>
      <li>
        <a href="index.php?view_product_cat">view Product Categories</a>
      </li>
     </ul>
  </li>
  <li class="button-dropdown" id="#category">
    <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#category"><i class="fa fa-fw fa-th-list"></i> Categories <i class="fa fa-fw fa-caret-down"></i></a>

    <ul id="#category" class="dropdown-menu">
      <li>
        <a href="index.php?insert_categories">Insert Category</a>
      </li>
      <li>
        <a href="index.php?view_categories">view Category</a>
      </li>
     </ul>
  </li>

<li class="button-dropdown" >
  <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#boxes">
    <i class="fa fa-fw fa-boxes"></i> Boxes Section <i class="fa fa-fw fa-caret-down"></i>
  </a>
  <ul id="#boxes" class="dropdown-menu">
    <li>
      <a href="index.php?insert_box">Insert Box</a>
    </li>
     <li>
      <a href="index.php?view_box">View Box</a>
    </li>

  </ul>
</li>

  <li class="button-dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#slider"><i class="fa fa-fw fa-sliders-h"></i>  Slider <i class="fa fa-fw fa-caret-down"></i></a>

    <ul id="#slider" class="dropdown-menu">
      <li>
        <a href="index.php?insert_slider">Insert Slider</a>
      </li>
      <li>
        <a href="index.php?view_slider">view Slider</a>
      </li>
     </ul>
  </li>
  <li>
  	<a href="index.php?view_customer">
  		<i class="fa fa-fw fa-user-circle"></i> View Customer
  	</a>
  </li>
  <li>
  	<a href="index.php?view_order">
  		<i class="fa fa-fw fa-list"></i> View Order
  	</a>
  </li>
  <li>
  	<a href="index.php?view_payments">
  		<i class="fa fa-fw fa-money-bill"></i> View Payments
  	</a>
  </li>
  

  <li>
    <a href="view_messages.php"><i class="fa fa-envelope fa-fw"></i> View message</a>
  </li>
  <li>
    <a href="create_article.php"><i class="fa fa-fw fa-edit"></i> Create Article</a>
  </li>
  <!-- Existing sidebar items -->
</ul>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
</nav>

<script>
	$('.collapse > .a').click(function(){
       $(this).parent().siblings().find('li').fadeOut(500);
       $(this).next('li').stop(true,false,true).fadeToggle(500);
       return false;
	});

</script>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>



<script>

jQuery(document).ready(function (e) {
    function t(t) {
        e(t).bind("click", function (t) {
            t.preventDefault();
            e(this).parent().fadeOut()
        })
    }
    e(".dropdown-toggle").click(function () {
        var t = e(this).parents(".button-dropdown").children(".dropdown-menu").is(":hidden");
        e(".button-dropdown .dropdown-menu").hide();
        e(".button-dropdown .dropdown-toggle").removeClass("active");
        if (t) {
            e(this).parents(".button-dropdown").children(".dropdown-menu").toggle().parents(".button-dropdown").children(".dropdown-toggle").addClass("active")
        }
    });
    e(document).bind("click", function (t) {
        var n = e(t.target);
        if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-menu").hide();
    });
    e(document).bind("click", function (t) {
        var n = e(t.target);
        if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-toggle").removeClass("active");
    })
});</script>

<?php } ?>