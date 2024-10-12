<?php

if (!isset($_SESSION['admin_email'])){

  echo "<script>window.open('login.php','_self')</script>";
  }else{
?>

<?php
if (isset($_GET['user_profile'])){
$edit_id=$_GET['user_profile'];
$get_admin="select * from admins where admin_id='$edit_id'";
$run_admin=mysqli_query($con,$get_admin);
$row_admin=mysqli_fetch_array($run_admin);
$admin_id=$row_admin['admin_id'];
$admin_name=$row_admin['admin_name'];
$admin_email=$row_admin['admin_email'];
$admin_pass=$row_admin['admin_pass'];
$admin_image=$row_admin['admin_image'];
$admin_country=$row_admin['admin_country'];
$admin_job=$row_admin['admin_job'];
$admin_contact=$row_admin['admin_contact'];
$admin_about=$row_admin['admin_about'];
}

  ?>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrump">
			<li class="active">
				<i class="fa fa-bar-chart"> </i>
				Dashboard / Edit Profile
			</li>
		</ol>
	</div>	
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-users"></i>
					Edit Profile
				</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-md-3 control-label"> User Name: </label>
						<div class="col-md-6">
							<input type="text" name="admin_name" class="form-control" required value="<?php echo $admin_name; ?>" >
						</div>
					</div>
					<div class="form-group">
					<label class="col-md-3 control-label"> User Email: </label>
					<div class="col-md-6">
						<input type="text" name="admin_email" class="form-control" required value="<?php echo $admin_email; ?>" >
					</div>
						
					</div>
					<div class="form-group">
					<label class="col-md-3 control-label"> User Password: </label>
					<div class="col-md-6">
						<input type="text" name="admin_pass" class="form-control" required value="<?php echo $admin_pass; ?>" >
					</div>
						
					</div>
					<div class="form-group">
					<label class="col-md-3 control-label"> Country: </label>
					<div class="col-md-6">
						<input type="text" name="admin_country" class="form-control" requiredvalue="<?php echo $admin_country; ?>" >
					</div>
						
					</div>
					<div class="form-group">
					<label class="col-md-3 control-label"> User Job: </label>
					<div class="col-md-6">
						<input type="text" name="admin_job" class="form-control" required value="<?php echo $admin_job; ?>" >
					</div>
						
					</div>
					<div class="form-group">
					<label class="col-md-3 control-label"> User Contact: </label>
					<div class="col-md-6">
						<input type="text" name="admin_contact" class="form-control" required value="<?php echo $admin_contact; ?>" >
					</div>
						
					</div>
					<div class="form-group">
					<label class="col-md-3 control-label"> User About: </label>
					<div class="col-md-6">
						<textarea name="admin_about" class="form-controlabout2" rows="3"><?php echo $admin_about; ?></textarea>
					</div>
						
					</div>
					<div class="form-group1">
					<label class="col-md-3 control-label"> User Image:</label>&nbsp&nbsp&nbsp&nbsp
					<div class="col-md-61">
						<input type="file" name="admin_image" class="form-control">
						<!-- <br><br><br> -->
						<img src="admin_images/<?php echo $admin_image; ?>" width="100" height="100">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					</div>
						
					</div>
					<div class="form-groupbtn">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<input type="submit" name="update" value="Updet User" class="btn btn-primary form-control">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 
if (isset($_POST['update'])) {
	$admin_name=$_POST['admin_name'];
	$admin_email=$_POST['admin_email'];
	$admin_pass=$_POST['admin_pass'];
	$admin_country=$_POST['admin_country'];
	$admin_job=$_POST['admin_job'];
	$admin_contact=$_POST['admin_contact'];
	$admin_about=$_POST['admin_about'];
	$admin_image=$_FILES['admin_image']['name'];
	$temp_admin_image=$_FILES['admin_image']['tmp_name'];

	move_uploaded_file($temp_admin_image,"admin_images/$admin_image");

	$update_admin="update admins set admin_name='$admin_name',admin_email='$admin_email',admin_pass='$admin_pass',admin_image='$admin_image',admin_contact='$admin_contact',admin_country='$admin_country',admin_job='$admin_job',admin_about='$admin_about' where admin_id='$admin_id'";

	$run_admin=mysqli_query($con,$update_admin);
	if ($run_admin) {
		echo "<script>alert('User has been updated and login again')</script>";
		echo "<script>window.open('login.php','_self')</script>";

		session_destroy();
	}
}


 ?>

<?php } ?>