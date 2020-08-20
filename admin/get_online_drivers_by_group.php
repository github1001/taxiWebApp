<?php

if(isset($_POST['group_id'])){
	require_once '../includes/config.php';

	$response = array();

	$group_id= $_POST['group_id'];

	$query=$pdo->prepare("SELECT user_id,user_name,online FROM users JOIN locations ON users.user_email = locations.email  WHERE users.group_id='$group_id'");
	$query->execute();
	$count = $query->rowCount();

	if($count > 0) {
		$drivers=array();
		$drivers["user_name"]="Any";
		$drivers["user_id"]=0;
		array_push($response, $drivers);
		while ($driver=$query->fetch(PDO::FETCH_OBJ)) {
			$drivers["user_name"]=$driver->user_name;
			$drivers["user_id"]=$driver->user_id;
			if($driver->online==1){
				$drivers["color"]="green";
			}
			else{
				$drivers["color"]="";
			}
			array_push($response, $drivers);
		}
		echo json_encode($response);
	}
	else {
		$response = 0;
		echo json_encode($response);
	}
}
else {
		$response = 0;
		echo json_encode($response);
}
?>