<?php
require_once '../config.php';
require '../includes/header.php';
require_once '../includes/session_control.php';
requireLogin(); 


$messageSent = null;
if (isset($_POST['submit'])) {
    $to = 'your-email@example.com'; 
    $subject = 'Contact Us Form Submission';
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $headers = "From: $email\r\n" .
               "Reply-To: $email\r\n" .
               "X-Mailer: PHP/" . phpversion();

    $emailContent = "New message from the contact form:\n\n";
    $emailContent .= "Name: $name\n";
    $emailContent .= "Email: $email\n\n";
    $emailContent .= "Message:\n$message\n";

    // if (mail($to, $subject, $emailContent, $headers)) 
    // {
        $messageSent = 'success';
    // } else {
    //     $messageSent = 'error';
    // }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .contact-form {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            margin-top:70px; 
            max-width: 600px;
            animation: fadeIn 0.8s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h1 {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #555;
        }
        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 15px;
            transition: 0.3s;
        }
        input:focus, textarea:focus {
            border-color: #80bdff;
            outline: none;
        }
        button {
            background-color: #17a2b8;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition:  0.3s ease;
        }
        button:hover {
            background-color: #138496;
        }
        .call-now-btn {
            background-color: #ffc107;
            margin-top: 15px;
            transition:  0.5s ease;
        }
        .call-now-btn:hover {
            background-color: #e0a800;
        }
        .message {
            text-align: center;
            margin-top: 15px;
            font-weight: bold;
        }
        .success { color: #28a745; }
        .error { color: #dc3545; }
        @media (max-width:680px){
            h1{
                font-size: 19px;
            }
            .contact-form{
                width: 500px;
            }
        }
        @media (max-width:580px){
            h1{
                font-size: 18px;
            }
            .contact-form{
                width: 450px;
            }
        }
        @media (max-width:480px){
            h1{
                font-size: 17px;
            }
            .contact-form{
                width: 400px;
            }
        }
        @media (max-width:420px){
            h1{
                font-size: 16px;
            }
            .contact-form{
                width: 300px;
            }
        }
    </style>
</head>
<body>

<div class="contact-form">
    <h1>Contact Us</h1>
    <form action="contactus.php" method="POST">
        <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="message">Your Message</label>
            <textarea id="message" name="message" rows="6" required></textarea>
        </div>
        <button type="submit" name="submit">Send Message</button>
    </form>

    <a href="tel:+201234567890">
        <button class="call-now-btn">Call Now</button>
    </a>

    <?php if ($messageSent === 'success'): ?>
        <div class="message success">Your message has been sent successfully!</div>
    <?php elseif ($messageSent === 'error'): ?>
        <div class="message error">Sorry, something went wrong. Please try again.</div>
    <?php endif; ?>
</div>
<section style="text-align: center; padding: 40px; ">
  <h2 >
    <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" 
         alt="Map Icon" 
         style="width: 30px; height: 30px;">
    Where are we?
  </h2>

  <p style="margin: 15px;">You can find us on the map below:</p>

  <iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13822.215923542592!2d32.503326349999995!3d29.9922456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14562f1b65602eab%3A0x593edae01e57c240!2sSuez%20University!5e0!3m2!1sen!2seg!4v1747270661727!5m2!1sen!2seg" 
    width="300" 
    height="350" 
    style="border:0;" 
    allowfullscreen="" 
    loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade">
  </iframe>
</section>
<?php require '../includes/indexfooter.php'; ?>

</body>
</html>
