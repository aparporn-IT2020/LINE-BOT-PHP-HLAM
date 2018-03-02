<?php
  $access_token = '8fsfZxbwQLZGFtqc1rU/JGRsr4FHbXPpN8xv2v2cR4ry5mGgYzwsAUBvmx51ozB3e1NlNQuW7fFI8babhjaGeceCxNkQTKAdkpzXOy7/3phOil6V54Ft5yhpd/dGhpu1x4NcjbeXgPboFTQcGCJXdgdB04t89/1O/w1cDnyilFU=
';
  $url = 'https://api.line.me/v1/oauth/verify';
  $headers = array('Authorization: Bearer ' . $access_token);
  
  $ch = curl_init($url);curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  
  $result = curl_exec($ch);curl_close($ch);echo $result;
  ?>
