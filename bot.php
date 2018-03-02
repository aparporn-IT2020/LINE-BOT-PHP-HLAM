<?php

function CreatePost ($replyToken,$messages,$data,$access_token){
  // Make a POST Request to Messaging API to reply to sender			
   $url = 'https://api.line.me/v2/bot/message/reply';			
   $data = [				'replyToken' => $replyToken,				'messages' => [$messages],			];			
   $post = json_encode($data);			
   $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);			
   $ch = curl_init($url);			
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");			
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);			
   curl_setopt($ch, CURLOPT_POSTFIELDS, $post);			
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);			
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);			
   $result = curl_exec($ch);			
   curl_close($ch);		
 
   echo $result . "";
}

function GetData (){  
 $fiarray = explode("\n", file_get_contents('Shopping.txt'));
  return $fiarray;
}
 


echo "Hi , I'm shopping bot ";
$access_token = '8fsfZxbwQLZGFtqc1rU/JGRsr4FHbXPpN8xv2v2cR4ry5mGgYzwsAUBvmx51ozB3e1NlNQuW7fFI8babhjaGeceCxNkQTKAdkpzXOy7/3phOil6V54Ft5yhpd/dGhpu1x4NcjbeXgPboFTQcGCJXdgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);

// Validate parsed JSON data
if (!is_null($events['events'])) {	
 // Loop through each event	
 foreach ($events['events'] as $event) {		
  // Reply only when message sent is in 'text' format		
  if ($event['type'] == 'message' && $event['message']['type'] == 'text') {			
    $fileArr = GetData();
      echo $fileArr;
   // Get text sent			
   $text = $event['message']['text'];			
   // Get replyToken			
   $replyToken = $event['replyToken'];			
   // Build message to reply back			
   $messages = ['type' => 'text','text' => $text];			
  CreatePost($replyToken,$messages ,$data,$access_token);
  
  }	}}echo "OK";

?>
