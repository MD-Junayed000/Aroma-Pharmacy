<?php
date_default_timezone_set('Asia/Dhaka');
include('database.inc.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['txt']) && isset($_POST['user_id'])) {
        $txt = mysqli_real_escape_string($con, $_POST['txt']);
        $user_id = (int) $_POST['user_id'];

        $sql = "SELECT reply FROM chatbot_hints WHERE question LIKE '%$txt%'";
        $res = mysqli_query($con, $sql);

        if ($res) {
            if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
                $html = $row['reply'];
            } else {
                $html = "Sorry, I was not able to understand you";
            }

            $created_at = date('Y-m-d H:i:s');
            mysqli_query($con, "INSERT INTO user_chats(user_id, message, message_type, created_at) VALUES('$user_id', '$txt', 'user', '$created_at')");
            mysqli_query($con, "INSERT INTO user_chats(user_id, message, message_type, created_at) VALUES('$user_id', '$html', 'bot', '$created_at')");
        } else {
            $html = "Error executing query: " . mysqli_error($con);
        }

        echo $html;
    }
}
?>
