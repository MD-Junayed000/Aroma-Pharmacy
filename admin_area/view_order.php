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
                Dashboard / View Orders
            </li>
        </div>
    </div>
</div><!--breadcrump End-->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-fw fa-sliders-h"></i>
                    View Orders
                </h3>
            </div>
            <div class="panel-bodybb">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th> Order No: </th>
                                <th> Customer Email: </th>
                                <th> Invoice No: </th>
                                <th> Product ID: </th>
                                <th> Product Title: </th>
                                <th> Product Qty: </th>
                                <th> Order Date: </th>
                                <th> Total Amount Remaining: </th>
                                <th> Order Status: </th>
                                <th> Delete Order: </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 0;
                            $get_orders = "
                                SELECT co.*, c.customer_email, p.product_id, p.product_title 
                                FROM customer_order co
                                JOIN customers c ON co.customer_id = c.customer_id
                                JOIN products p ON co.product_id = p.product_id
                            ";
                            $run_orders = mysqli_query($con, $get_orders);
                            while ($row_orders = mysqli_fetch_array($run_orders)) {
                                $order_id = $row_orders['order_id'];
                                $customer_email = $row_orders['customer_email'];
                                $invoice_no = $row_orders['invoice_no'];
                                $product_id = $row_orders['product_id'];
                                $product_title = $row_orders['product_title'];
                                $qty = $row_orders['qty'];
                                $order_date = $row_orders['order_date'];
                                $due_amount = $row_orders['due_amount'];
                                $order_status = $row_orders['order_status'];
                                $i++;
                            ?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $customer_email; ?></td>
                                <td bgcolor="yellow"><?php echo $invoice_no; ?></td>
                                <td><?php echo $product_id; ?></td>
                                <td><?php echo $product_title; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $order_date; ?></td>
                                <td><?php echo $due_amount; ?></td>
                                <td>
                                    <?php 
                                        echo $due_amount > 0 ? 'pending' : 'complete';
                                    ?>
                                </td>
                                <td>
                                    <a href="index.php?order_delete=<?php echo $order_id; ?>">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
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
