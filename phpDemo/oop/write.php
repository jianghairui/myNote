<?php
header("Content-Type:text/html;charset=utf8");
include "stream.class.php";
$p = new Person("姜同学",26,"male");
//将对象串行化
$str = serialize($p);
//将字符串保存到objstr.txt文件中
$res = file_put_contents("objstr.txt", $str);
if($res){
	echo "保存成功";
}else{
	echo "保存失败";
}















/*
Fatal error:Cannot access private property Person::$name
致命错误：无法获取私有属性
*/
?>