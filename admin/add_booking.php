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

  		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTJDS1y4ZYwzf2uNXpkrU7yAVYr0fQZ5Q&libraries=places"></script>

			<script>
			var placeSearch, autocomplete, autocomplete1;
 			var currChat = 0;
 			var prevChat = 0;
			var componentForm = {
			  street_number: 'short_name',
			  route: 'long_name',
			  locality: 'long_name',
			  administrative_area_level_1: 'short_name',
			  country: 'long_name',
			  postal_code: 'short_name'
			};
			
			function initAutocomplete() {
			  // Create the autocomplete object, restricting the search to geographical
			  // location types.
			  autocomplete = new google.maps.places.Autocomplete(
			      /** @type {!HTMLInputElement} */(document.getElementById('location')),
			      {types: ['geocode']});
                  
              autocomplete1 = new google.maps.places.Autocomplete(
              /** @type {!HTMLInputElement} */(document.getElementById('destination')),
              {types: ['geocode']});
			
			  // When the user selects an address from the dropdown, populate the address
			  // fields in the form.
			  autocomplete.addListener('place_changed', fillInAddress);
              autocomplete1.addListener('place_changed', fillInAddress);
			}
			
			// [START region_fillform]
			function fillInAddress() {
			  // Get the place details from the autocomplete object.
			  var place = autocomplete.getPlace();
			
				if (place.geometry.viewport) {
		      map.fitBounds(place.geometry.viewport);
		    } else {
		      map.setCenter(place.geometry.location);
		    }

				var marker = new google.maps.Marker({
				    position: place.geometry.location,
				    map: map
				  });

 				var popup = new google.maps.InfoWindow({
 		 		});
 		
 		 		popup.setContent(place.name);
 		 		popup.open(map, marker);

 		 		google.maps.event.addListener(marker, "click", function() {
						marker.setMap(null);
 		 		});

			  for (var component in componentForm) {
			    if (document.getElementById(component) != null)
			    {
				    document.getElementById(component).value = '';
				    document.getElementById(component).disabled = false;
			    }
			  }
			
			  // Get each component of the address from the place details
			  // and fill the corresponding field on the form.
			  for (var i = 0; i < place.address_components.length; i++) {
			    var addressType = place.address_components[i].types[0];
			    if (componentForm[addressType]) {
			      var val = place.address_components[i][componentForm[addressType]];
			      document.getElementById(addressType).value = val;
			    }
			  }
			}           
			// [END region_fillform]
			
			// [START region_geolocation]
			// Bias the autocomplete object to the user's geographical location,
			// as supplied by the browser's 'navigator.geolocation' object.
			function geolocate() {
			      var circle = new google.maps.Circle({
			        center: {lat: 2.9822375, lng: 101.4676787},
			        radius: 100000
			      });
			      autocomplete.setBounds(circle.getBounds());
			}
			// [END region_geolocation]
		
function getlatlong()
{
  var locationaddress = document.getElementById('location').value;
  var destinationaddress = document.getElementById('destination').value;

  var geocoder = new google.maps.Geocoder();

  geocoder.geocode({address: locationaddress}, function(results, status) {

    if (status == google.maps.GeocoderStatus.OK) {
      document.getElementById('locationlat').value = results[0].geometry.location.lat();
      document.getElementById('locationlong').value = results[0].geometry.location.lng();
    }
    else {
      document.getElementById('locationlat').value = '';
      document.getElementById('locationlong').value = '';
    }
  });

  geocoder.geocode({address: destinationaddress}, function(results, status) {

    if (status == google.maps.GeocoderStatus.OK) {
      document.getElementById('destinationlat').value = results[0].geometry.location.lat();
      document.getElementById('destinationlong').value = results[0].geometry.location.lng();
    }
    else {
      document.getElementById('destinationlat').value = '';
      document.getElementById('destinationlong').value = '';
    }
  });
}

		</script>

<style type="text/css">
.setmyheight
  {
	  height:70px;

  }
</style>    
</head>
<body onload="initAutocomplete()">

<div id="cl-wrapper">
  <div class="container-fluid" id="pcont">
    <!-- TOP NAVBAR -->

	
    <div class="cl-mcont">
	  <div class="row">
	    <div class="col-sm-12 col-md-12">
        <div class="block-flat">
          <div class="header">							
            <h3>Customer Booking</h3>
          </div>
          <div class="content">
          <div class="form-group col-md-12 ">
            <?php if (isset($_POST['book'])){
			$db->addBooking();  
			}
			?>
			
        <form action="" id="bookingForm" method="post" enctype="multipart/form-data"> 
          
          
          
            <div class="form-group col-md-3 setmyheight">
              <label>Name</label>
			  <input type="text" name="name" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
			<div class="form-group col-md-3 setmyheight">
              <label>Phone Number</label>
			  <input type="number" name="no" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
			<div class="form-group col-md-3 setmyheight">
              <label>Location</label>
			  <input type="text" id="location" name="location" onFocus="geolocate()" onblur="getlatlong()" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
			<div class="form-group col-md-3 setmyheight">
              <label>Destination</label>
			  <input type="text" id="destination" name="destination" onFocus="geolocate()" onblur="getlatlong()" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
