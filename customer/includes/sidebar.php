<div class="panel panel-default sidebar-menu">
    <div class="panel-heading">
        <?php
        $session_customer = $_SESSION['customer_email'];
        $get_cust = "SELECT * FROM customers WHERE customer_email='$session_customer'";
        $run_cust = mysqli_query($con, $get_cust);
        $row_customers = mysqli_fetch_array($run_cust);
        $customer_image = $row_customers['customer_image'];
        $customer_name = $row_customers['customer_name'];
        if (!isset($_SESSION['customer_email'])) {
        } else {
            echo "<center>
                <img src='customer_images/$customer_image' class='img-responsive'>
            </center>
            <br>
            <h3 align='center' class='panel-title'> $customer_name</h3>";
        }
        ?>
    </div>
    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            <li class="abc">
                <a href="my_account.php?my_order"><i class="fa fa-list-alt"></i> My Orders</a>
            </li>
            <li>
                <a href="my_account.php?pay_offline"><i class="fa fa-money"></i> Pay Offline</a>
            </li>
            <li>
                <a href="my_account.php?edit_act"><i class="fa fa-pencil-square"></i> Edit Account </a>
            </li>
            <li>
                <a href="my_account.php?change_pass"><i class="fa fa-key"></i> Change Password</a>
            </li>
            <li>
                <a href="my_account.php?delete_ac"><i class="fa fa-trash"></i> Delete Account</a>
            </li>
            <li>
                <a href="../logout.php"><i class="fa fa-user-plus"></i> Logout</a>
            </li>
        </ul>
    </div>
</div>
