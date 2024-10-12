<?php
session_start();
include("includes/db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" type="image/png" href="icon.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="container">
    <form class="form-login" action="" method="post">
        <h2 class="form-login-heading">Admin Login</h2>
        <input type="text" class="form-control" name="email" placeholder="Email Address" required="">
        <input type="password" class="form-control" name="password" placeholder="Password" required="">
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Log In</button>
    
    </form>
</div>
</body>
</html>

<?php
if (isset($_POST['login'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    
    // Check for admin
    $get_admin = "SELECT * FROM admins WHERE admin_email='$email' AND admin_pass='$password'";
    $run_admin = mysqli_query($con, $get_admin);
    $count_admin = mysqli_num_rows($run_admin);
    
    if ($count_admin == 1) {
        $_SESSION['admin_email'] = $email;
        echo "<script>alert('You are logged in as admin')</script>";
        echo "<script>window.open('index.php?dashboard','_self')</script>";
    } else {
        // Check for customer
        $get_customer = "SELECT * FROM customers WHERE customer_email='$email' AND customer_pass='$password'";
        $run_customer = mysqli_query($con, $get_customer);
        $count_customer = mysqli_num_rows($run_customer);
        
        if ($count_customer == 1) {
            $_SESSION['customer_email'] = $email;
            echo "<script>alert('You are logged in')</script>";
            echo "<script>window.open('./admin_area/index.php?dashboard','_self')</script>";
        } else {
            echo "<script>alert('Email / Password Wrong')</script>";
        }
    }
}
?>
