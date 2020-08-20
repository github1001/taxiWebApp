<?php
require_once('../includes/config.php');
require_once('../includes/database.class.php');

$db= new database($pdo);


require('session.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/icon.png">

	<title>TAXI CENTRAL</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>

	<!-- Bootstrap core CSS -->
	<link href="js/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="js/jquery.gritter/css/jquery.gritter.css" />
	<link rel="stylesheet" href="fonts/font-awesome-4/css/font-awesome.min.css">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="../../assets/js/html5shiv.js"></script>
	  <script src="../../assets/js/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="js/jquery.nanoscroller/nanoscroller.css" />

    
	<link href="css/style.css" rel="stylesheet" />	
    <script type="text/jscript">
	function check() {
    if(document.getElementById('full_pay').value == "No") {
        document.getElementById('min_pay').style.display = 'none';
		document.getElementById('min_pay').value="";
    } else {
        document.getElementById('min_pay').style.display = 'block';
    }
	}
	function check_cancel() {
	if(document.getElementById('cancel_book').value == "No") {
        document.getElementById('cancel_fee').style.display = 'none';
    } else {
        document.getElementById('cancel_fee').style.display = 'block';
		document.getElementById('cancel_fee').value="";
    }
	}
	function check_adv_prch() {
	if(document.getElementById('adv_prch').value == "No") {
        document.getElementById('adv_pay_day').style.display = 'none';
    } else {
        document.getElementById('adv_pay_day').style.display = 'block';
		document.getElementById('adv_pay_day').value="";
    }
	}
	function check_book() {
	if(document.getElementById('book_by').value == "0") {
        document.getElementById('book_bfr').style.display = 'none';
    } else {
        document.getElementById('book_bfr').style.display = 'block';
		document.getElementById('book_bfr').value="";
    }
	}
	function slider(chk) {
      document.getElementById("div1").style.display = chk.checked ? "block" : "none";
 	}
</script>
<style type="text/css">
.setmyheight
  {
	  height:70px;

  }
</style>    
</head>
<body>

<div id="cl-wrapper">
  <div class="container-fluid" id="pcont">
    <!-- TOP NAVBAR -->

    <div class="cl-mcont">
	  <div class="row">
	    <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">							
            <h3>Create Group for Driver </h3>
          </div>
          <div class="content">
          <div class="form-group col-md-12 ">
            <?php if (isset($_POST['email'])){
			$db->addGroup();  
			}
			?>
			
        <form action="" id="myform" method="post" enctype="multipart/form-data"> 
        
			<div class="form-group col-md-3 setmyheight">
			   <button class="btn btn-default" name="add" id="add">+ | New Group</button>
            </div>

			<div class="form-group col-md-3 setmyheight">
              <label>Existing Groups</label>
			  <select class="form-control" name="group">
			  <?php 
			  $db->getAllGroups();
			  
			  ?>
			  </select>
			 </div>		

            <div class="clear"></div>
            
            </form>

          </div>
        </div>				
      </div>
      
      
  </div>
    
    	</div>
	
	</div> 
	
</div>
<!-- Right Chat--><script src="js/jquery.js"></script>
	<script src="js/jquery.cookie/jquery.cookie.js"></script>
  <script src="js/jquery.pushmenu/js/jPushMenu.js"></script>
	<script type="text/javascript" src="js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
	<script type="text/javascript" src="js/jquery.sparkline/jquery.sparkline.min.js"></script>
  <script type="text/javascript" src="js/jquery.ui/jquery-ui.js" ></script>
	<script type="text/javascript" src="js/jquery.gritter/js/jquery.gritter.js"></script>
	<script type="text/javascript" src="js/behaviour/core.js"></script>
    
<script src="js/jquery.parsley/parsley.js" type="text/javascript"></script>
<script>
$('#add').click(function(){
	
	var group_name = prompt("Group Name: ", "");
//    alert(group_name.length);
    if (group_name.length != 0) {
        $.ajax({
                        type: "POST",
                        async: false,
                        url: "ajax_group.php",
                        data: {"group_name": group_name}
						
                }); 
    }
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
