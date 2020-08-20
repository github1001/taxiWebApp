<?php
require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = "srv76.hosting24.com"; 
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'something@workrack.com.au';                 // SMTP username
$mail->Password = 'hello123';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('something@workrack.com.au','Cyclone');
$mail->addAddress('cyclonemail1@gmail.com','Cyclone');     // Add a recipient
/*$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('info@example.com', 'Information');
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');*/

//$mail->addAttachment('C:/Users/reuben_v/Desktop/ticket_final.pdf');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Forgot password request';
$mail->Body    = 'Dear,<br>Please use  as your new password';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

/*if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
    header(location)
}*/

if(!$mail->send()) { 
	echo 'Mailer Error: '.$mail->ErrorInfo;
    
}

else {
 echo 'sent';
   
}

?>
