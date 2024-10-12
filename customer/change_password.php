
<div class="rx">
	<center>
		<h3>Change Your Password</h3>
	</center>
	<form action="" method="post">
		<div class="roup">
			<label>Enter Your Current Password</label>
			<input type="text" name="old_password" class="form-control">
		</div>
		<div class="roup">
			<label>Enter New Password</label>
			<input type="password" name="new_password" class="form-control">
		</div>
	<div class="roup">
		<label>Confirm new password</label>
		<input type="password" name="c_n_password" class="form-control">
	</div>
	<div class="text-center">
		<center><button class="btn btn-primary btn-lg" name="update" type="submit">Update Now</button></center>
	</div>
</form>
</div>

<?php
if (isset($_POST['update'])) {
	$c_email=$_SESSION['customer_email'];
	$old_password=$_POST['old_password'];
	$new_password=$_POST['new_password'];
	$c_n_password=$_POST['c_n_password'];
	$select_cust="select * from customers where customer_email='$c_email' AND customer_pass='$old_password'";
	$run_q=mysqli_query($con,$select_cust);
	$check_old_pass=mysqli_num_rows($run_q);

	if ($check_old_pass==0){
		echo "<script> alert('Your Current Password is not valid..Try again') </script>";
		exit();
	}

	if ($new_password!=$c_n_password) {
		echo "<script> alert('Your New Password does not match with confirm password') </script>";
		exit();
	}
	$update_q="update customers set customer_pass='$new_password' where customer_email='$c_email'";
	$run_q=mysqli_query($con,$update_q);

	echo "<script> alert('Your Password Changed') </script>";
	echo "<script> window.open('my_account.php?my_order') </script>";
}

  ?>
