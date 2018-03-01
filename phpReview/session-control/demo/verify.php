<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2018/3/1
 * Time: 16:39
 */
//随机字体颜色
function randColor($image) {
    return imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
}

/**
 * @param $width 图片宽度
 * @param $height 图片高度
 * @param $type 类型0:纯数字,1:纯字母,2:字母数字混合
 * @param $length 验证码长度
 * @param $fontsize 验证码字体
 * @return string 返回验证码
 */
function generateVerify($width,$height,$type,$length,$fontsize) {
    $image = imagecreatetruecolor($width,$height);
    $white = imagecolorallocate($image,255,255,255);
    imagefilledrectangle($image,0,0,$width,$height,$white);
    switch($type) {
        case 0:
            $str = join('',array_rand(range(0,9),$length));
            break;
        case 1:
            $str = join('',array_rand(array_flip(array_merge(range('a','z'),range('A','Z'))),$length));
            break;
        case 2:
            $str = join('',array_rand(array_flip(array_merge(range('a','z'),range('A','Z'),range(0,9))),$length));
            break;
    }
    for($i=0;$i<$length;$i++) {
        imagettftext($image,$fontsize,mt_rand(-30,30),$i*($width/$length)+5,mt_rand(($height/2)+($fontsize/2),($height/2)+($fontsize/2)),randColor($image),'./PingFang-Regular.ttf',$str[$i]);
    }
    //添加像素点
    for ($i=1;$i<=100;$i++) {
        imagesetpixel($image,mt_rand(0,$width),mt_rand(0,$height),randColor($image));
    }
    header('Content-Type:image/png');
    imagepng($image);
    imagedestroy($image);
    return $str;
}

generateVerify(200,50,2,4,24);

