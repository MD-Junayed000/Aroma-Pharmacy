

<div class="rx1234">
	<center>
		<h1>Do you really want to delete your account?</h1>
	
	<form action="" method="post">
		<input type="submit" name="yes" value="Yes, I want to delete" class="btnss1 btn-default">
		<input type="submit" name="no" value="No, I don't want" class="btnss1 btn-primary">
	</form></center>
</div>

<?php 

$c_email=$_SESSION['customer_email'];
if (isset($_POST['yes'])) {
	$delete_q="delete from customers where customer_email='$c_email'";
	$run_q=mysqli_query($con,$delete_q);
	if ($run_q) {
		session_destroy();
		echo "<script> alert('Your account has been deleted') </script>";
		echo "<script> window.open('../index.php','_self') </script>";
	}
}

 ?>

 <?php 

$c_email=$_SESSION['customer_email'];
if (isset($_POST['no'])) {
	
		echo "<script> window.open('../index.php','_self') </script>";
	}


 ?>