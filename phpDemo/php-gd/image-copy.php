<?php
header('Content-Type:image/png');
//底层头像图片
$path_1 = "./huof.png";
//上层指纹图片
$path_2 = "./huo.jpg";

$image_1 = imagecreatefrompng($path_1);
$image_2 = imageresize($path_2,750,1008);

//将$image_1 copy 到 $image_2中
imagecopyresampled($image_2,$image_1,375,504,375,504,imagesx($image_1),imagesy($image_1),imagesx($image_1),imagesy($image_1));
imagegif($image_2);






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
?>