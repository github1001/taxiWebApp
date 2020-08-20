<?php

    require_once '../includes/config.php';

    $response = array();


    $query=$pdo->prepare("SELECT locations.id,latitude,longitude,texirequest.location,phone FROM texirequest JOIN locations on locations.id=texirequest.driver_id WHERE texirequest.accept=1");
    $query->execute();
    $count = $query->rowCount();

    $rows=array();
    $rows["count"]=$count;
    array_push($response, $rows);
    echo json_encode($response);

 function ismscURL($link){

      $http = curl_init($link);

      curl_setopt($http, CURLOPT_RETURNTRANSFER, TRUE);
      $http_result = curl_exec($http);
      $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
      curl_close($http);

      return $http_result;
     }


function getDistance($latitudeFrom,$longitudeFrom, $addressTo, $unit){
    //Change address format
    $formattedAddrFrom = str_replace(' ','+',$addressFrom);
    $formattedAddrTo = str_replace(' ','+',$addressTo);
    
    //Send request and receive json data
    $geocodeFrom = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false');
    $outputFrom = json_decode($geocodeFrom);
    $geocodeTo = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false');
    $outputTo = json_decode($geocodeTo);
    
    //Get latitude and longitude from geo data
    //$latitudeFrom = $outputFrom->results[0]->geometry->location->lat;
   // $longitudeFrom = $outputFrom->results[0]->geometry->location->lng;
    $latitudeTo = $outputTo->results[0]->geometry->location->lat;
    $longitudeTo = $outputTo->results[0]->geometry->location->lng;
    
    //Calculate distance from latitude and longitude
    $theta = $longitudeFrom - $longitudeTo;
    $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);
    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
}

while ($results=$query->fetch(PDO::FETCH_OBJ))
    {$distance = getDistance($results->latitude,$results->longitude, $results->location, "K");
if($distance<2){
         $destination = $results->phone;
      $message = "Dear user,This message is being sent to inform you that your cab driver is within 2km of your location so please be ready inorder to ensure that you have a smooth travel.";
      $message = html_entity_decode($message, ENT_QUOTES, 'utf-8'); 
      $message = urlencode($message);
      
      $username = urlencode("reubenvarghese1");
      $password = urlencode("reubenvarghese1");
      $sender_id = urlencode("66300");
      $type = 1;

      $fp = "https://www.isms.com.my/isms_send.php";
      $fp .= "?un=$username&pwd=$password&dstno=$destination&msg=$message&type=$type&sendid=$sender_id";
      //echo $fp;
      
      $result = ismscURL($fp);
}

}
$geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false&key=AIzaSyBTJDS1y4ZYwzf2uNXpkrU7yAVYr0fQZ5Q');

?>
