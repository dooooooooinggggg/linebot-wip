<?php
// file name: call_python.php\
// 引用:http://freetech-e.com/html/callpython.htm
$test='xxx';
$test2="yyy";
$fullPath = "python linebot.py $test $test2";
exec($fullPath, $outpara);
//$outparaには、printされたものがくる
echo '<PRE>';
var_dump($fullPath);
var_dump($outpara[0]);
var_dump($outpara[1]);
var_dump($outpara[2]);
var_dump($outpara[3]);
echo '<PRE>';


$json_string=file_get_contents('php://input');
$json_object=json_decode($json_string);
$content=$json_object->result{0}->content;//これが、基本的な内容
$text=$content->text;//送られてきた文章
$to=$content->from;//誰から来たか（変な文字列）
$message_id=$content->id;
$content_type=$content->contentType;//コンテントタイプ

exec($fullPath,$outpara);




?>