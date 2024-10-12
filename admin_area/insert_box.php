<?php  
if (!isset($_SESSION['admin_email'])){

  echo "<script>window.open('login.php','_self')</script>";
  }else{

 

?>

<div class="row"><!--breadcrump start-->
	<div class="col-lg-12">
		<div class="breadcrump">
			<li class="active">
				<i class="fa fa-bar-chart"></i>
				Dashboard / Insert Box
			</li>
		</div>
	</div>
</div><!--breadcrump End-->
<div class="row">
	
	<div class="col-lg-12">
		<div class="panel panel-default">
		<div class="panel-heading">
            <h3 class="panel-title">
					<i class="fa fa-fw fa-boxes"></i>
					Insert Box
				</h3>
            </div><!--panel-heading End-->
			<div class="panel-body">
				<form class="form-horizontal" method="post" action="">
					<div class="form-group">
						<label class="col-md-3 control-label">Box Title</label>
						<div class="col-md-6">                                                     
						<input type="text" name="box_title" class="form-control" required="" >
					</div>
				</div>
				<div class="form-group">
						<label class="col-md-3 control-label">Box Icon</label>
						<div class="col-md-6">                                                     
						<input type="text" name="box_icon" class="form-control" required="" >
					</div>
				</div>
				<div class="form-group1">
						<label class="col-md-3 control-label">Box Description</label>
						<div class="col-md-6">
						<textarea type="text" name="box_desc" class="form-controlabout2" rows="3" ></textarea>

                      </div>
					</div>
					<div class="form-group2">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
						<input type="submit" name="submit" value="Insert Box" class="btn btn-primary form-control">
					</div>

</div>

				</form>
			</div>
		</div>
	</div>	
</div>

<?php
if (isset($_POST['submit'])) {
	$box_title=$_POST['box_title'];
	$box_desc=$_POST['box_desc'];
	$box_icon=$_POST['box_icon'];

	$insert_box="insert into boxes_section (box_icon,box_title,box_desc) values ('$box_icon','$box_title','$box_desc')";

	$run_box=mysqli_query($con,$insert_box);

	if ($run_box) {
		echo "<script>alert('New box has been Inserted successfully')</script>";
		echo "<script>window.open('index.php?view_box','_self')</script>";
	}


}


  ?>

<?php } ?>