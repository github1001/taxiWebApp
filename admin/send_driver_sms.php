<?php

	require_once '../includes/config.php';

	$response = array();

	$timedate = $_POST['timedate'];

	$query=$pdo->prepare("SELECT locations.phone,name,driver_name,booking_time,driver_name FROM texirequest JOIN locations on locations.id=texirequest.driver_id WHERE accept=1 AND TIMESTAMPDIFF(MINUTE, booking_time, '$timedate') <= 30");
	$query->execute();
	$count = $query->rowCount();


function ismscURL($link){
	

      $http = curl_init($link);

      curl_setopt($http, CURLOPT_RETURNTRANSFER, TRUE);
      $http_result = curl_exec($http);
      $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
      curl_close($http);

      return $http_result;
     }
if($count==1){
$rows=$query->fetch(PDO::FETCH_OBJ);
      $destination = $rows->phone;
      $message = "Dear ".$rows->driver_name." THis message is to remind you that you have a booking with".$rows->name."at".$rows->booking_time."from ".$rows->location.".Please be there on time.";
      $message = html_entity_decode($message, ENT_QUOTES, 'utf-8'); 
      $message = urlencode($message);
      
      $username = urlencode("reubenvarghese1");//change your username here
      $password = urlencode("reubenvarghese1");//Add your password here
      $sender_id = urlencode("66300");
      $type = urlencode("1");

      $fp = "https://www.isms.com.my/isms_send.php";
      $fp .= "?un=$username&pwd=$password&dstno=$destination&msg=$message&type=$type&sendid=$sender_id";
      //echo $fp;
      
      $result = ismscURL($fp);}
	/*$rows=array();
	$rows["count"]=$count;
	if(]]\\\)*/
		$rows=array();
	$rows["count"]=$count;
	array_push($response, $rows);
	echo json_encode($response);
?>