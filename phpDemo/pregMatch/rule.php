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

?>