<?php  
if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {
?>

<div class="row"><!--breadcrump start-->
    <div class="col-lg-12">
        <div class="breadcrump">
            <li class="active">
                <i class="fa fa-bar-chart"></i>
                Dashboard / View Product
            </li>
        </div>
    </div>
</div><!--breadcrump End-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-fw fa-shopping-bag"></i>
                    View Product
                </h3>
            </div>
            <div class="panel-bodybb">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Product Id</th>
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Product Price</th>
                                <th>Product Keyword</th>
                                <th>Product Date</th>
                                <th>Product Delete</th>
                                <th>Product Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $get_product = "SELECT * FROM products";
                            $run_p = mysqli_query($con, $get_product);
                            while ($row = mysqli_fetch_array($run_p)) {
                                $pro_id = $row['product_id'];
                                $product_title = $row['product_title'];
                                $product_img1 = $row['product_img1'];
                                $product_price = $row['product_price'];
                                $product_keyword = $row['product_keyword'];
                                $date = $row['date'];
                            ?>
                            <tr>
                                <td><?php echo $pro_id; ?></td>
                                <td><?php echo $product_title; ?></td>
                                <td><img src="product_images/<?php echo $product_img1 ?>" width="60" height="50"></td>
                                <td><?php echo $product_price; ?></td>
                                <td><?php echo $product_keyword; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                    <a href="index.php?delete_product=<?php echo $pro_id ?>"> <i class="fa fa-trash"></i> Delete </a>
                                </td>
                                <td>
                                    <a href="index.php?edit_product=<?php echo $pro_id ?>"> <i class="fa fa-pen"></i> Edit </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>
