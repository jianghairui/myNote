<?php
//生成二维码的DEMO
include "../phpqrcode/phpqrcode.php";
$value="http://www.baidu.com";
$errorCorrectionLevel = "L"; // 纠错级别：L、M、Q、H
$matrixPointSize = "4"; // 点的大小：1到10
$path = './qrcode.png';
QRcode::png($value, false, $errorCorrectionLevel, $matrixPointSize);
?>