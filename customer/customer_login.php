
<div class="rx">
    <div class="box-header">
        <center>
            <h2>Login</h2>
            <p class="lead">Already our customer</p>
        </center>
    </div>
    <form action="" method="post">
        <div class="roup">
            <label>Email: </label>
            <input type="text" class="form-control" name="c_email" required="" placeholder="Enter Email Address">
        </div>
        <div class="roup">
            <label>Password: </label>
            <input type="password" class="form-control" name="c_password" required=""placeholder="Enter Password">
        </div>
        <center class="forgot">
    <a href="forgot_password.php">
        <h3>Forgotten Your Password?</h3>
    </a>
</center>
        <div class="text-center">
            <button name="login" value="login" class="btn btn-primary"><i class="fa-solid fa-right-to-bracket"></i> Log In</button>
        </div>
    </form>
    <center class="regis"><a href="customer_registration.php">
        <h3>New? Register Now</h3>
    </a></center>

</div>

<?php
if (isset($_POST['login']) || isset($_POST['admin_login'])) {
    $email = mysqli_real_escape_string($con, $_POST['c_email']);
    $password = mysqli_real_escape_string($con, $_POST['c_password']);
    
    // Check for admin
    $get_admin = "SELECT * FROM admins WHERE admin_email='$email' AND admin_pass='$password'";
    $run_admin = mysqli_query($con, $get_admin);
    $count_admin = mysqli_num_rows($run_admin);
    
    if ($count_admin == 1) {
        $_SESSION['admin_email'] = $email;
        echo "<script>alert('You are logged in as admin')</script>";
        echo "<script>window.open('admin_area/index.php?dashboard','_self')</script>";
    } else {
        // Check for customer
        $get_customer = "SELECT * FROM customers WHERE customer_email='$email' AND customer_pass='$password'";
        $run_customer = mysqli_query($con, $get_customer);
        $count_customer = mysqli_num_rows($run_customer);
        
        if ($count_customer == 1) {
            $_SESSION['customer_email'] = $email;
            echo "<script>alert('You are logged in')</script>";
            echo "<script>window.open('customer/my_account.php?my_order','_self')</script>";
        } else {
            echo "<script>alert('Email / Password Wrong')</script>";
        }
    }
}
?>
