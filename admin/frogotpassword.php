/*<?php 
require_once ('../includes/config.php');
require_once ('../includes/database.class.php');
$db = new database($pdo);

?>*/
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

if(isset($_POST["submit"])){

$email=$_POST["username"];


$query="SELECT * FROM users where user_name = '$email'";

$p=mysqli_query($conn, $query);

if (mysqli_num_rows($p) ==1) {
$pass  =  rand(1000000,9999999);//FETCHING PASS
       $rows = mysqli_fetch_assoc($p);

$query1="UPDATE users SET password='$pass' where user_name = '$email'";
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

/*if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
    header(location)
}*/
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

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.html">

	<title>Admin-Login</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>

	<!-- Bootstrap core CSS -->
	<link href="js/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

	<link rel="stylesheet" href="fonts/font-awesome-4/css/font-awesome.min.css">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="assets/js/html5shiv.js"></script>
	  <script src="assets/js/respond.min.js"></script>
	<![endif]-->

	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet" />	

</head>

<body class="texture">

<div id="cl-wrapper" class="login-container">

	<div class="middle-login">
		<div class="block-flat">
			<div class="header">							
				<h3 class="text-center">Cyclone</h3>
			</div>
			<div>
				<form style="margin-bottom: 0px !important;" class="form-horizontal" action="" method="post">
					<div class="content">
					<!--	<h4 class="title">Login Access</h4>-->
							<div class="form-group">
								
									
										<!--<span class="input-group-addon"><i class="fa fa-user"></i></span>-->
										<input type="text" name="username" id="username" placeholder="username" class="form-control" required="required">
									
								<h4>Please enter your username</h4>
							</div>
					</div>
					<div class="foot">
<!--						<button class="btn btn-default" data-dismiss="modal" type="button">Register</button>-->
						<center><button class="btn btn-primary" data-dismiss="modal" name="submit" id="submit" type="submit">Enter</button></center>
                         
					</div>
                   
				</form>
               
			</div>
		</div>
		<div class="text-center out-links"><a href="#">&copy; Cyclone Pty Ltd</a></div>
	</div> 
	
</div>

<script src="js/jquery.js"></script>
	<script type="text/javascript">
    $(function(){
      $("#cl-wrapper").css({opacity:1,'margin-left':0});
    });
  </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <script src="js/behaviour/voice-commands.js"></script>
  <script src="js/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.flot/jquery.flot.js"></script>
<script type="text/javascript" src="js/jquery.flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="js/jquery.flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="js/jquery.flot/jquery.flot.labels.js"></script>
</body>
</html>
