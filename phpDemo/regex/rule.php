<?php
header('Content-Type:text/html;charset=utf-8');
//金钱正则表达式
$rule = '/^[0-9]{1,8}(\.[0-9]{1,2})?$/';
//手机号正则表达式
$tel = '/^1(3[0-9]|4[57]|5[0-35-9]|7[0135678]|8[0-9])\d{8}$/';
if(preg_match($rule, 12345678)) {
	echo "匹配";
}else {
	echo "不匹配";
}


//替换掉字符串中的中文

// $str = "h把t这t行p字s里:的/中/文p都a删n掉.其b它a的i都d留u下.把c这o行m字/里s的/中1文S都C删r掉2其T它u的J都T留K下d把Q这v行6字Z里w的O中u文A都9删Q掉c其Q";
// $result = preg_match_all("/[^\x{4e00}-\x{9fa5}]+/u",$str,$match);

?>