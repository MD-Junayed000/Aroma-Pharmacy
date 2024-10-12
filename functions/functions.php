
<?php

$db=mysqli_connect("localhost","root","","aroinsa");
//for getting user ip start
function getUserIp(){
	switch (true) {
		case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
			case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
			case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
				default : return $_SERVER['REMOTE_ADDR'];
	}
}


function addCart(){
	global $db;
	if(isset($_GET['add_cart'])) {
		$ip_add=getUserIp();
		$p_id=$_GET['add_cart'];
		$product_qty=$_POST['product_qty'];
		$product_size=$_POST['product_size'];
		$check_product="select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
		$run_check=mysqli_query($db,$check_product);
		if (mysqli_num_rows($run_check)>0) {
			echo "<script>alert('This product is already added in your cart')</script>";
			echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
		}else{
			$query="insert into cart(p_id,ip_add,qty,size ) values('$p_id','$ip_add','$product_qty','$product_size')";
			$run_query=mysqli_query($db,$query);
			echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
		}
	}
}
//items count start

function item(){
	global $db;
	$ip_add=getUserIp();
	$get_items="select * from cart where ip_add='$ip_add'";
	$run_item=mysqli_query($db,$get_items);
	$count=mysqli_num_rows($run_item);
	echo $count;
}

//items count End

//total price start

function totalPrice(){
	global $db;
	$ip_add=getUserIp();
	$total=0;
	$select_cat="select * from cart where ip_add='$ip_add'";
	$run_cart=mysqli_query($db,$select_cat);
	while ($record=mysqli_fetch_array($run_cart)) {
		$pro_id=$record['p_id'];
		$pro_qty=$record['qty'];
		$get_price="select * from products where product_id='$pro_id' ";
		$run_price=mysqli_query($db,$get_price);
		while ($row=mysqli_fetch_array($run_price)) {
			$sub_total=$row['product_price']*$pro_qty;
			$total += $sub_total;
		}
	}
echo $total;
}


//total price End
//for getting user ip start
function getPro() {
    global $db;

    $get_product = "SELECT * FROM products ORDER BY 1 DESC LIMIT 0,3";
    $run_products = mysqli_query($db, $get_product);

    while ($row_product = mysqli_fetch_array($run_products)) {
        $pro_id = $row_product['product_id'];
        $pro_title = $row_product['product_title'];
        $pro_price = $row_product['product_price'];
        $pro_quantity = $row_product['product_quantity']; // Fetch quantity
        $p_mini = $row_product['product_mini']; 
        $pro_img1 = $row_product['product_img1'];

        echo "<div class='col-md-4 col-sm-6 single'>
            <div class='product'>
                <a href='details.php?pro_id=$pro_id'>
                    <img src='admin_area/product_images/$pro_img1' class='img-responsive' width='300' height='300'>
                </a>
                <div class='cover'>
                  <h3><a href='details.php?pro_id=$pro_id'><span>$pro_title</span></a><span class='mini'>$p_mini</span></h3>
               
              
                   <form action='shop.php?add_cart=$pro_id' method='post' class='form-horizontal'>
                       <div class='form-group'>
                         <label class='quan'>Product Quantity</label>
                         <div class='col-md-7'>
                            <input type='number' name='product_qty' class='form-control' min='1' step='1' value='1'>
                         </div>
                     </div>
                    <div class='buttons1'>
					  <p class='price'> <i class='fa-solid fa-bangladeshi-taka-sign'></i> $pro_price <span class='per'> $pro_quantity  </span></p>
                        <button class='btn2' type='submit'><i class='fa fa-shopping-cart'></i> Add to Cart</button>
                    </div>
                </form>
                </div>
            </div>
        </div>";
    }
}


//product images start

/* product Categories */

function getCat(){
    global $db;
    $get_cat = "SELECT * FROM categories";
    $run_cat = mysqli_query($db, $get_cat);

    while ($row_cat = mysqli_fetch_array($run_cat)) {
        $cat_id = $row_cat['cat_id'];
        $cat_title = $row_cat['cat_title'];
        $cat_icon = $row_cat['cat_icon']; // Fetch the icon class from the database
        
        // Display the icon and category title
        echo "<li><a href='#' class='category-item' data-filter='cat_id=$cat_id'><i class='$cat_icon'></i> $cat_title</a></li>";
    }
}


