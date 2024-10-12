
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['name']) && isset($_POST['email'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer();

    try {
        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "aroinsamedicinesolution@gmail.com"; // your email address
        $mail->Password = 'exec vnii foid iizq'; // your app password
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email, $name);
        $mail->addAddress("aroinsamedicinesolution@gmail.com"); // your email address
        $mail->Subject = ("$email ($subject)");
        $mail->Body = $body;

        // Handle optional file upload
        if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
            $mail->addAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
        }

        if ($mail->send()) {
            $status = "success";
            $response = "Message has been sent successfully!";
        } else {
            $status = "failed";
            $response = "Something is wrong" . $mail->ErrorInfo;
        }

        // Send confirmation email to the user
        $confirmationMail = new PHPMailer();
        $confirmationMail->isSMTP();
        $confirmationMail->Host = "smtp.gmail.com";
        $confirmationMail->SMTPAuth = true;
        $confirmationMail->Username = "aroinsamedicinesolution@gmail.com"; // your email address
        $confirmationMail->Password = 'exec vnii foid iizq'; // your app password
        $confirmationMail->Port = 465;
        $confirmationMail->SMTPSecure = "ssl";
        $confirmationMail->isHTML(true);
        $confirmationMail->setFrom("aroinsamedicinesolution@gmail.com", "ArIonsa Medicine Solution");
        $confirmationMail->addAddress($email);
        $confirmationMail->Subject = "Confirmation: We Have Received Your Message";
        $confirmationMail->Body = "
            <h3>Dear $name,</h3>
            <p>Thank you for contacting us. We have received your message and will reply shortly.</p>
            <p>Best regards,<br>ArIonsa Medicine Solution</p>
        ";
        $confirmationMail->send();

    } catch (Exception $e) {
        $status = "failed";
        $response = "Mailer Error: " . $mail->ErrorInfo;
    }

    exit(json_encode(array("status" => $status, "response" => $response)));
}
?>
