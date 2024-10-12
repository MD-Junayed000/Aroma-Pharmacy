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
				Dashboard / View Box
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
					View Box
				</h3>
            </div><!--panel-heading End-->
	
<div class="panel-bodybb">
	<?php
         $get_boxes="select * from boxes_section";
         $run=mysqli_query($con,$get_boxes);
         while ($row=mysqli_fetch_array($run)) {
         	$box_id=$row['box_id'];
         	$box_icon=$row['box_icon'];
         	$box_title=$row['box_title'];
         	$box_desc=$row['box_desc'];
         

	  ?>

	  <div class="col-lg-4 col-md-4">
	  	<div class="panel panel-primary">
	  	
	  	  <div class="icons">
        <i class="<?php echo $box_icon; ?>"></i>
	  			<h3 class="panel-title" align="left">
	  				<?php echo $box_title; ?>
	  				
	  			</h3>
	  			<p><?php echo $box_desc ?></p>

	  		</div>
	  		
	  		
	  		<div class="panel-footer">
	  			<a href="index.php?delete_box=<?php echo $box_id; ?>" class="pull-left">
	  				<i class="fa fa-trash"></i> Delete
	  			</a>
	  			<a href="index.php?edit_box=<?php echo $box_id; ?>" class="pull-right">
	  				<i class="fa fa-pen"></i> Edit
	  			</a>
	  			<div class="clearfix"></div>
	  		</div>
	  	</div>
	  </div>
 <?php } ?> 
	</div>
	</div>
</div>



<?php } ?>