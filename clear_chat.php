<?php
include('database.inc.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id = (int) $_POST['user_id'];
    $sql_clear_messages = "DELETE FROM user_chats WHERE user_id='$user_id'";
    if (mysqli_query($con, $sql_clear_messages)) {
        echo "Chat messages cleared.";
    } else {
        echo "Error clearing chat messages: " . mysqli_error($con);
    }
}
?>
