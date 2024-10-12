<div class="trx">
    <center>
        <span class="wr"><h1>My Order</h1></span>
        <p>Shipping and additional costs are calculated based on the values you have entered</p>
    </center>
    <hr>
    <div class="tae-responve">
        <table class="tab">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Due Amount</th>
                    <th>Invoice Number</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $customer_session = $_SESSION['customer_email'];
                $get_customer = "select * from customers where customer_email='$customer_session'";
                $run_cust = mysqli_query($con, $get_customer);
                $row_cust = mysqli_fetch_array($run_cust);
                $customer_id = $row_cust['customer_id'];
                $get_order = "select * from customer_order where customer_id='$customer_id'";
                $run_order = mysqli_query($con, $get_order);
                $i = 0;
                while ($row_order = mysqli_fetch_array($run_order)) {
                    $order_id = $row_order['order_id'];
                    $order_due_amount = $row_order['due_amount'];
                    $order_invoice = $row_order['invoice_no'];
                    $order_qty = $row_order['qty'];
                    $order_date = substr($row_order['order_date'], 0, 11);
                    $amount_paid = $row_order['amount_paid'];
                    $total_amount = $row_order['total_amount'];
                    $product_id = $row_order['product_id'];

                    // Fetch product name
                    $get_product_name = "SELECT product_title FROM products WHERE product_id='$product_id'";
                    $run_product_name = mysqli_query($con, $get_product_name);
                    $row_product_name = mysqli_fetch_array($run_product_name);
                    $product_name = $row_product_name['product_title'];

                    $i++;
                    if ($order_due_amount > 0) {
                        $order_status = 'Unpaid';
                        $action_button = '<a href="confirm.php?order_id=' . $order_id . '" class="btn btn-primary btn-sm">Confirm Now</a>';
                        $row_background = 'background-color: none; color: black;';
                    } else {
                        $order_status = 'Paid';
                        $action_button = '<span >Done</span>';
                        $row_background = 'background-color: bisque; color: black;';
                    }
                    ?>
                    <tr data-order-id="<?php echo $order_id; ?>" id="row_<?php echo $order_id; ?>" style="<?php echo $row_background; ?>">
                        <td><?php echo $i ?></td>
                        <td><?php echo $order_due_amount ?></td>
                        <td><?php echo $order_invoice ?></td>
                        <td><?php echo $product_name ?></td>
                        <td><?php echo $order_qty ?></td>
                        <td><?php echo $order_date ?></td>
                        <td><?php echo $order_status ?></td>
                        <td><?php echo $action_button ?></td>
                        <td>
                            <?php if($order_status == 'Paid') { ?>
                                <a href="generate_receipt.php?order_id=<?php echo $order_id ?>" target="_blank" class="btn btn-success btn-sm">Get Receipt</a>
                                <button onclick="removeRow(<?php echo $order_id; ?>)" class="btn btn-danger btn-sms">Remove</button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Check localStorage for removed rows and hide them
        let removedRows = JSON.parse(localStorage.getItem('removedRows')) || [];
        removedRows.forEach(orderId => {
            let row = document.querySelector('tr[data-order-id="' + orderId + '"]');
            if (row) {
                row.style.display = 'none';
            }
        });
    });

    function removeRow(orderId) {
        // Hide the row
        let row = document.querySelector('tr[data-order-id="' + orderId + '"]');
        if (row) {
            row.style.display = 'none';
        }

        // Update localStorage
        let removedRows = JSON.parse(localStorage.getItem('removedRows')) || [];
        if (!removedRows.includes(orderId)) {
            removedRows.push(orderId);
            localStorage.setItem('removedRows', JSON.stringify(removedRows));
        }
    }
</script>
