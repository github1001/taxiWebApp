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

	<title>Flat Dream</title>
      <link rel="stylesheet" type="text/css" href="js/jquery.niftymodals/css/component.css" />

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

  	<link rel="stylesheet" type="text/css" href="js/jquery.datatables/bootstrap-adapter/css/datatables.css" />
  <link href="js/jquery.icheck/skins/flat/green.css" rel="stylesheet">  
	<link href="css/style.css" rel="stylesheet" />	
    
</head>
<body>

<div id="cl-wrapper">
  <div class="container-fluid" id="pcont">
    <!-- TOP NAVBAR -->
    
  
    
	<div class="cl-mcont">
	  <div class="row">
      
		  <div class="col-md-12">
          
					<div class="block-flat">
                
						<div class="header">							
							<h3>Displaying All Taxi Requests <!--<button data-toggle="modal" data-target="#md-default" type="button" class="btn btn-primary btn-flat"> Default</button>-->
                         </h3>
                          
						</div>
						<div class="content">
                        
							<div class="table-responsive">
                            
								<table class="table table-bordered" id="datatable" >
									<thead>
										<tr>
											<th>No.</th>
											<th>Customer Name</th>
											<th>Location</th>
											<th>Destination</th>
											<th>Phone </th>
											<th>Booking Time </th>
											<th>Type </th>
											<th>Passe<br>ngers </th>
											<th>Driver </th>
											<th>Group </th>
											<th>Status</th>
											<th>&nbsp;</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
                                    
										<?php
							$db->approveRequests();
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

  <script type="text/javascript">
    function edit_row_name(no)
    {
      document.getElementById("button_edit_name_"+no).style.display="none";
      document.getElementById("button_edit_group_"+no).style.display="none";
      document.getElementById("button_save_name_"+no).style.display="block";
      document.getElementById("button_cancel_name_"+no).style.display="block";
      document.getElementById("user_name_"+no).style.display="none";
      document.getElementById("user_id_"+no+"_edit").style.display="block";
    }

    function edit_row_group(no)
    {
      document.getElementById("button_edit_name_"+no).style.display="none";
      document.getElementById("button_edit_group_"+no).style.display="none";
      document.getElementById("button_save_group_"+no).style.display="block";
      document.getElementById("button_cancel_group_"+no).style.display="block";
      document.getElementById("group_name_"+no).style.display="none";
      document.getElementById("group_id_"+no+"_edit").style.display="block";
    }

    function save_row_name(no)
    {
      var ans = confirm("Do you want to update this job?");
      if (ans == true)
      {
            var user_id_edit=document.getElementById("user_id_"+no+"_edit");

            var user_id_data=user_id_edit.options[user_id_edit.selectedIndex].value;
            var user_name_data=user_id_edit.options[user_id_edit.selectedIndex].text;

	    //update job
	    var data={};
	    data['id']=no;
	    data['driver_id']=user_id_data;	
	    $.ajax({
	        url:'update_job_details.php',
	        type:'POST',
	        data: data,
	        dataType: 'json',
	        success: function( json ) {
        		$.each(json, function(i, value) {
	        		if (value.success == "1")
		                   alert("Job details updated successfully");
	        		else
		                   alert("Update failed");

	        		document.getElementById("button_edit_name_"+no).style.display="block";
	        		document.getElementById("button_edit_group_"+no).style.display="block";
	        	});	
	
	        }
	    });

	    var user_name=document.getElementById("user_name_"+no);

	    if (user_name_data == 'Any') user_name_data = '';
	    user_name.innerHTML=user_name_data;

	    document.getElementById("button_save_name_"+no).style.display="none";
	    document.getElementById("button_cancel_name_"+no).style.display="none";
	    document.getElementById("user_name_"+no).style.display="block";
	    document.getElementById("user_id_"+no+"_edit").style.display="none";

      }
    }

    function save_row_group(no)
    {
      var ans = confirm("Do you want to update this job?");
      if (ans == true)
      {
            var user_name=document.getElementById("user_name_"+no);
            var group_name=document.getElementById("group_name_"+no);
            var user_id_edit=document.getElementById("user_id_"+no+"_edit");
            var group_id_edit=document.getElementById("group_id_"+no+"_edit");

            var group_name_original=group_name.innerHTML;
            var group_id_data=group_id_edit.options[group_id_edit.selectedIndex].value;
            var group_name_data=group_id_edit.options[group_id_edit.selectedIndex].text;

	    //update driver
	    var data={};
	    data['id']=no;
	    data['group_id']=group_id_data;	
	    $.ajax({
	        url:'update_job_details.php',
	        type:'POST',
	        data: data,
	        dataType: 'json',
	        success: function( json ) {
        		$.each(json, function(i, value) {
	        		if (value.success == "1")
	        		{
		                   alert("Job details updated successfully");
		                   location=window.location.href;
	        		}
	        		else
		                   alert("Update failed");

	        		//document.getElementById("button_edit_name_"+no).style.display="block";
	        		//document.getElementById("button_edit_group_"+no).style.display="block";

	        	});	
	
	        }
	    });

	    var group_name=document.getElementById("group_name_"+no);

	    group_name.innerHTML=group_name_data;

            if (group_name_data != group_name_original)
            {
              user_name.innerHTML = "";
              user_id_edit.innerHTML = "";
            }

            document.getElementById("button_save_group_"+no).style.display="none";
            document.getElementById("button_cancel_group_"+no).style.display="none";
            document.getElementById("group_name_"+no).style.display="block";
            document.getElementById("group_id_"+no+"_edit").style.display="none";

      }
    }

    function cancel_row_name(no)
    {
      document.getElementById("button_edit_name_"+no).style.display="block";
      document.getElementById("button_edit_group_"+no).style.display="block";
      document.getElementById("button_save_name_"+no).style.display="none";
      document.getElementById("button_cancel_name_"+no).style.display="none";
      document.getElementById("user_name_"+no).style.display="block";
      document.getElementById("user_id_"+no+"_edit").style.display="none";
    }


    function cancel_row_group(no)
    {
      document.getElementById("button_edit_name_"+no).style.display="block";
      document.getElementById("button_edit_group_"+no).style.display="block";
      document.getElementById("button_save_group_"+no).style.display="none";
      document.getElementById("button_cancel_group_"+no).style.display="none";
      document.getElementById("group_name_"+no).style.display="block";
      document.getElementById("group_id_"+no+"_edit").style.display="none";
    }


       function popupCenter(no, w, h) {
var star=document.getElementById("start"+no).innerHTML;
var en=document.getElementById("end"+no).innerHTML;
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
return window.open('map.php?start='+star+'&end='+en,  'toolbar=no,  directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 

  </script>
  
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
  </script> <script type="text/javascript" src="js/jquery.icheck/icheck.js"></script>
<script src="js/jquery.niftymodals/js/jquery.modalEffects.js"></script>
<script type="text/javascript"> 
    $(document).ready(function(){

	alert("test");

      //initialize the javascript
	$('.md-trigger').modalEffects();
        $('input').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

	function checkRequestStatus() {
		/*
		$.ajax({
			type:"get",
			url: 'get-online-drivers.php',
			success: function(responseData,textStatus,jqXHR) {
				var output="<option value=\"\">Choose driver</option>";
				$("#onlineDrivers1").html("");							
				$("#onlineDrivers2").html("");							
				$("#onlineDrivers3").html("");							
				
				try
				{
					var driversListJson=JSON.parse(responseData);	
					var driversArray=driversListJson.drivers;
					
					for (i = 0; i < driversArray.length; i++) {
						output+="<option value="+driversArray[i]["user_id"]+">"+driversArray[i]["user_name"]+"</option>";
					}
				}
				catch (err)
				{
				}
				
				$("#onlineDrivers1").html(output);
				$("#onlineDrivers2").html(output);
				$("#onlineDrivers3").html(output);
				
				setTimeout(checkRequestStatus, 10000);
			}
		});
		*/
		alert("test");
		setTimeout(checkRequestStatus, 10000);
	}

	setTimeout(checkRequestStatus, 100);

    });
	
	
</script>
<!-- Right Chat--><script src="js/jquery.js"></script>
	<script src="js/jquery.cookie/jquery.cookie.js"></script>
  <script src="js/jquery.pushmenu/js/jPushMenu.js"></script>
	<script type="text/javascript" src="js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
	<script type="text/javascript" src="js/jquery.sparkline/jquery.sparkline.min.js"></script>
  <script type="text/javascript" src="js/jquery.ui/jquery-ui.js" ></script>
	<script type="text/javascript" src="js/jquery.gritter/js/jquery.gritter.js"></script>
	<script type="text/javascript" src="js/behaviour/core.js"></script>
    
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
  </script> <script type="text/javascript" src="js/jquery.datatables/jquery.datatables.min.js"></script>
<script type="text/javascript" src="js/jquery.datatables/bootstrap-adapter/js/datatables.js"></script>
<script type="text/javascript">
      //Add dataTable Functions
    $(document).ready(function(){
      //initialize the javascript
      //Basic Instance
      $("#datatable").dataTable();
      
      //Search input style
      $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search');
      $('.dataTables_length select').addClass('form-control');    
          
       /* Formating function for row details */
        function fnFormatDetails ( oTable, nTr )
        {
            var aData = oTable.fnGetData( nTr );
            var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
            sOut += '<tr><td>Rendering engine:</td><td>'+aData[1]+' '+aData[4]+'</td></tr>';
            sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
            sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
            sOut += '</table>';
             
            return sOut;
        }
       
        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement( 'th' );
        var nCloneTd = document.createElement( 'td' );
        nCloneTd.innerHTML = '<img class="toggle-details" src="images/plus.png" />';
        nCloneTd.className = "center";
         
        $('#datatable2 thead tr').each( function () {
            this.insertBefore( nCloneTh, this.childNodes[0] );
        } );
         
        $('#datatable2 tbody tr').each( function () {
            this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
        } );
         
        /*
         * Initialse DataTables, with no sorting on the 'details' column
         */
        var oTable = $('#datatable2').dataTable( {
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']]
        });
         
        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        $('#datatable2').delegate('tbody td img','click', function () {
            var nTr = $(this).parents('tr')[0];
            if ( oTable.fnIsOpen(nTr) )
            {
                /* This row is already open - close it */
                this.src = "images/plus.png";
                oTable.fnClose( nTr );
            }
            else
            {
                /* Open this row */
                this.src = "images/minus.png";
                oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
            }
        } );
        
      $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search');
      $('.dataTables_length select').addClass('form-control');    

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
