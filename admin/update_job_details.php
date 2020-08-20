<?php

if(isset($_POST['id'])){
	require_once '../includes/config.php';

	$response = array();

	$id=$_POST['id'];
	$driver_id="";
	$group_id="";
	if (isset($_POST['driver_id'])) $driver_id=$_POST['driver_id'];
	if (isset($_POST['group_id'])) $group_id=$_POST['group_id'];

	if ($driver_id != "0")
	{
		$query=$pdo->prepare("SELECT user_email, user_name FROM users WHERE user_id='$driver_id'");
		$query->execute();
		$count = $query->rowCount();
		if($count > 0)
		{
			while ($user=$query->fetch(PDO::FETCH_OBJ))
			{
				$driver_email = $user->user_email;
				$driver_name = $user->user_name;
			}
		}
	}

	if ($driver_id != "")
	{
		if ($driver_id == "0")
		{
			$driver_id = "0";
			$driver_email = "";
			$driver_name = "";
		}
		$query=$pdo->prepare("UPDATE texirequest SET driver_id = '$driver_id', driver_email='$driver_email', driver_name='$driver_name' WHERE id = '$id'");
		$query->execute();
		$count = $query->rowCount();
	}
	else if ($group_id != "")
	{
		$query=$pdo->prepare("UPDATE texirequest SET driver_id = '', driver_email='', driver_name='', group_id = '$group_id' WHERE id = '$id'");
		$query->execute();
		$count = $query->rowCount();
	}

	if($count > 0){
		$result=array();
		$result["success"]="1";
		array_push($response, $result);
		echo json_encode($response);
	}
	else
	{
		$result=array();
		$result["success"]="0";
		array_push($response, $result);
		echo json_encode($response);
	}

}
else
{
		$result=array();
		$result["success"]="0";
		array_push($response, $result);
		echo json_encode($response);
}
?>