<?php 
require_once ('../includes/config.php');
require_once ('../includes/database.class.php');
$db = new database($pdo);

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
				<h3 class="text-center">Taxi Management</h3>
			</div>
			<div>
				<form style="margin-bottom: 0px !important;" class="form-horizontal" action="#" method="post">
					<div class="content">
					<!--	<h4 class="title">Login Access</h4>-->
							<div class="form-group">
								
									
										<!--<span class="input-group-addon"><i class="fa fa-user"></i></span>-->
										<input type="text" name="username" placeholder="username" class="form-control" required="required">
									    
								
							</div>
							<div class="form-group">
								
									
										<!--<span class="input-group-addon"><i class="fa fa-lock"></i></span>-->
										<input type="password" placeholder="password" name="password" class="form-control" required="required">
									
							
							</div>
							
					</div>
					<div class="foot">
<!--						<button class="btn btn-default" data-dismiss="modal" type="button">Register</button>-->
						<center><button class="btn btn-primary" data-dismiss="modal" type="submit">Enter</button></center>
                         
					</div>
                    <?php 
				if(isset($_POST['username']))
				{
					$db->adminLogin();
				}
				?>
				</form>
<br>
<!--<a href="frogotpassword.php">Forgot Password?</a>-->
               
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
