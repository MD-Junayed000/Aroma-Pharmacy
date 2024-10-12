<?php  
if (!isset($_SESSION['admin_email'])){

  echo "<script>window.open('login.php','_self')</script>";
  }else{

 

?>
<?php

if (isset($_GET['edit_box'])) {
	$edit_box=$_GET['edit_box'];
	$get_box="select * from boxes_section where box_id='$edit_box'";

	$run_box=mysqli_query($con,$get_box);
	$row_box=mysqli_fetch_array($run_box);

	$box_id=$row_box['box_id'];
	$box_icon=$row_box['box_icon'];
	$box_title=$row_box['box_title'];

	$box_desc=$row_box['box_desc'];


}

?>


<div class="row"><!--breadcrump start-->
	<div class="col-lg-12">
		<div class="breadcrump">
			<li class="active">
				<i class="fa fa-bar-chart"></i>
				Dashboard / Edit Box
			</li>
		</div>
	</div>
</div><!--breadcrump End-->
<div class="row">
	
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><!--panel-heading start-->
				<h3 class="panel-title">
					<i class="fa fa-money fa-fw"> Edit Box </i>
				</h3>
			</div><!--panel-heading End-->
			<div class="panel-body">
				<form class="form-horizontal" method="post" action="">
					<div class="form-group">
						<label class="col-md-3 control-label">Box Title</label>
						<div class="col-md-6">                                                     
						<input type="text" name="box_title" value="<?php echo $box_title; ?>" class="form-control" required="" >
					</div>
				</div>
				<div class="form-group">
						<label class="col-md-3 control-label">Box Icon</label>
						<div class="col-md-6">                                                     
						<input type="text" name="box_icon" class="form-control" required value="<?php echo $box_icon; ?>" >
					</div>
				</div>
				<div class="form-group">
						<label class="col-md-3 control-label">Box Description</label>
						<div class="col-md-6">
						<textarea type="text" name="box_desc" class="form-control" rows="6" cols="19" ><?php echo $box_desc; ?></textarea>

                      </div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
						<input type="submit" name="submit" value="Update Box" class="btn btn-primary form-control">
					</div>

</div>

				</form>
			</div>
		</div>
	</div>	
</div>

<?php
if (isset($_POST['submit'])) {
	$box_icon=$_POST['box_icon'];
	$box_title=$_POST['box_title'];
	$box_desc=$_POST['box_desc'];
	

	$update_box="update boxes_section set box_icon='$box_icon',box_title='$box_title',box_desc='$box_desc' where box_id='$box_id'";

	$run_box=mysqli_query($con,$update_box);

	if ($run_box) {
		echo "<script>alert('Information Updated')</script>";
		echo "<script>window.open('index.php?view_box','_self')</script>";
	}


}


  ?>

<?php } ?>