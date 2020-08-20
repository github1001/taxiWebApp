<?php

if(isset($_POST['user_id'])){
	require_once 'core/db_connect.php';
	$db = new DB_CONNECT();

	$response = array();

	$user_id= $_POST['user_id'];

	$result = mysql_query("SELECT * FROM chat JOIN users ON chat.user_id = users.user_id WHERE chat.user_id = $user_id ORDER BY id DESC");

	if($result) {
		$response["messages"] = array();
		while ($message=mysql_fetch_array($result)) {
			$messages=array();
			$messages["user_name"]=$message["user_name"];
			$messages["fromadmin"]=$message["fromadmin"];
			$messages["message"]=$message["message"];
			$messages["datetime"]=$message["datetime"];
			array_push($response["messages"], $messages);
		}
		$response["success"] = 1;
		$response["message"] = "Loading messages successful.";
		echo json_encode($response);
	}
	else {
		$response["success"] = 0;
		$response["message"] = "Could not load messages: ".mysql_error();
		echo json_encode($response);
	}
}
else {
	$response["success"] = 0;
	$response["message"] = "Required field(s) is missing";
	// echoing JSON response
	echo json_encode($response);
}
?>