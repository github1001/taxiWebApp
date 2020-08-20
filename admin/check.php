<?php

	require_once '../includes/config.php';

	$timedate = $_POST['timedate'];

	$query=$pdo->prepare("SELECT id FROM texirequest WHERE accept='0' AND TIMESTAMPDIFF(MINUTE, timedate, '$timedate') >='2'");
	$query->execute();
	$count = $query->rowCount();

while ($row=$query->fetch(PDO::FETCH_OBJ))
	{
$man=$row->id;

 $query1=$pdo->prepare("UPDATE texirequest SET group_id='0' where id='$man'");
	$query1->execute();

	}

	$rows=array();
	$rows["count"]=$count;
	array_push($response, $rows);
	echo json_encode($response);
?>