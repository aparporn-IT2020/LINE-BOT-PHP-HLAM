<?php

function CreateReply ($data){
   	$url = 'https://api.line.me/v2/bot/message/reply';
   	$access_token = '6zDMyMWoEbyMb0inVnCxNeglFVxuDjbX7S3V1fq0cvnGwHHHliSwJ3a/bSIERUAdc+lWr4chqBXbwGJT9HnZGTDAUQUGAg0O58NaiDN/83GzJ4R7Fa/FimarNBwZ+eW3zRDrv9B4/j/8hKmNJep9cgdB04t89/1O/w1cDnyilFU=';
   	$headers = array('Content-Type: application/json; charset=utf-8', 'Authorization: Bearer ' . $access_token);	
   	$post = json_encode($data);			

   	$ch = curl_init();	

	curl_setopt($ch, CURLOPT_URL,$url);
   	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");			
   	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);			
   	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);			
   	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
    	curl_setopt($ch, CURLOPT_POST, true);
    	
   	$result = curl_exec($ch);	
   	curl_close($ch);
	return $result;
}
function PostText ($replyToken,$text){   
		$messages = ['type' => 'text','text' => $text];
   	$data = ['replyToken' => $replyToken,'messages' => [$messages],];			
   	return $data;
}
function PostSticker ($replyToken,$packid,$stickerid){  
	$messages = ['type' => 'sticker','packageId' => $packid, 'stickerId' => $stickerid];
	$data = ['replyToken' => $replyToken,'messages' => [$messages],];			
	return $data;
}
function PostImage ($replyToken,$url){  
	 $messages = ['type' => 'image','originalContentUrl' => $url, 'previewImageUrl' => $url];
	 $data = ['replyToken' => $replyToken,'messages' => [$messages],];			
	return $data;
}
function PostVdo ($replyToken,$urlImage,$urlVdo){  
	$messages = ['type' => 'video','originalContentUrl' => $urlVdo, 'previewImageUrl' => $urlImage];
	$data = ['replyToken' => $replyToken,'messages' => [$messages],];									 		
	return $data;
}
function PostButtons ($replyToken,$urlImage,$title,$caption){  
	$actions = [['type' => 'postback','label' => 'Yes','data' => 'action=buy&itemid=123'],
		    ['type' => 'postback','label' => 'No','data' => 'action=sell&itemid=456']];
	$template = ['type' => 'buttons','thumbnailImageUrl' => $urlImage,'title' => $title,'text' => $caption,'actions' => $actions];
	$messages = ['type' => 'template','altText' => 'This is button message','template' => $template];
	
	$data = ['replyToken' => $replyToken,'messages' => [$messages],];									 		
	return $data;
}
function PostConfirm ($replyToken,$caption){  
	$actions = [['type' => 'message','label' => 'Yes','text' => 'yes'],
		    ['type' => 'message','label' => 'No','text' => 'no']];
	$template = ['type' => 'confirm','text' => $caption,'actions' => $actions];
	$messages = ['type' => 'template','altText' => 'This is button message','template' => $template];
	
	$data = ['replyToken' => $replyToken,'messages' => [$messages],];									 		
	return $data;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////

$content = file_get_contents('php://input');
$events = json_decode($content, true);

$ImageLink = 'https://developers.line.biz/media/homepage-products/products-messaging-api-sprite.png';
$VDOLink = 'https://mokmoon.com/videos/Brown.mp4';

if (!is_null($events['events'])) 
	{	
		foreach ($events['events'] as $event) 
		{		
			try
			{
				if ($event['type'] == 'message' && $event['message']['type'] == 'text') 
			{	
				$text = $event['message']['text'];
				$replyToken = $event['replyToken'];

				if ($text =='register')
				{
					CreateReply(PostButtons($replyToken,$ImageLink,'Test','Are you confirm?'));
				}
				elseif ($text =='training')
				{
					CreateReply(PostConfirm($replyToken,'Are you confirm?'));
				}	    
				elseif ($text =='contact')
				{
					CreateReply(PostText($replyToken,$text));										
				}	    		
				elseif ($text =='yes' || $text =='no')
				{
					CreateReply(PostText($replyToken,'Thank you'));
				}		
			}
			}
			catch (Exception $e)
			{
				CreatePost(PostText($replyToken,$e->getMessage()));
			}
		}		
	}

echo "Hi , I'm HLAM bot ";

?>
