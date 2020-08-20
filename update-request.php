<?php

if(isset($_POST['id']) && isset($_POST['accept']) && isset($_POST['driver_id']) && isset($_POST['driver_email']) && isset($_POST['driver_name']) && isset($_POST['group_id']) && isset($_POST['accepted_datetime'])){

$response = array();
require_once 'core/db_connect.php';
$db = new DB_CONNECT();

//Pass your driver number here
$id = $_POST['id'];
$accept = $_POST['accept'];
$driver_id = $_POST['driver_id'];
$driver_email = $_POST['driver_email'];
$driver_name = $_POST['driver_name'];
$accepted_datetime = $_POST['accepted_datetime'];
$group_id = $_POST['group_id'];

//Get user id of the driver
//As the conceptAssignments have the driverNo instead of the user id, we need to get the user id
if($accept==0){

	$result = mysql_query("UPDATE texirequest SET accept='$accept', driver_id=0, driver_email='$driver_email', driver_name='$driver_name', group_id='$group_id', accepted_datetime='$accepted_datetime' where id = '$id'");
}
else if($accept==4){


$rate=$_POST['rate'];
$result = mysql_query("UPDATE texirequest SET rate='$rate',accept='$accept', driver_id='$driver_id', driver_email='$driver_email', driver_name='$driver_name', group_id='$group_id', accepted_datetime='$accepted_datetime' where id = '$id'");
}
else{
$result = mysql_query("UPDATE texirequest SET accept='$accept', driver_id='$driver_id', driver_email='$driver_email', driver_name='$driver_name', group_id='$group_id', accepted_datetime='$accepted_datetime' where id = '$id'");
}
	if($result){
			$response["success"] = 1;
			$response["message"] = "Data Update successful.";
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
