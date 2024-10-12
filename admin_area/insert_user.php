<?php  
if (!isset($_SESSION['admin_email'])){

  echo "<script>window.open('login.php','_self')</script>";
  }else{

?>

<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrump">
			<li class="active">
				<i class="fa fa-bar-chart"> </i>
				Dashboard / Insert User
			</li>
		</ol>
	</div>	
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
				<i class="fa fa-fw fa-users"></i>
					Insert User
				</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontals" action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-md-3 control-label"> User Name: </label>
						<div class="col-md-6">
							<input type="text" name="admin_name" class="form-control" required="">
						</div>
					</div>
					<div class="form-group">
					<label class="col-md-3 control-label"> User Email: </label>
					<div class="col-md-6">
						<input type="text" name="admin_email" class="form-control" required="">
					</div>
						
					</div>
					<div class="form-group">
					<label class="col-md-3 control-label"> User Password: </label>
					<div class="col-md-6">
						<input type="text" name="admin_pass" class="form-control" required="">
					</div>
						
					</div>
					<div class="form-group">
					<label class="col-md-3 control-label"> Country: </label>
					<div class="col-md-6">
						<input type="text" name="admin_country" class="form-control" required="">
					</div>
						
					</div>
					<div class="form-group">
					<label class="col-md-3 control-label"> User Job: </label>
					<div class="col-md-6">
						<input type="text" name="admin_job" class="form-control" required="">
					</div>
						
					</div>
					<div class="form-group">
					<label class="col-md-3 control-label"> User Contact: </label>
					<div class="col-md-6">
						<input type="text" name="admin_contact" class="form-control" required="">
					</div>
						
					</div>
					<div class="form-group">
					<label class="col-md-3 control-label"> User About: </label>
					<div class="col-md-6">
						<textarea name="admin_about" class="form-controlabout2" rows="3"></textarea>
					</div>
						
					</div>
					<div class="form-group1">
					<label class="col-md-3 control-label"> User Image: </label>
					<div class="col-md-6">
						<input type="file" name="admin_image" class="form-control" required="">
					</div>
						
					</div>
					<div class="form-group2">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<input type="submit" name="submit" value="Insert User" class="btn btn-primary form-control">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 
if (isset($_POST['submit'])) {
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

	$insert_admin="insert into admins (admin_name,admin_email,admin_pass,admin_image,admin_contact,admin_country,admin_job,admin_about) values ('$admin_name','$admin_email','$admin_pass','$admin_image','$admin_contact','$admin_country','$admin_job','$admin_about')";
	$run_admin=mysqli_query($con,$insert_admin);
	if ($run_admin) {
		echo "<script>alert('One New User has been inserted')</script>";
		echo "<script>window.open('index.php?view_user','_self')</script>";
	}
}


 ?>

<?php } ?>