<?php
include "./func/function.php";
header('Content-Type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
//时分秒月日年
$d=mktime(9, 43, 31, 8, 29, 2017);
echo $d.'<br>';
echo "创建日期是 " . date("Y-m-d h:i:sa", $d) . '<br>';


echo p(getdate(strtotime(date('Y-m-d H:i:s'))));
?>