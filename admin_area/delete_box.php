<?php  
if (!isset($_SESSION['admin_email'])){

  echo "<script>window.open('login.php','_self')</script>";
  }else{

?>

<?php
if (isset($_GET['delete_box'])) {
	$delete_box=$_GET['delete_box'];
	$delete_box="delete from boxes_section where box_id='$delete_box'";

	$run_query=mysqli_query($con,$delete_box);

	if ($run_query) {
		echo "<script>alert('Data Deleted')</script>";
		echo "<script>window.open('index.php?view_box','_self')</script>";
	}
}


  ?>


<?php } ?>