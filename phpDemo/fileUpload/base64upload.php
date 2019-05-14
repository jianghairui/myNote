<?php
header('Content-type:text/html;charset=utf-8');
 
//$img为传入字符串
$img = $_POST['image'];
$base64_body = substr(strstr($img,','),1);;
$imgstr = str_replace(' ', '+', $base64_body);
$data = base64_decode($imgstr);

$imgPath="./test.png";
if(@file_exists($imgPath)){
    @unlink($imgPath);
}@clearstatcache();

$fp=fopen($imgPath,'w');

fwrite($fp,$data);
fclose($fp);

function p($arr) {
	echo '<pre>';
	print_r($arr);
	echo '</pre>';

/*

例:手续费率10%

发布需求金额100元,手续费10元,实际支付110元

10分钟内取消,只退100元,手续费10元不退,接单人无报酬(不论干了多少)





*/



}


