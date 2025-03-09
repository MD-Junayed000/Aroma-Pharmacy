<?php
include("includes/db.php");
include("functions/functions.php");
session_start();
// Check if user is not logged in
if (!isset($_SESSION['customer_email'])) {
    // Redirect to login page
    header("Location: checkout.php");
    exit(); // Ensure script stops execution after redirection
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="robots" content="noindex, nofollow">
<title>Aroma Pharmacy</title>
    <link rel="stylesheet" href="whatsapp.css">
    <link rel="icon" type="image/png" href="./image/icon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container">
    <h1>Contact Us</h1>
    <p>Leave your message and we will get back to you shortly</p>
    <form id="contactForm">
        <div class="form-group">
            <span>
                <label for="name">Name</label><br/>
                <input id="name" type="text" placeholder="Full Name" required>
            </span>
            <span>
                <label for="email">Email</label><br/>
                <input id="email" type="email" placeholder="Email" required>
            </span>
        </div>
        <label for="message">Your Message</label><br/>
        <textarea id="message" rows="10" placeholder="Your Message" required></textarea>
        <button type="submit">Submit</button>
    </form>
</div>


    <script>
    document.getElementById('contactForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        sendToWhatsapp();
    });

    function sendToWhatsapp() {
        let number = "8801776316056"; // Correct format for the phone number

        let name = document.getElementById("name").value;
        let email = document.getElementById("email").value;
        let message = document.getElementById("message").value;

        let text = `Name: ${name}\nEmail: ${email}\nMessage: ${message}`;
        let encodedText = encodeURIComponent(text);

        let url = `https://wa.me/${number}?text=${encodedText}`;

        // Open the WhatsApp URL in new windows sequentially
        for (let i = 0; i < 3; i++) {
            setTimeout(() => {
                window.open(url, "_blank").focus();
            }, i * 2000); // Delay each open by 2 seconds to avoid browser blocking
        }
    }
    </script>
</body>
</html>
