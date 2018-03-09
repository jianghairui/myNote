<?php
error_reporting(E_ALL &~ E_NOTICE);
$link = mysqli_connect('localhost','root','root') or die('连接数据库失败！');
mysqli_select_db($link,'bookstore') or die('选择数据库失败！');




?>