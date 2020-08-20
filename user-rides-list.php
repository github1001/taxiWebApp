<?php

if(isset($_POST['user_id'])){
$response = array();
require_once 'core/db_connect.php';
$db = new DB_CONNECT();

//Pass your driver number here
$user_id = $_POST['user_id'];
if (isset($_POST['datetime'])) $datetime = $_POST['datetime'];

if (isset($_POST['datetime']))
	$result = mysql_query("SELECT texirequest.id,texirequest.group_id,driver_id, driver_name, driver_email, sender_id, texirequest.name, phone, droplocation, location, texirequest.latitude, texirequest.longitude, timedate, accept, booking_time, vehicleinfo,rate FROM texirequest LEFT JOIN locations ON texirequest.driver_email COLLATE latin1_general_ci  = locations.email COLLATE latin1_general_ci  WHERE sender_id = '$user_id' AND (TIMESTAMPDIFF(HOUR, booking_time, '$datetime') <= 48 AND TIMESTAMPDIFF(HOUR, '$datetime', booking_time) <= 24) ORDER BY id DESC");
else
	$result = mysql_query("SELECT texirequest.id,texirequest.group_id,rate,driver_id, driver_name, driver_email, sender_id, texirequest.name, phone, droplocation, location, texirequest.latitude, texirequest.longitude, timedate, accept, booking_time, vehicleinfo FROM texirequest LEFT JOIN locations ON texirequest.driver_email COLLATE latin1_general_ci  = locations.email COLLATE latin1_general_ci  WHERE sender_id = '$user_id' ORDER BY id DESC");

	if($result){
		$response["ridelist"] = array();
		while ($rowBooking=mysql_fetch_array($result)) {
					$infos=array();
					$infos["id"]=$rowBooking["id"];
					$infos["driver_id"]=$rowBooking["driver_id"];
					$infos["driver_name"]=$rowBooking["driver_name"];//added by me
					$infos["driver_email"]=$rowBooking["driver_email"];
					$infos["sender_id"]=$rowBooking["sender_id"];
					$infos["name"]=$rowBooking["name"];
					$infos["phone"]=$rowBooking["phone"];
					$infos["droplocation"]=$rowBooking["droplocation"];
					$infos["location"]=$rowBooking["location"];
					$infos["latitude"]=$rowBooking["latitude"];
					$infos["longitude"]=$rowBooking["longitude"];
					$infos["timedate"]=$rowBooking["timedate"];
					$infos["accept"]=$rowBooking["accept"];
					$infos["booking_time"]=$rowBooking["booking_time"];
					$infos["vehicleinfo"]=$rowBooking["vehicleinfo"];
					$infos["rate"]=$rowBooking["rate"];//added by me
					$infos["group_id"]=$rowBooking["group_id"];//added by me
					array_push($response["ridelist"], $infos);
				}
			$response["success"] = 1;
			$response["message"] = "Loading Data successful.";
			echo json_encode($response);
		}else{
			$response["success"] = 0;
			$response["message"] = "Could not load data".mysql_error();
			echo json_encode($response);
		}
}else{

	$response["success"] = 0;
	$response["message"] = "Required field(s) is missing";
	// echoing JSON response
	echo json_encode($response);

}
?>
