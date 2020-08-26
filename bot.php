<?php

function CreatePostText ($access_token,$replyToken,$messages,$data){
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

//////////////////////////////////////////////////////////////////////////////////////////////////////////

echo "Hi , I'm HLAM bot ";
$access_token = '6zDMyMWoEbyMb0inVnCxNeglFVxuDjbX7S3V1fq0cvnGwHHHliSwJ3a/bSIERUAdc+lWr4chqBXbwGJT9HnZGTDAUQUGAg0O58NaiDN/83GzJ4R7Fa/FimarNBwZ+eW3zRDrv9B4/j/8hKmNJep9cgdB04t89/1O/w1cDnyilFU=';

$content = file_get_contents('php://input');
$events = json_decode($content, true);

if (!is_null($events['events'])) 
{	
  foreach ($events['events'] as $event) 
  {		
    if ($event['type'] == 'message' && $event['message']['type'] == 'text') 
    {			         
      $text = $event['message']['text'];
      $replyToken = $event['replyToken'];
      $messages = ['type' => 'text','text' => $text];
      
      CreatePostText($access_token,$replyToken,$messages,$data);
    }	
  }
}



?>
