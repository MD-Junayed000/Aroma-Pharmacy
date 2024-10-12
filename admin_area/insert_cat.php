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
				Dashboard / Insert Category
			</li>
		</ol>
	</div>	
</div>


<div class="row">
	<div class="col-lg-3">
		
	</div>
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading"><!--panel-heading start-->
			<h3 class="panel-title">
					<i class="fa fa-fw fa-th-list"></i>
					Insert Category
				</h3>
			</div><!--panel-heading End-->
			<div class="panel-body">
				<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-md-3 control-label">Category Title</label>
						<div class="col-md-6">                                                     
						<input type="text" name="cat_title" class="form-control" required="" >
					</div>
				</div>
				<div class="form-group">
    <label class="col-md-3 control-label">Category Icon</label>
    <div class="col-md-6">
        <input type="text" name="cat_icon" class="form-control" required="" placeholder="e.g., fas fa-tag">
    </div>
</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Category Description</label>
						<div class="col-md-6">
						<textarea type="text" name="cat_desc" class="form-controlabout2"></textarea>

                      </div>
					</div>
							
					
					<div class="form-group2">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
						<input type="submit" name="submit" value="Insert Category" class="btn btn-primary form-control">
					</div>
				</div>

				</form>
			</div>
		</div>
	</div>	
</div>

<?php
if (isset($_POST['submit'])) {
    $cat_title = $_POST['cat_title'];
    $cat_desc = $_POST['cat_desc'];
    $cat_icon = $_POST['cat_icon'];  // New field for icon

    $insert_cat = "INSERT INTO categories (cat_title, cat_desc, cat_icon) VALUES ('$cat_title', '$cat_desc', '$cat_icon')";
    
    $run_cat = mysqli_query($con, $insert_cat);
    
    if ($run_cat) {
        echo "<script>alert('New Category has been inserted successfully')</script>";
        echo "<script>window.open('index.php?view_categories', '_self')</script>";
    }
}



  ?>


<?php } ?>