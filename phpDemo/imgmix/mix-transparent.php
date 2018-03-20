<?php

header('Content-Type:image/png');
//创建画布
$src_header_path = './avatar.jpg';
$src_header = imagecreatefromjpeg($src_header_path);
imagesavealpha($src_header,true);
$header = imagecreatetruecolor(imagesx($src_header), imagesy($src_header));
imagecopy($header,$src_header,0,0,0,0,imagesx($src_header), imagesy($src_header));


////添加指纹图覆盖原图
$src_header_path = './p.png';
$src_header = imagecreatefrompng($src_header_path);
imagesavealpha($src_header,true);
$header2 = imagecreatetruecolor(imagesx($src_header), imagesy($src_header));
imagecopy($header2,$src_header,0,0,0,0,imagesx($src_header), imagesy($src_header));

$bg = imagecreatetruecolor(750,1008);
$bgcolor = imagecolorallocate($bg,255,255,255);
imagecolortransparent($bg,$bgcolor);
imagefill($bg,0,0,$bgcolor);
imagecopy($bg,$header2,0,0,0,0,imagesx($src_header), imagesy($src_header));

//imagecopyresampled ($header, $bg, 0, 0, 0, 0, 750, 1008, 750,1008);

imagepng($bg);
imagedestroy($bg);
//图片改变大小
function imageresize($filename,$newname,$newwidth,$newheight){

    if(!empty($filename) && file_exists($filename)){
        list($width, $height) = getimagesize($filename);
        $thumb = imagecreatetruecolor($newwidth, $newheight);

        $suffix = strrchr($filename,'.');
        switch($suffix){
            case '.gif':
                $source = imagecreatefromgif($filename);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagegif($thumb,$newname);
                break;
            case '.png':
                $source = imagecreatefrompng($filename);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagepng($thumb,$newname);
                break;
            case '.jpg':
                $source = imagecreatefromjpeg($filename);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagejpeg($thumb,$newname);
                break;
            case '.bmp':
                $source = imagecreatefromwbmp($filename);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagewbmp($thumb,$newname);
                break;
        }

        imagedestroy($thumb);
    }else {
        echo 'INVALID IMAGE';
    }
}

function p($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}