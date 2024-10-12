<?php
$con=mysqli_connect("localhost","root","","aroinsa");
session_start();

if (!isset($_SESSION['customer_email'])) {
    header("Location: checkout.php");
    exit();
}

date_default_timezone_set('Asia/Dhaka');
include('database.inc.php');

$customer_email = $_SESSION['customer_email'];
$customer_query = "SELECT customer_id FROM customers WHERE customer_email='$customer_email'";
$customer_result = mysqli_query($con, $customer_query);
$customer_row = mysqli_fetch_assoc($customer_result);
$customer_id = $customer_row['customer_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <title>AroInsa Medicine Solution</title>
    <link rel="icon" type="image/png" href="./image/icon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="chat.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<body>
    

    <div class="container">
        <div class="row justify-content-md-center mb-4">
            <div class="col-md-6">
                <div class="titlet">Ask<img src="./image/Medical Care23.png" title="" /></div>
                <div class="card">
                    <div class="card-body messages-box">
                        <ul class="list-unstyled messages-list">
                            <?php
                            $res = mysqli_query($con, "SELECT * FROM user_chats WHERE user_id='$customer_id'");
                            if (mysqli_num_rows($res) > 0) {
                                $html = '';
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $message = $row['message'];
                                    $created_at = $row['created_at'];
                                    $strtotime = strtotime($created_at);
                                    $time = date('h:i A', $strtotime);
                                    $type = $row['message_type'];
                                    if ($type == 'user') {
                                        $class = "messages-me";
                                        $imgAvatar = "user.png";
                                        $name = "Me";
                                    } else {
                                        $class = "messages-you";
                                        $imgAvatar = "bot.png";
                                        $name = "Arobot";
                                    }
                                    $html .= '<li class="' . $class . ' clearfix"><span class="message-img"><img src="image/' . $imgAvatar . '" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">' . $name . '</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' . $time . '</span></small> </div><p class="messages-p">' . $message . '</p></div></li>';
                                }
                                echo $html;
                            } else {
                                ?>
                                <li class="messages-me clearfix start_chat">
                                <img src="image/bot.png" class="avatar-sm rounded-circle"></i>Hello there, how can I help you?
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="card-header">
                        <div class="input-group">
                            <input id="input-me" type="text" name="messages" class="form-control input-sm" placeholder="Type your message here..." required />
                            <span class="input-group-append">
                            <input type="button" class="btn btn-primary" value="Send" onclick="send_msg()">
                            </span>
                        </div> 
                    </div>
                </div>
                <button id="new-chat" class="btn btn-secondary mt-3">+ New Chat</button>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function getCurrentTime(){
            var now = new Date();
            var hh = now.getHours();
            var min = now.getMinutes();
            var ampm = (hh>=12)?'PM':'AM';
            hh = hh%12;
            hh = hh?hh:12;
            hh = hh<10?'0'+hh:hh;
            min = min<10?'0'+min:min;
            var time = hh+":"+min+" "+ampm;
            return time;
        }

        function send_msg(){
            var txt=jQuery('#input-me').val().trim();
            if (txt === '') {
                alert('Please enter a message.');
                return;
            }
            jQuery('.start_chat').hide();
            var html='<li class="messages-me clearfix"><span class="message-img"><img src="image/user.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Me</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">'+getCurrentTime()+'</span></small> </div><p class="messages-p">'+txt+'</p></div></li>';
            jQuery('.messages-list').append(html);
            jQuery('#input-me').val('');
            if(txt){
                jQuery.ajax({
                    url:'get_bot_message.php',
                    type:'post',
                    data:{txt: txt, user_id: <?php echo $customer_id; ?>},
                    success:function(result){
                        var html='<li class="messages-you clearfix"><span class="message-img"><img src="./image/bot.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Arobot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">'+getCurrentTime()+'</span></small> </div><p class="messages-p">'+result+'</p></div></li>';
                        jQuery('.messages-list').append(html);
                        jQuery('.messages-box').scrollTop(jQuery('.messages-box')[0].scrollHeight);
                    }
                });
            }
        }

        jQuery(document).ready(function(){
            jQuery('#input-me').keypress(function(event){
                if(event.which === 13){
                    event.preventDefault();
                    send_msg();
                }
            });

            jQuery('#new-chat').click(function() {
                $.post("clear_chat.php", { user_id: <?php echo $customer_id; ?> }, function(data) {
                    sessionStorage.clear();
                    location.reload();
                });
            });

            if (performance.navigation.type === performance.navigation.TYPE_RELOAD) {
                return;
            }
        });
    </script>
</body>
</html>
