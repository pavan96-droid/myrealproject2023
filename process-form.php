<?php
  $email = $_POST['email'];
  $message = $_POST['message'];
  $captcha = $_POST['g-recaptcha-response'];

  if(!$captcha){
    echo 'Please check the reCAPTCHA box.';
    exit;
  }

  $secretKey = "6Lexv3ElAAAAABTbeyc5TeUlc4h7ToZtO2XffR4G";
  $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$captcha;
  $response = file_get_contents($url);
  $responseKeys = json_decode($response, true);

  if($responseKeys["success"]) {
    // Send the email
    $to = "rajasekharbagathi0587@gmail.com"; // Replace with your own email address
    $subject = "New contact form submission";
    $body = "Email: $email\nMessage: $message";
    $headers = "From: $email\n";

    if (mail($to, $subject, $body, $headers)) {
      echo 'Thank you for your message.';
    } else {
      echo 'There was a problem sending your message. Please try again later.';
    }
  } else {
    echo 'There was an error validating the reCAPTCHA. Please try again.';
  }
?>
