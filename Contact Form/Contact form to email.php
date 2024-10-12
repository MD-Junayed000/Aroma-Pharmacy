

<?php
session_start();
$con = mysqli_connect("localhost","root","","aroinsa");

if (!isset($_SESSION['customer_email'])) {
    echo "<script>window.open('../checkout.php','_self')</script>";
} else {
    $customer_email = $_SESSION['customer_email'];
    $get_customer = "SELECT * FROM customers WHERE customer_email='$customer_email'";
    $run_customer = mysqli_query($con, $get_customer);
    $row_customer = mysqli_fetch_array($run_customer);
    $customer_name = $row_customer['customer_name'];
    $customer_email = $row_customer['customer_email'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- scroll -->
      <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>AroInsa Medicine Solution</title>
    <!--link to the Css page-->
    <link rel="stylesheet" href="Contact form to email.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <!--font/text-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link   href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap"   rel="stylesheet"  />
    <!--Boxicon/sign-->
    <link   rel="stylesheet"  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"  rel="stylesheet" />
    
     <!--link of the icon on tab-->
    <link rel="icon" type="image/png" href="../image/icon.png" />
    <!--link of font awesome-->
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"   integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="  crossorigin="anonymous"   referrerpolicy="no-referrer"/>
 
    <!-- ===== Fontawesome CDN Link ===== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- ===== Link Swiper's CSS ===== -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />




  </head>
<body>


<h2 class="sent-notification">Send an Email!</h2>
    <div class="contact-container">
        
        <form id="myForm" enctype="multipart/form-data">
            <div class="contact-left-title">
                <h2>Get in touch</h2>
                <p>For any query, Contact the Doctor</p>
            </div>

            <label>Name:</label>
            <input id="name" type="text" value="<?php echo $customer_name; ?>" class="contact-inputs" disabled>
            <br><br>

            <label>Email:</label>
            <input id="email" type="email" value="<?php echo $customer_email; ?>" class="contact-inputs" disabled>
            <br><br>

            <label>Subject:</label>
            <input id="subject" type="text" placeholder="Enter Subject" class="contact-inputs" required>
            <br><br>

            <p>Message:</p>
            <textarea id="body" rows="5" placeholder="Type Message" class="contact-inputs" required></textarea>
            <br><br>

            <label>Attachment: </label>
            <input id="attachment" type="file">
            <br><br>

            <button type="button" onclick="sendEmail()" value="Send An Email" class="contact-inputs">Submit</button> 
        </form>

        <div class="contact-right">
            <img src="../image/creative-message.png" alt="Contact Image">
        </div>
    </div>

    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
        function sendEmail() {
            var formData = new FormData();
            formData.append("name", "<?php echo $customer_name; ?>");  // Name from session
            formData.append("email", "<?php echo $customer_email; ?>");  // Email from session
            formData.append("subject", $("#subject").val());
            formData.append("body", $("#body").val());

            var fileInput = $("#attachment")[0];
            if (fileInput.files.length > 0) {
                formData.append("attachment", fileInput.files[0]);
            }

            if (isNotEmpty($("#subject")) && isNotEmpty($("#body"))) {
                $.ajax({
                   url: 'sendEmail.php',
                   method: 'POST',
                   data: formData,
                   processData: false,
                   contentType: false,
                   dataType: 'json',
                   success: function (response) {
                        $('#myForm')[0].reset();
                        $('.sent-notification').text(response.response);
                        alert(response.response);
                   },
                   error: function (xhr, status, error) {
                        alert("An error occurred: " + error);
                   }
                });
            }
        }

        function isNotEmpty(caller) {
            if (caller.val() == "") {
                caller.css('border', '4px solid #f511bc');
                return false;
            } else {
                caller.css('border', '');
                return true;
            }
        }
    </script>

</body>
</html>






















