<?php
  $access_token = 'TNpAB3x76j50mLoyeassUyuHx5fv1QtD6jiWNPHID4LiG+0l/tln/t1WnR+4Jz7a/aB11L8M+UJVqUo2UbRFNM7LqtJ8FVUGvS0CxPqQ/PDYmLCWT/lemeI6zqhlNqEQE5cZxw5iCd6m8Hz2zOKSIQdB04t89/1O/w1cDnyilFU=
';
  $url = 'https://api.line.me/v1/oauth/verify';
  $headers = array('Authorization: Bearer ' . $access_token);
  
  $ch = curl_init($url);curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  
  $result = curl_exec($ch);curl_close($ch);echo $result;
  ?>
