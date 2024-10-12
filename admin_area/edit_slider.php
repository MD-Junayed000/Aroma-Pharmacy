<?php  
if (!isset($_SESSION['admin_email'])){

  echo "<script>window.open('login.php','_self')</script>";
  }else{

?>

<?php

if (isset($_GET['edit_slide'])) {
	$edit_id=$_GET['edit_slide'];
	$edit_slide="select * from slider where Id='$edit_id'";

	$run_edit=mysqli_query($con,$edit_slide);
	$row_edit=mysqli_fetch_array($run_edit);

	$slide_id=$row_edit['Id'];
	$slide_name=$row_edit['slider_name'];

	$slide_image=$row_edit['slider_image'];
	$slide_url=$row_edit['slider_url'];

}

?>

<div class="row"><!--breadcrump start-->
	<div class="col-lg-12">
		<div class="breadcrump">
			<li class="active">
				<i class="fa fa-bar-chart"></i>
				Dashboard / Edit Slider
			</li>
		</div>
	</div>
</div><!--breadcrump End-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title">
					<i class="fa fa-money fa-fw"> Edit Slider</i>
				</h3>
			</div><!--panel-heading End-->
			<div class="panel-body">
				<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-md-3 control-label">Slider Name</label>
						<div class="col-md-6">                                                     
						<input type="text" name="slider_name" class="form-control" required value="<?php echo $slide_name; ?>" >
					</div>
				</div>
				<div class="form-group">
						<label class="col-md-3 control-label">Slider Url</label>
						<div class="col-md-6">                                                     
						<input type="text" name="slider_url" class="form-control" required value="<?php echo $slide_url; ?>" >
					</div>
				</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Slide Image</label>
						<div class="col-md-6">

							<input type="file" name="slider_image" class="form-control">
							<br>
						<img src="slider_images/<?php echo $slide_image ?>" width="70" height="70">

                      </div>
					</div>
							
					
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
						<input type="submit" name="update" value="Update Now" class="btn btn-primary form-control">
					</div>
				</div>

				</form>
			</div>
		</div>
	</div>	
</div>

<?php
if (isset($_POST['update'])) {
	$slide_name=$_POST['slider_name'];
	$slide_image=$_FILES['slider_image']['name'];
	$temp_name=$_FILES['slider_image']['tmp_name'];
	$slide_url=$_POST['slider_url'];

	move_uploaded_file($temp_name,"slider_images/$slide_image");

	$update_slide="update slider set slider_name='$slide_name',slider_image='$slide_image',slider_url='$slide_url' where Id='$slide_id'";
	$run_slide=mysqli_query($con,$update_slide);
	if ($run_slide) {
		echo "<script>alert('One slide has been updated')</script>";
		echo "<script>window.open('index.php?view_slider','_self')</script>";
	}



}


  ?>


<?php } ?>