<div class="form-group col-md-3 setmyheight">
              <label>Rate</label>
			  <input type="text" id="rate" name="rate" parsley-trigger="change"   placeholder="" class="form-control">
            </div>
            <div class="form-group col-md-3 setmyheight">
              <label>Type</label>
			  <select name="types" id="types" parsley-trigger="change" placeholder="" class="form-control">
			  <option name ="types" id="types" value="VehicleDriverLuxury">Driver & Car - Luxury</option>
			  <option name ="types" id="types" value="VehicleDriverBudget">Driver & Car - Budget</option>
			  <option name ="types" id="types" value="VehicleDriverMetered" >Driver & car - Metered</option>
			  <option name ="types" id="types" value="Driver" >Driver</option>
			  </select>
            </div>
            <br>
            
            <div class="form-group col-md-3 setmyheight">
              <label>Vehicle Type</label>
			  <select name="vehicle_type" id="vehicle_types" placeholder="" class="form-control">
			  <option value="car">car</option>
			  <option value="lorry">Lorry</option>
			  <option value="van">Van</option>
              <option value="none">None</option>
			  </select>
            </div>
            
            
			<div class="form-group col-md-3 setmyheight">
              <label>Number of Passengers</label>
			  <input type="number" name="num_passengers" value="1" parsley-trigger="change" placeholder="" class="form-control">
            </div>
            		
			<div class="form-group col-md-3">
              <label>Booking Time</label>
			  <input type="datetime-local" id="datepicker" name="booking_time" class="form-control"  />
            </div>
			
			<div class="form-group col-md-3">
              <label>Assign Driver?</label>
              <br>
			 <input type="radio" id="status" name="status" value="yes" class="form-group"   >Yes       
			  <input type="radio" id="status" name="status" value="no" class="form-group" checked="checked" >No
            
            </div>

            <div class="form-group col-md-3 setmyheight" id="groups" style="display:none;">
              <label>Groups</label>
			  <select name="group_id" id="group_id" parsley-trigger="change" placeholder="" class="form-control">
				<?php
				$db->getDriverGroups();
				?>
			  </select>
            </div>
            
			<div class="form-group col-md-3 setmyheight" id="groupdriver" style="display:none;">
              <label>Driver</label>
			  <select name="driver_id" id="driver_id" parsley-trigger="change" placeholder="" class="form-control">
				<!-- <?php
				$db->getOnlineDriversByGroups();
				?> -->
			  </select>
            </div>
			
            <div class="clear"></div>
            
         
            <div class="form-group col-md-12 ">
            
            
	      <input type="hidden" name="timedate" id="timedate">
	      <input type="hidden" name="locationlat" id="locationlat">
	      <input type="hidden" name="locationlong" id="locationlong">
	      <input type="hidden" name="destinationlat" id="destinationlat">
	      <input type="hidden" name="destinationlong" id="destinationlong">
                
              <button class="btn btn-primary" type="">Pay Now</button>
              <button class="btn btn-default" type="submit" name="book">Book Now</button>
              </div>
            </form>

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

//    today = dd+"-"+mm+"-"+yyyy+" "+hour+":"+min+":"+sec;
    today = yyyy+"-"+mm+"-"+dd+" "+hour+":"+min+":"+sec;

  document.getElementById('timedate').value = today;
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
	
	
      $("input[name='status']").on("click", function() {
          
			if($(this).val() == 'yes'){
				  $("#groups").show();
				  //$("#groupdriver").show();
			}else{
				  $("#groups").hide();
				  $("#groupdriver").hide();
				  $("#group_id").val("0");  //reset selections
				  $("#driver_id").val("0");  //reset selections
			}
			
        });
		
$('#group_id').on('change', function() {
  if (this.value != "0")
  {
    $("#driver_id").html("");  //remove all existing options in driver dropdown

    //re-populate driver dropdown based on selected group
    $.ajax({
        url:'get_online_drivers_by_group.php',
        type:'POST',
        data: 'group_id=' + this.value,
        dataType: 'json',
        success: function( json ) {
            $.each(json, function(i, value) {
                $('#driver_id').append($('<option>').text(value.user_name).attr('value', value.user_id).css({'background-color': value.color,'color':'black'}));
            });

            //show driver dropdown only after populated
            $("#groupdriver").show();
        }
    });
  }
  else 
  {
    $("#groupdriver").hide();
    $("#driver_id").val("0");  //reset selections
  }
});				

    // We can use the change(); function to watch the state of the select box and run some conditional logic every time it's changes to hide or show the second select box
    $("#typess").on("click", function(){
        if( $(this).val()=='Driver' ){
            $("#vehicle_types").show();
        } else {
            $("#vehicle_types").show();
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
