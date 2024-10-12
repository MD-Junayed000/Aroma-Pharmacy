<?php

$con = mysqli_connect("localhost","root","","aroinsa");

if (!isset($_SESSION['customer_email'])) {
    echo "<script>window.open('../checkout.php','_self')</script>";
} else {
    $customer_email = $_SESSION['customer_email'];
    $get_customer = "SELECT * FROM customers WHERE customer_email='$customer_email'";
    $run_customer = mysqli_query($con, $get_customer);
    $row_customer = mysqli_fetch_array($run_customer);
    $customer_email=$row_customer['customer_email'];
    $customer_id = $row_customer['customer_id'];
    $customer_name = $row_customer['customer_name'];
    $customer_country = $row_customer['customer_country'];
    $customer_city = $row_customer['customer_city'];
    $customer_contact = $row_customer['customer_contact'];
    $customer_address = $row_customer['customer_address'];
    $customer_image = $row_customer['customer_image'];

    if (isset($_POST['update'])) {
        // Retrieve form data
        $c_name = mysqli_real_escape_string($con, $_POST['c_name']);
        $c_country = mysqli_real_escape_string($con, $_POST['c_country']);
        $c_city = mysqli_real_escape_string($con, $_POST['c_city']);
        $c_contact = mysqli_real_escape_string($con, $_POST['c_contact']);
        $c_address = mysqli_real_escape_string($con, $_POST['c_address']);

        // Handle file upload
        if ($_FILES['c_image']['name'] != "") {
            $c_image = $_FILES['c_image']['name'];
            $c_image_tmp = $_FILES['c_image']['tmp_name'];
            move_uploaded_file($c_image_tmp, "customer_images/$c_image");
        } else {
            // If no new image uploaded, use the existing image
            $c_image = $customer_image;
        }

        // Update query
        $update_customer = "UPDATE customers SET customer_name='$c_name', customer_country='$c_country', customer_city='$c_city', customer_contact='$c_contact', customer_address='$c_address', customer_image='$c_image' WHERE customer_id='$customer_id'";
        
        $run_update = mysqli_query($con, $update_customer);

        if($run_update){
            echo "<script>alert('Your information has been updated successfully')</script>";
            echo "<script>window.open('my_account.php?my_order','_self')</script>";
        } else {
            echo "<script>alert('Failed to update information')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <!-- Add your CSS links here -->
</head>
<body>
    <!-- Your HTML content goes here -->
    <div class="rx123">
        <h2>Edit Account Information</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="roup">
                <label for="name">Name:</label>
                <input type="text" class="trol" id="name" name="c_name" value="<?php echo $customer_name; ?>">
            </div>
            <div class="roup">
	<label> Email</label>
	<input type="email" name="c_email" class="trol" value="<?php echo $customer_email; ?>" disabled> 	
</div>
            <div class="roup">
                <label for="country">Country:</label>
                <input type="text" class="form-control" id="country" name="c_country" value="<?php echo $customer_country; ?>">
            </div>
            <div class="roup">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="c_city" value="<?php echo $customer_city; ?>">
            </div>
            <div class="roup">
                <label for="contact">Contact Number:</label>
                <input type="text" class="form-control" id="contact" name="c_contact" value="<?php echo $customer_contact; ?>">
            </div>
            <div class="roup">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="c_address" value="<?php echo $customer_address; ?>">
            </div>
            <div class="roup">
                <label for="image">Customer Image:</label>
                <input type="file" class="form-control" id="image" name="c_image">
                <img src="customer_images/<?php echo $customer_image; ?>" width="100" height="100" alt="Customer Image">
            </div>
            <button type="submit" class="btnss btn-primary" name="update">Update Information</button>
        </form>
    </div>
    <!-- Your script and CSS links here -->
</body>
</html>
<?php } ?>
