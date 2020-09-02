<?php


$ImageLink = 'https://developers.line.biz/media/homepage-products/products-messaging-api-sprite.png';
$VDOLink = 'https://mokmoon.com/videos/Brown.mp4';

$apiReply  = 'https://api.line.me/v2/bot/message/reply';
$apiPush = 'https://api.line.me/v2/bot/message/push';


function CreatePost ($url,$data){
   	
   	$access_token = '6zDMyMWoEbyMb0inVnCxNeglFVxuDjbX7S3V1fq0cvnGwHHHliSwJ3a/bSIERUAdc+lWr4chqBXbwGJT9HnZGTDAUQUGAg0O58NaiDN/83GzJ4R7Fa/FimarNBwZ+eW3zRDrv9B4/j/8hKmNJep9cgdB04t89/1O/w1cDnyilFU=';
   	$headers = array('Content-Type: application/json; charser=UTF-8', 'Authorization: Bearer ' . $access_token);	
   	$post = json_encode($data);			

   	$ch = curl_init();	

	curl_setopt($ch, CURLOPT_URL,$url);
   	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");			
   	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);			
   	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);			
   	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
//    	curl_setopt($ch, CURLOPT_HEADER, false);
    	curl_setopt($ch, CURLOPT_POST, true);
    	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

   	$result = curl_exec($ch);	
   	curl_close($ch);		
}
function PostText ($replyToken,$text){   
		$messages = ['type' => 'text','text' => $text];
   	$data = ['replyToken' => $replyToken,'messages' => [$messages],];			
   	CreatePost($apiPush,$data);
}
function PostSticker ($replyToken,$packid,$stickerid){  
	$messages = ['type' => 'sticker','packageId' => $packid, 'stickerId' => $stickerid];
	$data = ['replyToken' => $replyToken,'messages' => [$messages],];			
	CreatePost($apiPush,$data);
}
function PostImage ($replyToken,$url){  
	 $messages = ['type' => 'image','originalContentUrl' => $url, 'previewImageUrl' => $url];
	 $data = ['replyToken' => $replyToken,'messages' => [$messages],];			
	CreatePost($apiPush,$data);
}
function PostVdo ($replyToken,$urlImage,$urlVdo){  
	$messages = ['type' => 'video','originalContentUrl' => $urlVdo, 'previewImageUrl' => $urlImage];
	$data = ['replyToken' => $replyToken,'messages' => [$messages],];									 		
	CreatePost($apiPush,$data);
}
function PostButtons ($replyToken,$urlImage,$title,$caption){  
	$actions = [['type' => 'message','label' => 'yes','text' => 'yes'],['type' => 'message','label' => 'no','text' => 'no']];
	$template = ['type' => 'buttons','thumbnailImageUrl' => $urlImage,'title' => $title,'text' => $caption,'actions' => $actions];
	$messages = ['type' => 'template','template' => $template];
	
	$data = ['replyToken' => $replyToken,'messages' => [$messages],];
		
	CreatePost($apiPush,$data);
}
function PostConfirm ($replyToken,$caption){  
	
	$actions = [['type' => 'message','label' => 'yes','text' => 'yes'],['type' => 'message','label' => 'no','text' => 'no']];
	$template = ['type' => 'confirm','text' => $caption,'actions' => $actions];
	$messages = ['type' => 'template','altText' => 'This is Confirm message','template' => $template];
	
	$data = ['replyToken' => $replyToken,'messages' => [$messages],];		
	CreatePost($apiPush,$data);		
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////

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

			if ($text =='register')
			{		
				PostText($replyToken,$text);
				PostSticker($replyToken,2,161);
				PostImage($replyToken,$ImageLink);
				PostButtons($replyToken,$ImageLink,'Test','are you confirm?');			
			}
	    		elseif ($text =='training')
			{				
				PostConfirm($replyToken,'are you confirm?');				
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

*/
echo "Hi , I'm HLAM bot ";

?>
