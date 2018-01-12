<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

function post_captcha($user_response) {
    $fields_string = '';
    $fields = array(
        'secret' => '6LdBfDYUAAAAAFSueKx-P3sO10SK8wuv2votE_t_',
        'response' => $user_response
    );
    foreach($fields as $key=>$value)
    $fields_string .= $key . '=' . $value . '&';
    $fields_string = rtrim($fields_string, '&');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode($result, true);
}

// Call the function post_captcha
$res = post_captcha($_POST['g-recaptcha-response']);

if (!$res['success']) {
    // What happens when the CAPTCHA wasn't checked
    echo 'CAPTCHA';
} else {
    // If CAPTCHA is successfully completed...

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'jruhl@microtipsusa.com';                 // SMTP username
        $mail->Password = 'N@ught21';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('jruhl@microtipsusa.com',$_POST["fullName"]);
        $mail->addAddress('mtusainfo@microtipsusa.com');     // Add a recipient
        $mail->addReplyTo($_POST["contactEmail"]);

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Please reply to '.$_POST["fullName"];
        $mail->Body    = 'Name: '.$_POST["fullName"]. '<br>' . 'Company: '.$_POST["companyName"]. '<br>' . 'Location: '.$_POST["companyLocation"]. '<br>' . 'Email: '.$_POST["contactEmail"]. '<br>' . 'Phone Number: '.$_POST["contactPhoneNumber"]. '<br>' . 'Message: '.$_POST["msg"];
        $mail->AltBody = 'Name: '.$_POST["fullName"]. ' | ' . 'Company: '.$_POST["companyName"]. ' | ' . 'Location: '.$_POST["companyLocation"]. ' | ' . 'Email: '.$_POST["contactEmail"]. ' | ' . 'Phone Number: '.$_POST["contactPhoneNumber"]. ' | ' . 'Message: '.$_POST["msg"];

        $mail->send();
        $output .= '<label class="text-success">Form Submitted</label>';
    } catch (Exception $e) {
        echo 'error';
    }

	// $output = '';
	// $name = $_POST["fullName"];
	// $comp = $_POST["companyName"];
	// $location = $_POST["companyLocation"];
	// $email = $_POST["contactEmail"];
	// $phonenum = $_POST["contactPhoneNumber"];
	// $msg = $_POST["msg"];

	// $recipient = "jordanruhl@gmail.com";
	// $from = $email;
	// $subject = "THIS IS A TEST! Please reply to $name";
	// $headers = "From: $from";

	// $message = 'Name: '.$name. "\r\n" . 'Company: '.$comp. "\r\n" . 'Location: '.$location. "\r\n" . 'Email: '.$email. "\r\n" . 'Phone Number: '.$phonenum. "\r\n" . 'Message: '.$msg;

	// if(mail($recipient, $subject, $message, $headers))
	// {
	// 	$output .= '<label class="text-success">Form Submitted</label>';
	// }
	// else
	// {
	// 	alert("NOT SENT");
	// }
}
?>