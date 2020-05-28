<?php
//ini_set('memory_limit','1024m');
//底层头像图片
$path_1 = "./test.png";
$text1 = '0528 0528 0528';
$text2 = ' 0528 0528 ';

$qrcode = imageresize($path_1,400,400);

$baitiao_shu = imagecreatetruecolor(12, 80);
$baitiao_heng = imagecreatetruecolor(80, 12);
$color = imagecolorallocate($baitiao_shu, 255, 255, 255);
imagefill($baitiao_shu, 0, 0, $color);
imagefill($baitiao_heng, 0, 0, $color);
//左上角白条
imagecopyresampled($qrcode,$baitiao_shu,34,34,0,0,imagesx($baitiao_shu),imagesy($baitiao_shu),imagesx($baitiao_shu),imagesy($baitiao_shu));
imagecopyresampled($qrcode,$baitiao_shu,102,34,0,0,imagesx($baitiao_shu),imagesy($baitiao_shu),imagesx($baitiao_shu),imagesy($baitiao_shu));

imagecopyresampled($qrcode,$baitiao_heng,34,34,0,0,imagesx($baitiao_heng),imagesy($baitiao_heng),imagesx($baitiao_heng),imagesy($baitiao_heng));
imagecopyresampled($qrcode,$baitiao_heng,34,102,0,0,imagesx($baitiao_heng),imagesy($baitiao_heng),imagesx($baitiao_heng),imagesy($baitiao_heng));
//右上角白条
imagecopyresampled($qrcode,$baitiao_shu,285,34,0,0,imagesx($baitiao_shu),imagesy($baitiao_shu),imagesx($baitiao_shu),imagesy($baitiao_shu));
imagecopyresampled($qrcode,$baitiao_shu,354,34,0,0,imagesx($baitiao_shu),imagesy($baitiao_shu),imagesx($baitiao_shu),imagesy($baitiao_shu));

imagecopyresampled($qrcode,$baitiao_heng,286,34,0,0,imagesx($baitiao_heng),imagesy($baitiao_heng),imagesx($baitiao_heng),imagesy($baitiao_heng));
imagecopyresampled($qrcode,$baitiao_heng,286,102,0,0,imagesx($baitiao_heng),imagesy($baitiao_heng),imagesx($baitiao_heng),imagesy($baitiao_heng));
//左下角白条
imagecopyresampled($qrcode,$baitiao_shu,34,286,0,0,imagesx($baitiao_shu),imagesy($baitiao_shu),imagesx($baitiao_shu),imagesy($baitiao_shu));
imagecopyresampled($qrcode,$baitiao_shu,102,286,0,0,imagesx($baitiao_shu),imagesy($baitiao_shu),imagesx($baitiao_shu),imagesy($baitiao_shu));

imagecopyresampled($qrcode,$baitiao_heng,34,285,0,0,imagesx($baitiao_heng),imagesy($baitiao_heng),imagesx($baitiao_heng),imagesy($baitiao_heng));
imagecopyresampled($qrcode,$baitiao_heng,34,354,0,0,imagesx($baitiao_heng),imagesy($baitiao_heng),imagesx($baitiao_heng),imagesy($baitiao_heng));





$black = imagecolorallocate($qrcode, 0, 0, 0);
$font = 'PingFang-Regular.ttf';//字体,字体文件需保存到相应文件夹下
$fontSize = 8;   //字体大小
//左上角
imagefttext($qrcode, $fontSize, 90, 42, 108, $black, $font, $text2);
imagefttext($qrcode, $fontSize, 270, 106, 42, $black, $font, $text2);

imagefttext($qrcode, $fontSize, 0, 32, 44, $black, $font, $text1);
imagefttext($qrcode, $fontSize, 180, 116, 104, $black, $font, $text1);

//右上角
imagefttext($qrcode, $fontSize, 90, 294, 108, $black, $font, $text2);
imagefttext($qrcode, $fontSize, 270, 358, 42, $black, $font, $text2);

imagefttext($qrcode, $fontSize, 0, 284, 44, $black, $font, $text1);
imagefttext($qrcode, $fontSize, 180, 368, 104, $black, $font, $text1);

//左下角
imagefttext($qrcode, $fontSize, 90, 42, 360, $black, $font, $text2);
imagefttext($qrcode, $fontSize, 270, 106, 294, $black, $font, $text2);

imagefttext($qrcode, $fontSize, 0, 32, 296, $black, $font, $text1);
imagefttext($qrcode, $fontSize, 180, 116, 356, $black, $font, $text1);



//34 11 12 34    80
//将$image_1 copy 到 $image_2中
//imagecopyresampled($image_2,$image_1,375,504,375,504,imagesx($image_1),imagesy($image_1),imagesx($image_1),imagesy($image_1));

header('Content-Type:image/png');
imagepng($qrcode);






function imageresize($filename,$newwidth,$newheight){

    if(!empty($filename) && file_exists($filename)){
        list($width, $height) = getimagesize($filename);
        $thumb = imagecreatetruecolor($newwidth, $newheight);

        $suffix = strrchr($filename,'.');
        switch($suffix){
            case '.gif':
                $source = imagecreatefromgif($filename);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                break;
            case '.png':
                $source = imagecreatefrompng($filename);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                break;
            case '.jpg':
                $source = imagecreatefromjpeg($filename);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                break;
            case '.bmp':
                $source = imagecreatefromwbmp($filename);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                break;
        }
        return $thumb;
    }else {
        die('INVALID IMAGE');
    }
}

function p($Arr) {
    echo '<pre>';
    var_dump($Arr);
    echo '</pre>';
    die();

}
?>