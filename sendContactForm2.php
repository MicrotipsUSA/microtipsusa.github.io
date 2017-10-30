<?php

if(!empty($_POST))
{
	$output = '';
	$name = $_POST["fullName"];
	$comp = $_POST["companyName"];
	$location = $_POST["companyLocation"];
	$email = $_POST["contactEmail"];
	$phonenum = $_POST["contactPhoneNumber"];
	$msg = $_POST["msg"];

	$recipient = "j.ruhl@rocketmail.com";
	$from = $email;
	$subject = "Please reply to $name";
	$headers = "From: $from";

	$message = 'Name: '.$name. "\r\n" . ' Company: '.$comp. "\r\n" . ' Location: '.$location. "\r\n" . ' Email: '.$email. "\r\n" . ' Phone Number: '.$phonenum. "\r\n" . ' Message: '.$msg;

	if(mail($recipient, $subject, $message, $headers))
	{
		$output .= '<label class="text-success">Form Submitted</label>';
	}
	else
	{
		alert("NOT SENT");
	}
	echo $output;
}

?>