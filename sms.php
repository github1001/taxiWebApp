<?php

     //We create our own function to submit our link
     //Certain hosts do not support the usage of "fopen"
     function ismscURL($link){

      $http = curl_init($link);

      curl_setopt($http, CURLOPT_RETURNTRANSFER, TRUE);
      $http_result = curl_exec($http);
      $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
      curl_close($http);

      return $http_result;
     }

     $phone=$_POST["number"];

      $destination = urlencode($phone);
      $message = $_POST["msg"];
      $message = html_entity_decode($message, ENT_QUOTES, 'utf-8'); 
      $message = urlencode($message);
      
      $username = urlencode("logan_TM");
      $password = urlencode("logan_TM");
      $sender_id = urlencode("66300");
      $type = 1;

      $fp = "https://www.isms.com.my/isms_send.php";
      $fp .= "?un=$username&pwd=$password&dstno=$destination&msg=$message&type=$type&sendid=$sender_id";
      //echo $fp;
      
      $result = ismscURL($fp);
      echo $result;
     

     ?>