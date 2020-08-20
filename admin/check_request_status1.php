<?php

	require_once '../includes/config.php';

	$response = array();

	$timedate = $_POST['timedate'];

	$query=$pdo->prepare("SELECT id FROM texirequest WHERE accept=0 AND TIMESTAMPDIFF(MINUTE, timedate, '$timedate') >= 5");
	$query->execute();
	$count = $query->rowCount();

	$query1=$pdo->prepare("SELECT id FROM texirequest WHERE accept=0 AND TIMESTAMPDIFF(MINUTE, timedate, '$timedate') >= 20");
	$query1->execute();




	while ($row=$query->fetch(PDO::FETCH_OBJ))
	{ 
	$query=$pdo->prepare("UPDATE texirequest SET group_id=0 WHERE id=$row['id']");
	$query->execute();
	}
	$rows=array();
	$rows["count"]=$count;
	array_push($response, $rows);
	echo json_encode($response);
?>