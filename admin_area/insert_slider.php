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
				Dashboard / Insert Slide
			</li>
		</ol>
	</div>	
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-fw fa-sliders-h"></i>
					Insert Slide
				</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-md-3 control-label"> Slider Name </label>
						<div class="col-md-6">
							<input type="text" name="slider_name" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"> Slider Url </label>
						<div class="col-md-6">
							<input type="text" name="slider_url" class="form-control">
						</div>
					</div>
					<div class="form-group1">
					<label class="col-md-3 control-label"> Slide Image: </label>
					<div class="col-md-6">
						<input type="file" name="slider_image" class="form-control">
					</div>
						
					</div>
					<div class="form-group2">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<input type="submit" name="submit" value="Submit Now" class="btn btn-primary form-control">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 
if (isset($_POST['submit'])) {
	$slide_name=$_POST['slider_name'];
	$slide_url=$_POST['slider_url'];

	$slide_image=$_FILES['slider_image']['name'];
	$temp_name=$_FILES['slider_image']['tmp_name'];


	$view_slides="select * from slider";
	$view_run_slides=mysqli_query($con,$view_slides);
	$count=mysqli_num_rows($view_run_slides);

	if ($count<10) {
		move_uploaded_file($temp_name,"slider_images/$slide_image");

		$insert_slide="insert into slider (slider_name,slider_image,slider_url) values ('$slide_name','$slide_image','$slide_url')";
		$run_slide=mysqli_query($con,$insert_slide);

		echo "<script>alert('New Slide has been inserted')</script>";
		echo "<script>window.open('index.php?view_slider','_self')</script>";
	}else{
		echo "<script>alert('You have already inserted 10 slides')</script>";
	}
}	



 ?>

<?php } ?>