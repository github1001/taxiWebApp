<?php

if(isset($_POST['user_id']) && isset($_POST['user_email'])){
	require_once '../includes/config.php';

	$response = array();

	$user_id=$_POST['user_id'];
	$user_email=$_POST['user_email'];

	$query=$pdo->prepare("DELETE FROM locations WHERE email = '$user_email'");
	$query->execute();
	$count = $query->rowCount();

	$query=$pdo->prepare("DELETE FROM users WHERE user_id = '$user_id'");
	$query->execute();
	$count = $query->rowCount();

	if($count > 0){
		$result=array();
		$result["success"]="1";
		array_push($response, $result);
		echo json_encode($response);
	}else{
		$result=array();
		$result["success"]="0";
		array_push($response, $result);
		echo json_encode($response);
	}
}else{
		$result=array();
		$result["success"]="0";
		array_push($response, $result);
		echo json_encode($response);
}
?>