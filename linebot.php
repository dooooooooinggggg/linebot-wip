<?php
$json_string = file_get_contents('php://input');
$jsonObj = json_decode($json_string);
$to = $jsonObj->{"result"}[0]->{"content"}->{"from"};//送る相手
$text = $jsonObj->{"result"}[0]->{"content"}->{"text"};//これがユーザーが送ってきた文章

//$nickname=$jsonObj->{"contacts"}[0]->{"displayName"};
//$nickname=getDisplayName($to);

$username = $to;


$logtext="「".$text."」"." from ".$to." at ".date("Y年m月d日 H時i分s秒");
$sendtext="「".$text."」"."\n"." from ".$to."\n"." at ".date("Y年m月d日 H時i分s秒");

/*log出力*/
$filepass="../../linelog/log.txt";
$fp = fopen($filepass, "a");
//fwrite($fp, $username."/".date("Y年m月d日 H時i分s秒").":".$text."\n");
fwrite($fp, $logtext."\n");
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


$ch = curl_init("https://trialbot-api.line.me/v1/events");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charser=UTF-8',
    'X-Line-ChannelID:1468184431',
    'X-Line-ChannelSecret:26888f8adb849a69c154fcf309aff2a9',
    'X-Line-Trusted-User-With-ACL:udfe52feea9ae153745a74c3dc38e1b8a'
    ));
$result = curl_exec($ch);
curl_close($ch);

