<?php
// array for JSON response

// check for required fields

if (isset($_POST['driver_id']) && isset($_POST['driver_name'])  && isset($_POST['driver_email']) && isset($_POST['sender_id']) && isset($_POST['name']) && isset($_POST['phone'])
	&& isset($_POST['location']) && isset($_POST['droplocation']) && isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['accept']) && isset($_POST['timedate']) && isset($_POST['booking_time']) && isset($_POST['types']) && isset($_POST['drop_latitude']) && isset($_POST['drop_longitude'])){

	$response = array();

	$driver_id = $_POST['driver_id'];
	$driver_name = $_POST['driver_name'];
	$driver_email = $_POST['driver_email'];
	$sender_id = $_POST['sender_id'];
	$name = $_POST['name'];
	$phone=$_POST['phone'];
	$location=$_POST['location'];
	$droplocation=$_POST['droplocation'];
	$latitude=$_POST['latitude'];
	$longitude=$_POST['longitude'];
	$accept=$_POST['accept'];
	$timedate=$_POST['timedate'];
	$booking_time=$_POST['booking_time'];
	$types=$_POST['types'];
	$drop_latitude=$_POST['drop_latitude'];
	$drop_longitude=$_POST['drop_longitude'];




	$num_passengers=1;
	if (isset($_POST['num_passengers'])) $num_passengers=$_POST['num_passengers'];

        

	$rate=1;
	if (isset($_POST['rate'])) $rate=$_POST['rate'];

	$group_id=0;
	if (isset($_POST['group_id'])) $group_id=$_POST['group_id'];

        $position=1;

        if (isset($_POST['position'])) $position=$_POST['position'];

	// include db connect class
	require_once 'core/db_connect.php';
	$db = new DB_CONNECT();

	$sql="INSERT INTO texirequest (driver_id, driver_name, driver_email,sender_id,name,phone,location,droplocation,latitude,longitude,accept,timedate,num_passengers,rate, group_id,booking_time,types,drop_latitude, drop_longitude ,position)".
	"VALUES ('$driver_id', '$driver_name','$driver_email','$sender_id','$name','$phone','$location','$droplocation','$latitude','$longitude','$accept','$timedate','$num_passengers','$rate','$group_id','$booking_time','$types','$drop_latitude','$drop_longitude', '$position')";

	$result = mysql_query($sql);
	
	if ($result) {
		$response["success"] = 1;
		$response["message"] = "Taxi request is succcessful";
		echo json_encode($response);
	}else{

		$response["success"] = 0;
		$response["message"] = "Oops! An error occurred.".mysql_error();

		echo json_encode($response);
		}
}
	else {
// required field is missing
	$response["success"] = 0;
	$response["message"] = "Required field(s) is missing";
	// echoing JSON response
	echo json_encode($response);
}

?>