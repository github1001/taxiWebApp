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
            <h3>Chat Box</h3>
          </div>
		  
		   <form action="" id="chatForm" method="post" enctype="multipart/form-data"> 
          		
		<div class="form-group col-md-3 setmyheight" id="driver">
              <label>Driver</label>
			  <select name="user_id" parsley-trigger="change"   placeholder="" class="form-control">
				<?php
				$db->getAllDrivers();
				
				?>
			  </select>
            </div>
			
			
            <div class="form-group col-md-3 setmyheight">
              <label>Message</label>
			  <textarea name="message" parsley-trigger="change"  placeholder="" class="form-control"></textarea>
            </div>
		
			
            
            <div class="clear"></div>
            
         
            <div class="form-group col-md-12 ">
            <input type="hidden" name="fromadmin" value="1">
	    <input type="hidden" name="datetime" id="datetime">
           <button class="btn btn-default" type="submit" name="send">Send</button>
              </div>
            </form>
			
          <div class="content">
          <div class="form-group col-md-12 ">
            <?php if (isset($_POST['send'])){
			$db->addMessage($_POST['user_id'],$_POST['fromadmin'],$_POST['message'],$_POST['datetime']);  
			}
			?>
			
			
			<div class="content">
                        
							<div class="table-responsive">
                            
								<table class="table table-bordered" id="datatable" >
									<thead>
										<tr>
											<th>From</th>
											<th>To</th>
											<th>Message</th>
											<th>Date</th>
											
										</tr>
									</thead>
									<tbody id="chat-table-body">
                                    
										<?php
							$db->getAllMessages();
							?>
									</tbody>
								</table>							
							</div>
						</div>
						
       

          </div>
        </div>				
      </div>
      
      
  </div>
    
    	</div>
	
	</div> 
	
</div>
<script type="text/javascript">
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    var hour = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    if (dd<10) {dd='0' + dd} 
    if (mm<10) {mm='0' + mm}
    if (hour<10) {hour='0' + hour}
    if (min<10) {min='0' + min}
    if (sec<10) {sec='0' + sec}

    //today = dd+"-"+mm+"-"+yyyy+" "+hour+":"+min+":"+sec;
    today = yyyy+"-"+mm+"-"+dd+" "+hour+":"+min+":"+sec;

  document.getElementById('datetime').value = today;
</script>


<!-- Right Chat-->
<script src="js/jquery.js"></script>
	<script src="js/jquery.cookie/jquery.cookie.js"></script>
  <script src="js/jquery.pushmenu/js/jPushMenu.js"></script>
	<script type="text/javascript" src="js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
	<script type="text/javascript" src="js/jquery.sparkline/jquery.sparkline.min.js"></script>
  <script type="text/javascript" src="js/jquery.ui/jquery-ui.js" ></script>
	<script type="text/javascript" src="js/jquery.gritter/js/jquery.gritter.js"></script>
	<script type="text/javascript" src="js/behaviour/core.js"></script>

	 	<script type="text/javascript">
			$(document).ready(function(){
				function addMessageInTable(user_name,fromadmin,message,datetime){
					var output="";
					if (fromadmin == 1)
						return output='<tr><td>Admin</td><td>'+username+'</td><td>'+message+'</td><td>'+datetime+'</td></tr>';
					else
						return output='<tr><td>'+username+'</td><td>Admin</td><td>'+message+'</td><td>'+datetime+'</td></tr>';
				}
	
				function refreshMessages() {
					$.ajax({
						type:"get",
						url: 'get_messages.php',
						success: function(responseData,textStatus,jqXHR) {
							var chatListJson=JSON.parse(responseData);	
							var chatArray=chatListJson.chat;
	
							$("#chat-table-body").html("");
							var output="";

							for (i = 0; i < chatArray.length; i++) {
							    output+=addMessageInTable(chatArray[i]["user_name"],chatArray[i]["fromadmin"],chatArray[i]["message"],chatArray[i]["datetime"]);
							}
							$("#chat-table-body").html(output);

							var objDiv = document.getElementById("datatable");
							objDiv.scrollTop = objDiv.scrollHeight;
	
							setTimeout(refreshMessages, 5000); //execute every 5 seconds
						}
					});
				}
	
				setTimeout(refreshMessages, 100); //execute immediately
		</script>

    
    <style type="text/css">
    #color-switcher{
      position:fixed;
      background:#272930;
      padding:10px;
      top:50%;
      right:0;
      margin-right:-109px;
    }
    
    #color-switcher .toggle{
      cursor:pointer;
      font-size:15px;
      color: #FFF;
      display:block;
      position:absolute;
      padding:4px 10px;
      background:#272930;
      width:25px;
      height:30px;
      left:-24px;
      top:22px;
    }
    
    #color-switcher p{color: rgba(255, 255, 255, 0.6);font-size:12px;margin-bottom:3px;}
    #color-switcher .palette{padding:1px;}
    #color-switcher .color{width:15px;height:15px;display:inline-block;cursor:pointer;}
    #color-switcher .color.purple{background:#7761A7;}
    #color-switcher .color.green{background:#19B698;}
    #color-switcher .color.red{background:#EA6153;}
    #color-switcher .color.blue{background:#54ADE9;}
    #color-switcher .color.orange{background:#FB7849;}
    #color-switcher .color.prusia{background:#476077;}
    #color-switcher .color.yellow{background:#fec35d;}
    #color-switcher .color.pink{background:#ea6c9c;}
    #color-switcher .color.brown{background:#9d6835;}
    #color-switcher .color.gray{background:#afb5b8;}
 </style>
  

  <script type="text/javascript">
    var link = $('link[href="css/style.css"]');
    
    if($.cookie("css")) {
      link.attr("href",'css/skin-' + $.cookie("css") + '.css');
    }
    
    $(function(){
      $("#color-switcher .toggle").click(function(){
        var s = $(this).parent();
        if(s.hasClass("open")){
          s.animate({'margin-right':'-109px'},400).toggleClass("open");
        }else{
          s.animate({'margin-right':'0'},400).toggleClass("open");
        }
      });
      
      $("#color-switcher .color").click(function(){
        var color = $(this).data("color");
        $("body").fadeOut(function(){
          //link.attr('href','css/skin-' + color + '.css');
          $.cookie("css", color, {expires: 365, path: '/'});
          window.location.href = "";
          $(this).fadeIn("slow");
        });
      });
    });
	
	
      $("input[name='status']").on("click", function() {
          
			if($(this).val() == 'yes'){
				  $("#driver").show();
			}else{
				  $("#driver").hide();
			}
			
        });
		
	
	
  </script> <script src="js/jquery.parsley/parsley.js" type="text/javascript"></script>
  
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
