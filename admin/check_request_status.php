<?php

	require_once '../includes/config.php';

	$response = array();

	$timedate = $_POST['timedate'];

	$query=$pdo->prepare("SELECT id FROM texirequest WHERE accept=0 AND TIMESTAMPDIFF(MINUTE, timedate, '$timedate') >= 5");
	$query->execute();
	$count = $query->rowCount();

	$rows=array();
	$rows["count"]=$count;
	array_push($response, $rows);
	echo json_encode($response);
?>