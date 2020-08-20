<?php

if(isset($_POST['user_id']) && isset($_POST['user_name']) && isset($_POST['user_num']) && isset($_POST['user_email']) && isset($_POST['group_id'])){
	require_once '../includes/config.php';

	$response = array();

	$user_id=$_POST['user_id'];
	$user_name=$_POST['user_name'];
	$user_num=$_POST['user_num'];
	$user_email=$_POST['user_email'];
	$group_id=$_POST['group_id'];

	$query=$pdo->prepare("SELECT user_email FROM users WHERE user_id='$user_id'");
	$query->execute();
	$count = $query->rowCount();

	$old_email = "";
	if($count > 0) {
		while ($user=$query->fetch(PDO::FETCH_OBJ)) {
			$old_email = $user->user_email;
		}

		$query=$pdo->prepare("UPDATE locations SET name = '$user_name ', number = '$user_num', email= '$user_email' WHERE email = '$old_email'");
		$query->execute();
		$count = $query->rowCount();
	
		$query=$pdo->prepare("UPDATE users SET user_name = '$user_name ', user_num = '$user_num', user_email= '$user_email', group_id = '$group_id' WHERE user_id = '$user_id'");
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
	}

}else{
		$result=array();
		$result["success"]="0";
		array_push($response, $result);
		echo json_encode($response);
}
?>