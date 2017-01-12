<?php
/*
$json_string = file_get_contents('php://input');
$jsonObj = json_decode($json_string);
$to = $jsonObj->{"result"}[0]->{"content"}->{"from"};//送る相手
$text = $jsonObj->{"result"}[0]->{"content"}->{"text"};//これがユーザーが送ってきた文章
//$nickname=$jsonObj->{"contacts"}[0]->{"displayName"};
//$nickname=getDisplayName($to);
*/
/*新しいやつ*/

$json_string=file_get_contents('php://input');
$json_object=json_decode($json_string);
$content=$json_object->result{0}->content;
$text=$content->text;
$to=$content->from;
$message_id=$content->id;
$content_type=$content->contentType;
//$nickname=$json_object->contacts



/*ここまで*/





$logtext="「".$text."」"." from ".$to." at ".date("Y年m月d日 H時i分s秒");
//$sendtext="「".$text."」"."\n"." from ".$to."\n"." at ".date("Y年m月d日 H時i分s秒");
$sendtext=$text."、じゃねぇんだよ、もっと面白いこと言え。";


if($text=="ばか"){
    $sendtext="ばかはお前だ";
}

if($text==""){
    $sendtext="自己紹介してください";
}


if(in_array($content_type, array(2,3,4))){
    //api_get_message_content_request($message_id);
    $sendtext='画像';
}


/*log出力*/
$filepass="../../../linelog/log.txt";
$fp = fopen($filepass, "a");
//fwrite($fp, $username."/".date("Y年m月d日 H時i分s秒").":".$text."\n");
fwrite($fp, $logtext."\n\n");
// "[".$text."]"."from ".$username." at".date("Y年m月d日 H時i分s秒")."\n"
fclose($fp);



// テキストで返事をする場合
//$response_format_text = ['contentType'=>1,"toType"=>1,"text"=>"僕も".$text];
$response_format_text = ['contentType'=>1,"toType"=>1,"text"=>$sendtext];
//$response_format_text = ['contentType'=>1,"toType"=>1,"text"=>$to];

// 画像で返事をする場合
//$response_format_image = ['contentType'=>2,"toType"=>1,'originalContentUrl'=>"画像URL","previewImageUrl"=>"サムネイル画像URL"];
// 他にも色々ある
// ....

// toChannelとeventTypeは固定値なので、変更不要。
/*ここは*/
$post_data = ["to"=>[$to],"toChannel"=>"1383378250","eventType"=>"138311608800106203","content"=>$response_format_text];
/*変えない*/


/*相手に送ってるとこ*/
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
/*ここまで*/


/*自分に来るもの*/
$sendtext="notification\n\n"."「".$text."」"."\n"." from ".$to."\n"." at ".date("Y年m月d日 H時i分s秒");
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
/*ここまで*/