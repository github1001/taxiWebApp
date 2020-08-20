<?php 
	if(isset($_POST['user_id']) && isset($_POST['fromadmin']) && isset($_POST['message']) && isset($_POST['datetime'])){
		$user_id=$_POST['user_id'];
		$fromadmin=$_POST['fromadmin'];
		$message=$_POST['message'];
		$datetime=$_POST['datetime'];
		//date_default_timezone_set('US/Pacific');

		require_once 'core/db_connect.php';
		$response = array();

		$db = new DB_CONNECT();

		$result = mysql_query("INSERT INTO chat (user_id, fromadmin, message, datetime) VALUES ('$user_id', $fromadmin, '$message', '$datetime')");

		if($result){
			$response["success"] = 1;
			$response["message"] = "Message sent successfully";
			echo json_encode($response);
		}else{
			$response["success"] = 0;
			$response["message"] = mysql_error();
			echo json_encode($response);
		}
	}else{
		$response["success"] = 0;
		$response["message"] = "Required fields are missing";
		echo json_encode($response);
	}

 ?>