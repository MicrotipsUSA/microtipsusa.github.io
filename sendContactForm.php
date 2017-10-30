<?php
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
        echo '<p>Please go back and make sure you check the security CAPTCHA box.</p><br>';
    } else {
        // If CAPTCHA is successfully completed...

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
    }
?>