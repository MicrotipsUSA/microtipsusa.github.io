<?php
    $to1      = 'jruhl@microtipsusa.com';
    $subject1 = $_POST["email"] . ' would like to be added to the email list';
    $message1 = 'Please add ' . $_POST["email"] . " to the mailing list!";
    $headers1 = 'From:' . $_POST["email"];

    $to2      = $_POST["email"];
    $subject2 = 'Thank you for subscribing to our newsletter!';
    $message2 = 'Thank you for subscribing to our newsletter!';
    $headers2 = 'From: Microtips Technology USA';

    $message2 .= "\r\n" . "\r\n" . "\r\n" . "If this subscription was not made by you or was made by mistake, please send an email to jruhl@microtipsusa.com.";

    if(mail($to2, $subject2, $message2, $headers2) && mail($to1, $subject1, $message1, $headers1))
    {
    	$output .= '<label class="text-success">Form Submitted</label>';
    }
    else
    {
        alert("NOT SENT");
    }
    echo $output;
?>