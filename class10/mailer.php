<?php
	
	$from = 'sudantuladhar@yahoo.com';
	$to = 'sudantuladhar@gmail.com';

	$subject = 'Testing the mail';
	$body = 'Hello how are you?';

	$headers = 'From: ' . $from;
	/*
	$res = mail( $to, $subject, $body, $headers );

	var_dump( $res );

	phpinfo();
	*/
	//https://support.google.com/mail/troubleshooter/1668960?hl=en&rd=1
	//https://github.com/PHPMailer/PHPMailer/blob/master/examples/gmail.phps
	//https://github.com/PHPMailer/PHPMailer
	//sudan.apex.college SUDAN@2016

	require_once('res/lib/phpmailer/class.smtp.php');
	require_once('res/lib/phpmailer/class.phpmailer.php');
	
	//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

	$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

	$mail->IsSMTP(); // telling the class to use SMTP

	
		$mail->Host       = "smtp.gmail.com"; // SMTP server
		$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "";  // GMAIL username
		$mail->Password   = "";            // GMAIL password
	  

	  	//Set who the message is to be sent from
		$mail->setFrom($from, 'First Last');
		//Set who the message is to be sent to
		$mail->addAddress($to, 'John Doe');

		$mail->addReplyTo('info@sudantuladhar.com.np', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Set the subject line
		$mail->Subject = 'PHPMailer GMail SMTP test';
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
		//Replace the plain text body with one created manually
		$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
		$mail->AltBody = 'This is a plain-text message body';
		//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');
		//send the message, check for errors
		
		$mail->isHTML(false); 	// Set email format to HTML

		if (!$mail->send()) {
		    echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		    echo "Message sent!";
		}

    
?>