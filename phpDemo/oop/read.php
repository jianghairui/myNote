<?php
header("Content-Type:text/html;charset=utf8");
include "stream.class.php";
/*反串行化*/
//从文件中读出字符串
$str = file_get_contents("objstr.txt");
//反串行化字符串
$p = unserialize($str);
$p->say();



?>