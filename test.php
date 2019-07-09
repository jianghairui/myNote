<?php
ini_set("max_execution_time", "3600");
ini_set("memory_limit","1024M");
//ob_implicit_flush(true);
//echo str_pad(" ", 256);


$list = getDir('./tpic');
foreach ($list as $k=>&$v) {
    if($k > 902) {
        if(substr($v,-3) !== 'jpg') {
            unset($list[$k]);
        }else {
            $imgdst = './tpic_done/' . $k . '.jpg';
            compressedImage($v,$imgdst);
            echo $imgdst . ' DONE<br>';
            usleep(1000);
        }
    }
}


//压缩图片
function compressedImage($imgsrc, $imgdst) {
    list($width, $height, $type) = getimagesize($imgsrc);

    $new_width = $width;//压缩后的图片宽
    $new_height = $height;//压缩后的图片高

    if($width >= 800){
        $per = 800 / $width;//计算比例
        $new_width = $width * $per;
        $new_height = $height * $per;
    }

    switch ($type) {
        case 2:
            header('Content-Type:image/jpeg');
            $image_wp = imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefromjpeg($imgsrc);
            imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            //90代表的是质量、压缩图片容量大小
            imagejpeg($image_wp, $imgdst, 90);
            imagedestroy($image_wp);
            imagedestroy($image);
            break;
        case 3:
            header('Content-Type:image/png');
            $image_wp = imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefrompng($imgsrc);
            imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            //90代表的是质量、压缩图片容量大小
            imagejpeg($image_wp, $imgdst, 90);
            imagedestroy($image_wp);
            imagedestroy($image);
            break;
    }
}
//
function p($Arr) {
    echo '<pre>';
    print_r($Arr);
    echo '</pre>';
}
//扫描目录
function searchDir($path,&$data){
    if(is_dir($path)){
        $dp=dir($path);
        while($file=$dp->read()){
            if($file!='.'&& $file!='..'){
                searchDir($path.'/'.$file,$data);
            }
        }
        $dp->close();
    }
    if(is_file($path)){
        $data[]=$path;
    }
}
//获取目录
function getDir($dir){
    $data=array();
    searchDir($dir,$data);
    return   $data;
}


?>