function getPCats(){
    global $db;
    $get_p_cats="select * from product_category";
    $run_p_cats=mysqli_query($db,$get_p_cats);
    while ($row_p_cats=mysqli_fetch_array($run_p_cats)) {
        $p_cat_id=$row_p_cats['p_cat_id'];
        $p_cat_title=$row_p_cats['p_cat_title'];
        echo "<li><a href='shop.php?p_cat=$p_cat_id' class='category-item'><i class='fas fa-box'></i> $p_cat_title</a></li>";
    }
}


/* Get product Categories product */
function getPcatPro(){

    global $db;
    if(isset($_GET['p_cat'])){
        $p_cat_id=$_GET['p_cat'];
        $get_p_cat="select * from product_category where p_cat_id='$p_cat_id' ";
        $run_p_cat=mysqli_query($db,$get_p_cat);
        $row_p_cat=mysqli_fetch_array($run_p_cat);
        $p_cat_title=$row_p_cat['p_cat_title'];
     

        $get_products="select * from products where p_cat_id='$p_cat_id'";
        $run_products=mysqli_query($db,$get_products);
        $count=mysqli_num_rows($run_products);
        if ($count==0) {
            echo "<div class='boxi'>
            <h1>No product found in this category</h1>
            </div> ";
             }else{
                echo "<div class='boxi'>
                <h1>$p_cat_title</h1>
               

                </div>";
             }
      while ($row_products=mysqli_fetch_array($run_products)) {

      	$pro_id=$row_products['product_id'];
      		$pro_title=$row_products['product_title'];
      		$pro_price=$row_products['product_price'];
      		$pro_img1=$row_products['product_img1'];

      		echo "<div class='col-md-4 col-sm-6 sing'>
		<div class='prod'>
      		<a href='details.php?pro_id=$pro_id'>
      		<img src='admin_area/product_images/$pro_img1' class='img-responsive' width='300' height='300'>
      		</a>
      		
            <h3><a href='details.php?pro_id=$pro_id'> $pro_title </a></h3>
            <p class='pric'>Taka $pro_price</p>
            <p class='buttons'>
            <a href='details.php?pro_id=$pro_id' class='btn btn-default'> View Details </a>
            <a href='details.php?pro_id=$pro_id' class='btn btn-primary'> <i class='fa fa-shopping-cart'>Add to cart</i> </a>
            </p>
      		
      		</div>
      		</div>";
      	


      }

             }
    }

/*Get Categories */

function getCatPro(){
	global $db;
	if(isset($_GET['cat_id'])){
      $cat_id=$_GET['cat_id'];
      $get_cat="select * from categories where cat_id='$cat_id'";
      $run_cats=mysqli_query($db, $get_cat);
      $row_cat=mysqli_fetch_array($run_cats);
      $cat_title= $row_cat['cat_title'];
      
      $get_products="select * from products where cat_id='$cat_id'";
      $run_products=mysqli_query($db,$get_products);
      $count=mysqli_num_rows($run_products);
      if ($count==0) {
     
            echo "<div class='boxi'>
            <h1>No product found in this category</h1>
            </div> ";
             }else{
                echo "<div class='boxi'>
                <h1>$cat_title</h1>
               

                </div>";
             }
      while ($row_products=mysqli_fetch_array($run_products)) {

      	$pro_id=$row_products['product_id'];
      		$pro_title=$row_products['product_title'];
      		$pro_price=$row_products['product_price'];
      		$pro_img1=$row_products['product_img1'];

      		echo "<div class='col-md-4 col-sm-6 sing'>
		<div class='prod'>
      		<a href='details.php?pro_id=$pro_id'>
      		<img src='admin_area/product_images/$pro_img1' class='img-responsive' width='300' height='300'>
      		</a>
      		
            <h3><a href='details.php?pro_id=$pro_id'> $pro_title </a></h3>
            <p class='pric'>Taka $pro_price</p>
            <p class='buttons'>
            <a href='details.php?pro_id=$pro_id' class='btn btn-default'> View Details </a>
            <a href='details.php?pro_id=$pro_id' class='btn btn-primary'> <i class='fa fa-shopping-cart'>Add to cart</i> </a>
            </p>
      	
      		</div>
      		</div>";
      }



	}
}
 
  ?>
 





        