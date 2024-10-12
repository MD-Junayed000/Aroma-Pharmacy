<?php
$db = new mysqli("localhost","root","","aroinsa");
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>

<div class="ro">
<?php
// Include your database connection

function fetchProducts($filter) {
    global $db;
    $query = "";

    if ($filter == 'all') {
        $query = "SELECT * FROM products ORDER BY 1 DESC";
    } else if (strpos($filter, 'cat_id=') !== false) {
        $cat_id = str_replace('cat_id=', '', $filter);
        $query = "SELECT * FROM products WHERE cat_id='$cat_id'";
    } else if (strpos($filter, 'p_cat=') !== false) {
        $p_cat_id = str_replace('p_cat=', '', $filter);
        $query = "SELECT * FROM products WHERE p_cat_id='$p_cat_id'";
    }

    $run_pro = mysqli_query($db, $query);
    $output = '';

    while ($row = mysqli_fetch_array($run_pro)) {
        $pro_id = $row['product_id'];
        $pro_title = $row['product_title'];
        $pro_price = $row['product_price'];
        $pro_quantity = $row['product_quantity']; // Fetch quantity
        $p_mini = $row['product_mini']; 
        $pro_img1 = $row['product_img1'];
        $output .= "<div class='col-md-4 col-sm-6 sing'>
     <div class='prod'>
        <a href='details.php?pro_id=$pro_id'>
        <img src='admin_area/product_images/$pro_img1' class='img-responsive' width='338' height='300'>
        </a>
        <h3><a href='details.php?pro_id=$pro_id'>$pro_title<span class='mini'>$p_mini</span></a></h3>
        
        <p class='pric'>Price <i class='fa-solid fa-bangladeshi-taka-sign'></i> $pro_price <span class='quantity'>$pro_quantity</span></p>
       
          <form action='shop.php?add_cart=$pro_id' method='post' class='form-horizontal'>
            <div class='form-group'>
            <div class='join'>
                <label class='controllabel'>Product Quantity</label>
                <div class='col-md-7'>
                   <div>
                        <button type='button' class='btn-decrement'>-</button>
                        <input type='' name='product_qty' class='product-qty form-control' min='1' step='1' value='1'>
                        <button type='button' class='btn-increment'>+</button>
                    </div>
                </div>
                </div>
            </div>
            <p class='buttons'>
                <a href='details.php?pro_id=$pro_id' class='btn btn-default'>View Details</a>
                <button type='submit' class='btn btn-primary'><i class='fa fa-shopping-cart'></i> Add to Cart</button>
            </p>
        </form>
        
        </div>
        </div>";
    }
    return $output;
}

if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
    echo fetchProducts($filter);
}
?>
<script>
// Attach event listeners to all increment and decrement buttons
document.querySelectorAll('.btn-increment').forEach(function(button) {
    button.addEventListener('click', function() {
        var qtyInput = this.parentNode.querySelector('.product-qty');
        qtyInput.value = parseInt(qtyInput.value) + 1;
    });
});

document.querySelectorAll('.btn-decrement').forEach(function(button) {
    button.addEventListener('click', function() {
        var qtyInput = this.parentNode.querySelector('.product-qty');
        if (parseInt(qtyInput.value) > 1) {
            qtyInput.value = parseInt(qtyInput.value) - 1;
        }
    });
});
</script>
</div>