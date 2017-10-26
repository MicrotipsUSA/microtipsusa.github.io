<?php
$name = strip_tags($_POST['fullName']);
$comp = strip_tags($_POST['companyName']);
$location = strip_tags($_POST['companyLocation']);
$email = strip_tags($_POST['contactEmail']);
$phonenum = strip_tags($_POST['contactPhoneNumber']);
$message = strip_tags($_POST['message']);

$formcontent = " From: $name \n $comp \n $location \n $email \n $phonenum \n $message \n";
$recipient = "jordanruhl@gmail.com"
$subject = "Modal contact test"
$mailheader = "From: $email \r\n"
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
echo "Thank you!" . " - " . "<a href='http://www.facebook.com'>go to facebook</a>"
?>