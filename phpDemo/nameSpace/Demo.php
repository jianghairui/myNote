<?php
header('Content-Type:text/html;charset=utf-8');
include 'Demo.class.php';
use DemoNameSpace\Story;//使用Demo.class.php文件里DNS空间里的Demo类
$obj = new Story();
echo $obj->tale;




?>