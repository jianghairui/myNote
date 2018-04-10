<?php
header('Content-Type:image/png');
//底层头像图片
$path_1 = "./p.png";
//上层指纹图片
$path_2 = "./avatar.jpg";
//将头像和指纹图片分别取到两个画布中
$image_1 = imagecreatefrompng($path_1);
$image_2 = imagecreatefromjpeg($path_2);
//创建一个和图片一样大小的真彩色画布（ps：只有这样才能保证后面copy指纹图片的时候不会失真）
$image_3 = imageCreatetruecolor(imagesx($image_1),imagesy($image_1));
//为真彩色画布创建白色背景，再设置为透明
$color = imagecolorallocate($image_3, 255, 255, 255);
imagefill($image_3, 0, 0, $color);
imageColorTransparent($image_3, $color);
//首先将霍建华画布采样copy到真彩色画布中，不会失真
imagecopyresampled($image_3,$image_2,0,0,0,0,imagesx($image_2),imagesy($image_2),imagesx($image_2),imagesy($image_2));
//再将指纹图片copy到已经具有人物图像的真彩色画布中，同样也不会失真
imagecopyresampled($image_3,$image_1,0,0,0,0,imagesx($image_1),imagesy($image_1),imagesx($image_1),imagesy($image_1));
//imagecopymerge($image_3,$image_1, 0,0,0,0,imagesx($image_1),imagesy($image_1), 100);
imagegif($image_3,'./aaa.png');
?>