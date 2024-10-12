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
				Dashboard / View Products Categories
			</li>
		</div>
	</div>
</div><!--breadcrump End-->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-fw fa-store"></i>
					View Products Categories
				</h3>
			</div>
			<div class="panel-bodybb">
				<div class="table-responsive">	
					<div class="form-group">
						<table class="table table-bordered table-hover table-striped">
							<thead>
								<tr>
									<th>Product Category Id</th>
									<th>Product Category Title</th>
									<th>Product Category Description</th>
									<th>Delete Product Category</th>
									<th>Edit Product Category</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i=0;
								$get_p_cats="select * from product_category";
								$run_p_cats=mysqli_query($con,$get_p_cats);
								while ($row_p_cats=mysqli_fetch_array($run_p_cats)) {
									$p_cat_id=$row_p_cats['p_cat_id'];
									$p_cat_title=$row_p_cats['p_cat_title'];
									$p_cat_desc=$row_p_cats['p_cat_desc'];
									$i++;
								
								  ?>
                                <tr>
                                	<td><?php echo $i; ?></td>
                                	<td><?php echo $p_cat_title; ?></td>
                                	<td width="300"><?php echo $p_cat_desc; ?></td>
                                	<td>
                                		<a href="index.php?delete_p_cat=<?php echo $p_cat_id; ?>">
                                			<i class="fa fa-trash"></i> Delete
                                		</a>
                                	</td>
                                      <td>
                                      	<a href="index.php?edit_p_cat=<?php echo $p_cat_id; ?>">
                                      		<i class="fa fa-pen"></i> Edit
                                      	</a>
                                      </td>
                                </tr>
                                 <?php } ?>
							</tbody>
						</table>
						</div>
					</div>
				</div>
				</div>
				</div>	

<?php } ?>