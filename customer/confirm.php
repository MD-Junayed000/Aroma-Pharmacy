<?php
session_start();
if (!isset($_SESSION['customer_email'])) {
    echo "<script>window.open('../checkout.php','_self')</script>";
} else {
    include("../includes/db.php");
    include("../functions/functions.php");

    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aroma Pharmacy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="../styleacc.css">
    <link rel="stylesheet" href="head.css">
    
    <link rel="icon" type="image/png" href="../image/icon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"  />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>
<body>
<header>
    <a href="index.php" class="logo"><img src="../image/Medical Care23.png" title="" /></a>
    <ul class="navigation-menu">
        <div class="search-form">
            <form id="searchForm" action="search.php" method="GET">
                <input type="text" placeholder="Search..." name="search" id="searchInput">
                <span class="search" id="searchIcon"><i class="bx bx-search"></i></span>
            </form>
        </div>
        <li><a href="../index.php">Home</a></li>
        <li><a href="../shop.php" class="active">Product & Services</a></li>
        <li><a href="../Ask a doctor.php">Ask a Doctor</a></li>
        <li><a href="../Article.php">Article</a></li>
        <li><a href="../contactus.php">Contact</a></li>
    </ul>
    <a href="../cart.php">
        <div class="cart">
            <i class="bx bx-cart"></i>
            <div id="cartAmount" class="cartAmount"><?php echo item(); ?></div>
        </div>
    </a>
    <div>
        <?php
        if (!isset($_SESSION['customer_email'])) {
            echo "<a href='checkout.php' class='loginbtn5'><i class='bx bxs-user-detail'></i></a>";
        } else {
            $customer_email = $_SESSION['customer_email'];
            $get_customer = "SELECT customer_name FROM customers WHERE customer_email='$customer_email'";
            $run_customer = mysqli_query($con, $get_customer);
            $row_customer = mysqli_fetch_array($run_customer);
            $customer_name = $row_customer['customer_name'];
            echo "<a href='customer/my_account.php?my_order' class='loginbtn5'>$customer_name</a>";
        }
        ?>
    </div>
</header>

<section class="content" id="content">
    <div class="container">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><span>My Account</span></li>
            </ul>
        </div>
    </div>
</section>

<div class="co-9">
    <div class="trx">
        <h1 align="center">Please confirm your payment</h1>
        <form action="confirm.php?update_id=<?php echo $order_id ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label> Invoice Number</label>
                <input type="text" class="form-control" name="invoice_number" required="">
            </div>
            <div class="form-group">
                <label> Amount</label>
                <input type="text" class="form-control" name="amount" required="">
            </div>
            <div class="form-group">
                <label>Select Payment Mode</label>
                <select class="form-control" name="payment_mode">
                    <option>Bank transfer</option>
                    <option>Bkash</option>
                    <option>Nagad</option>
                    <option>Visa</option>
                    <option>Master Card</option>
                </select>
            </div>
            <div class="form-group">
                <label>Transaction Number</label>
                <input type="text" class="form-control" name="trfr_number" required="">
            </div>
            <div class="form-group">
                <label>Payment Date</label>
                <input type="date" class="form-control" name="date" required="">
            </div>
            <div class="text-center">
                <button type="submit" name="confirm_payment" class="btnss btn-primary btn-lg">Confirm Payment</button>
            </div>
        </form>

        <?php
        if (isset($_POST['confirm_payment'])) {
            $update_id = $_GET['update_id'];
            $invoice_number = $_POST['invoice_number'];
            $amount = $_POST['amount'];
            $payment_mode = $_POST['payment_mode'];
            $trfr_number = $_POST['trfr_number'];
            $date = $_POST['date'];

            // Fetch all orders with the same invoice number
            $get_orders = "SELECT * FROM customer_order WHERE invoice_no='$invoice_number'";
            $run_orders = mysqli_query($con, $get_orders);

            $remaining_amount = $amount;

            while ($row_order = mysqli_fetch_array($run_orders)) {
                $order_id = $row_order['order_id'];
                $order_due_amount = $row_order['due_amount'];

                if ($remaining_amount > 0) {
                    if ($remaining_amount >= $order_due_amount) {
                        // Pay off this order completely
                        $new_due_amount = 0;
                        $amount_to_pay = $order_due_amount;
                    } else {
                        // Partially pay this order
                        $new_due_amount = $order_due_amount - $remaining_amount;
                        $amount_to_pay = $remaining_amount;
                    }

                    // Update this order's due amount and status
                    $order_status = ($new_due_amount > 0) ? 'Unpaid' : 'Paid';
                    $update_order = "UPDATE customer_order SET amount_paid=amount_paid + '$amount_to_pay', due_amount='$new_due_amount', order_status='$order_status' WHERE order_id='$order_id'";
                    mysqli_query($con, $update_order);

                    // Reduce the remaining amount
                    $remaining_amount -= $amount_to_pay;
                }
            }

            // Insert the payment details into the payments table
            $insert = "INSERT INTO payments (invoice_id, amount, payment_mode, ref_no, payment_date) VALUES ('$invoice_number', '$amount', '$payment_mode', '$trfr_number', '$date')";
            mysqli_query($con, $insert);

            echo "<script>alert('Your payment has been received');</script>";
            echo "<script>window.open('my_account.php?my_order','_self');</script>";
        }
        ?>
    </div>
</div>

<div class="content1" id="content1">
    <div class="container1">
        <div class="col-md-3">
            <?php include("includes/sidebar.php"); ?>
        </div>
    </div>
</div>

</body>
</html>

<?php } ?>
