<?php
$host= "localhost";
$db_name="workrack_test2";
$db_username="workrack";
$db_password="a1b2c3d4";

require 'phpmailer/PHPMailerAutoload.php';

// Create connection
$conn = mysqli_connect($host, $db_username, $db_password, $db_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST["email"])){

$email=$_POST["email"];


$query="SELECT * FROM users where user_email = '$email'";

$p=mysqli_query($conn, $query);

if (mysqli_num_rows($p) ==1) {
$pass  =  rand(1000000,9999999);//FETCHING PASS
       $rows = mysqli_fetch_assoc($p);

$query1="UPDATE users SET password='$pass' where user_email = '$email'";
         mysqli_query($conn, $query1);

$emaili=$rows['user_email'];
  $username=$rows['user_name'];




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
$mail->addAddress($emaili,$username);     // Add a recipient
/*$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('info@example.com', 'Information');
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');*/

//$mail->addAttachment('C:/Users/reuben_v/Desktop/ticket_final.pdf');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Forgot password request';
$mail->Body    = 'Dear '. $username.',<br>Please use  '.$pass.' as your new password';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


if(!$mail->send()) { 
	echo "An error occured while sending the mail.";
    
}
			 else {
   
   echo "An email has been sent to your email address.Please use the new password provided there.";
}
}
else{
  echo "Please enter correct email";
}
}


?>