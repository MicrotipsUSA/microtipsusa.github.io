<?php
$name = $_REQUEST["fullName"];
$comp = $_REQUEST["companyName"];
$location = $_REQUEST["companyLocation"];
$email = $_REQUEST["contactEmail"];
$phonenum = $_REQUEST["contactPhoneNumber"];
$message = $_REQUEST["message"];

$formcontent = " From: $name \n $comp \n $location \n $email \n $phonenum \n $message \n";
$recipient = "jordanruhl@gmail.com"
$subject = "Modal contact test"
$mailheader = "From: $email \r\n"

if (mail($recipient, $subject, $formcontent, $mailheader)) {
	header("Location: http://www.macavionics.com/");
	exit();
} else {
	echo "NOT SENT";
	exit();
}
?>