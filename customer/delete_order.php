<?php
include("../includes/db.php");

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Delete the order from the database
    // Note: Removed the condition to check order status
    $delete_order = "DELETE FROM customer_order WHERE order_id='$order_id'";
    $run_delete = mysqli_query($con, $delete_order);

    if ($run_delete) {
        echo "<script>alert('Order has been removed');</script>";
        echo "<script>window.open('my_account.php?my_order','_self');</script>";
    } else {
        echo "<script>alert('Failed to remove order');</script>";
        echo "<script>window.open('my_account.php?my_order','_self');</script>";
    }
}
?>
