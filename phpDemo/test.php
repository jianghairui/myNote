<?php

header('Content-Type:image/png');
//创建画布
$ban_width = 750;
$ban_height = 1008;
$img = imagecreatetruecolor($ban_width, $ban_height);
$white = imagecolorallocate($img, 255, 255,255);
imagefill($img, 0, 0, $white);

$src_header_path = './avatar.jpg';
$src_header = imagecreatefromstring(file_get_contents($src_header_path));
$src_header_arr = getimagesize($src_header_path);
$header_w = 750;
$header_h = 1008;
$header = imagecreatetruecolor($header_w, $header_h);
imagecopyresized($header, $src_header, 0, 0, 0, 0, $header_w, $header_h, $src_header_arr[0], $src_header_arr[1]);
imagecopymerge($img, $header, 0, 0, 0, 0, $header_w, $header_h, 100);



////添加指纹图覆盖原图
$src_header_path = './p.png';
$src_header = imagecreatefromstring(file_get_contents($src_header_path));
$src_header_arr = getimagesize($src_header_path);

$header2 = imagecreatetruecolor(750, 1008);
$color=imagecolorallocate($header2,255,255,255);
imagecolortransparent($header2,$color);
imagefill($header2,0,0,$color);

imagecopyresized($header2, $src_header, 0, 0, 0, 0, $header_w, $header_h, $src_header_arr[0], $src_header_arr[1]);
imagecopymerge($img, $header2, 0, 0, 0, 0, $header_w, $header_h, 100);

imagepng($img);
imagedestroy($img);
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