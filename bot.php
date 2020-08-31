<?php

function CreatePost ($data){
   	$url = 'https://api.line.me/v2/bot/message/reply';
   	$access_token = '6zDMyMWoEbyMb0inVnCxNeglFVxuDjbX7S3V1fq0cvnGwHHHliSwJ3a/bSIERUAdc+lWr4chqBXbwGJT9HnZGTDAUQUGAg0O58NaiDN/83GzJ4R7Fa/FimarNBwZ+eW3zRDrv9B4/j/8hKmNJep9cgdB04t89/1O/w1cDnyilFU=';
   	$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);	
   	$post = json_encode($data);			

   	$ch = curl_init();	

	curl_setopt($ch, CURLOPT_URL,$url);
   	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");			
   	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);			
   	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);			
   	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
   	//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    	curl_setopt($ch, CURLOPT_HEADER, false);
    	curl_setopt($ch, CURLOPT_POST, true);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

   	$result = curl_exec($ch);			
   	curl_close($ch);		
}
function PostText ($replyToken,$text){   
		$messages = ['type' => 'text','text' => $text];
   	$data = ['replyToken' => $replyToken,'messages' => [$messages],];			
   	CreatePost($data);
}
function PostSticker ($replyToken,$packid,$stickerid){  
	$messages = ['type' => 'sticker','packageId' => $packid, 'stickerId' => $stickerid];
	$data = ['replyToken' => $replyToken,'messages' => [$messages],];			
	 CreatePost($data);
}
function PostImage ($replyToken,$url){  
	 $messages = ['type' => 'image','originalContentUrl' => $url, 'previewImageUrl' => $url];
	 $data = ['replyToken' => $replyToken,'messages' => [$messages],];			
	CreatePost($data);
}
function PostVdo ($replyToken,$urlImage,$urlVdo){  
	$messages = ['type' => 'video','originalContentUrl' => $urlVdo, 'previewImageUrl' => $urlImage];
	$data = ['replyToken' => $replyToken,'messages' => [$messages],];									 		
	CreatePost($data);
}
function PostButtons ($replyToken,$urlImage,$title,$caption){  
	$actions = [['type' => 'message','label' => 'yes','text' => 'yes'],['type' => 'message','label' => 'no','text' => 'no']];
	$template = ['type' => 'buttons','thumbnailImageUrl' => $urlImage,'title' => $title,'text' => $caption,'actions' => $actions];
	$messages = ['type' => 'template','template' => $template];
	
	$data = ['replyToken' => $replyToken,'messages' => [$messages],];
	
	PostText($replyToken,json_encode($data));
	CreatePost($data);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////



$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('6zDMyMWoEbyMb0inVnCxNeglFVxuDjbX7S3V1fq0cvnGwHHHliSwJ3a/bSIERUAdc+lWr4chqBXbwGJT9HnZGTDAUQUGAg0O58NaiDN/83GzJ4R7Fa/FimarNBwZ+eW3zRDrv9B4/j/8hKmNJep9cgdB04t89/1O/w1cDnyilFU=');
//$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '0126e35ca29d722a11fab40b4948db24']);

$content = file_get_contents('php://input');
$events = json_decode($content, true);
$ImageLink = 'https://www.img.in.th/images/496d1a61a8e62f514852bd31ea1b1725.jpg';
$VDOLink = 'https://mokmoon.com/videos/Brown.mp4';

if (!is_null($events['events'])) 
{	
  foreach ($events['events'] as $event) 
  {		
    if ($event['type'] == 'message' && $event['message']['type'] == 'text') 
    {	
			$text = $event['message']['text'];
			$replyToken = $event['replyToken'];

			if ($text =='register')
			{
				//PostText($replyToken,$text);
				PostButtons($replyToken,$ImageLink,'Test','are you confirm?');
				//$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
				$response = $bot->replyMessage($replyToken, $textMessageBuilder);
				if ($response->isSucceeded()) {
						PostText($replyToken,'ok');
				}
				else
				{
					// Failed
				echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
				}
				
				
				
			}
	    		elseif ($text =='training')
			{
				PostText($replyToken,$text);				
			}	    
	    		elseif ($text =='contact')
			{
				PostText($replyToken,$text);				
			}	    		
			elseif ($text =='yes' || $text =='no')
			{
				PostText($replyToken,'Thank you');
			}		
    }
		
  }		
}


echo "Hi , I'm HLAM bot ";

?>
