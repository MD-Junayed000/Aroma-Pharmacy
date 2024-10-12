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
				Dashboard / View Slides
			</li>
		</div>
	</div>
</div><!--breadcrump End-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-fw fa-sliders-h"></i>
					View Slides
				</h3>
			</div>
			<div class="panel-bodybb">

               <?php
                  $get_slides="select * from slider";
                  $run_slides=mysqli_query($con,$get_slides);

                  while ($row_slides=mysqli_fetch_array($run_slides)) {
                    	$slide_id=$row_slides['Id'];
                    	$slide_name=$row_slides['slider_name'];                   	
                    	$slide_image=$row_slides['slider_image'];

                 ?>
                 
                 <div class="col-lg-3 col-md-3">
                 	<div class="panel panel-primary">
                 		<div class="panel-heading">
                 			<h3 class="panel-title" align="center">
                 				<?php echo $slide_name; ?>
                 			</h3>
                 			</div>
                 			<div class="panel-bodybb">
                 				<img src="slider_images/<?php echo $slide_image; ?>" class="img-responsive" width="230" height="130">
                 			</div>
                 			<div class="panel-footer">
                 				<center>
                 					<a href="index.php?delete_slide=<?php echo $slide_id; ?>" class="pull-left">
                 						<i class="fa fa-trash"> </i> Delete
                 					</a>
                 						<a href="index.php?edit_slide=<?php echo $slide_id; ?>" class="pull-right">
                 						<i class="fa fa-pen"> </i> Edit
                 					</a>
                 					<div class="clearfix">
                 					</div>
                 				</center>
                 			</div>
                 		</div>
                 	</div>
                 <?php } ?>
                 </div>
             </div>
         </div>
     </div>

<?php } ?>