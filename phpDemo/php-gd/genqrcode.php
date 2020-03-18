<?php


//生成二维码的DEMO
include "../phpqrcode/phpqrcode.php";
$value="http://www.baidu.com";
$errorCorrectionLevel = "L"; // 纠错级别：L、M、Q、H
$matrixPointSize = "4"; // 点的大小：1到10
$path = './123456.png';
QRcode::png($value, $path, $errorCorrectionLevel, $matrixPointSize,4);



?>