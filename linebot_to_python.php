<?php

$json_string=file_get_contents('php://input');
$json_object=json_decode($json_string);
$content=$json_object->result{0}->content;//これが、基本的な内容
$text=$content->text;//送られてきた文章
$to=$content->from;//誰から来たか（変な文字列）
$message_id=$content->id;
$content_type=$content->contentType;//コンテントタイプ
//$message_time=$content->createdTime;

$text='aa';
$fullPath="python linebot.py $text";

exec($fullPath,$outpara);

//var_dump($message_time);
var_dump($outpara);
/*要編集!!!!!!!!*/
$sendtext=$outpara[0];

/****************
**これからの流れ
**受け取ったテキストを、pythonに渡す
**outpara[0]に来たものを返す
**
**
**
**
**
******************/

/*送信部分*/
$response_format_text = ['contentType'=>1,"toType"=>1,"text"=>$sendtext];
$post_data = ["to"=>[$to],"toChannel"=>"1383378250","eventType"=>"138311608800106203","content"=>$response_format_text];

$ch = curl_init("https://trialbot-api.line.me/v1/events");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charset=UTF-8',
    'X-Line-ChannelID:1468184431',
    'X-Line-ChannelSecret:26888f8adb849a69c154fcf309aff2a9',
    'X-Line-Trusted-User-With-ACL:udfe52feea9ae153745a74c3dc38e1b8a'
    ));
$result = curl_exec($ch);
curl_close($ch);



/*自分に送っている。*/

/*要編集!!!!!!!!*/
$sendtext="notification\n\n"."「".$text."」"."\n"." from ".$to."\n"." at ".date("Y年m月d日 H時i分s秒");
//$sendtext=$message_time;
/**/
$response_format_text = ['contentType'=>1,"toType"=>1,"text"=>$sendtext];

$log_data = ["to"=>["u28aabf00130810b40076ea8065c7e276"],"toChannel"=>"1383378250","eventType"=>"138311608800106203","content"=>$response_format_text];

$ch = curl_init("https://trialbot-api.line.me/v1/events");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($log_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charset=UTF-8',
    'X-Line-ChannelID:1468184431',
    'X-Line-ChannelSecret:26888f8adb849a69c154fcf309aff2a9',
    'X-Line-Trusted-User-With-ACL:udfe52feea9ae153745a74c3dc38e1b8a'
    ));
$result = curl_exec($ch);
curl_close($ch);


?>