<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'jruhl@microtipsusa.com';                 // SMTP username
    $mail->Password = 'N@ught21';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('jruhl@microtipsusa.com', 'Microtips Technology USA');
    $mail->addAddress($_POST["email"]);     // Add a recipient
    $mail->addReplyTo('jruhl@microtipsusa.com', 'Jordan - Microtips Technology USA');
    $mail->addBCC('jruhl@microtipsusa.com');

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Thank you for subscribing to our newsletter!';
    $mail->Body    = '<b>Thank you</b> for subscribing to our newsletter<br><br>We like to send emails a few times per month highlighting our most exciting products!<br><br>If this subscription was not made by you or was made by mistake, please send an email to jruhl@microtipsusa.com.';
    $mail->AltBody = 'Thank you for subscribing to our newsletter! We like to send emails a few times per month highlighting our most exciting products! If this subscription was not made by you or was made by mistake, please send an email to jruhl@microtipsusa.com.';

    $mail->send();
    $output .= '<label class="text-success">Form Submitted</label>';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

    // $to1      = 'jruhl@microtipsusa.com';
    // $subject1 = $_POST["email"] . ' would like to be added to the email list';
    // $message1 = 'Please add ' . $_POST["email"] . " to the mailing list!";
    // $headers1 = 'From:' . $_POST["email"];

    // $to2      = $_POST["email"];
    // $subject2 = 'Thank you for subscribing to our newsletter!';
    // $message2 = 'Thank you for subscribing to our newsletter!';
    // $headers2 = 'From: Microtips Technology USA';

    // $message2 .= "\r\n" . "\r\n" . "\r\n" . "If this subscription was not made by you or was made by mistake, please send an email to jruhl@microtipsusa.com.";

    // if(mail($to2, $subject2, $message2, $headers2) && mail($to1, $subject1, $message1, $headers1))
    // {
    // 	$output .= '<label class="text-success">Form Submitted</label>';
    // }
    // else
    // {
    //     alert("NOT SENT");
    // }
    // echo $output;
?>