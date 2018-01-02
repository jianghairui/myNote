<?php
header("Content-type:image/png");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
mb_internal_encoding("UTF-8");
$score = 90;
$nickname = '清流';
$avatar = './avatar.png';
$avatar_path = 'http://wx.qlogo.cn/mmopen/OzibWZOJxYlwe5TeiaC99sJeSNhZ0q3lLtqdiaiaZhYpxaBcbty0oXibE4WJ9dfiaTE7Fzlcu9VgKbHjlDoGqkVdacwwGt20xUZ6qb/132';
$str = '      ' . '一大堆文字';
$rank = 19;
$keep_days = 3;
$praise_times = 5;
$collect_count = 15;

$length = mb_strlen($str,"UTF-8");
if($length>100) {
    $str = mb_substr($str , 0, 100, "UTF-8") . '...';
}
// $str = mb_strimwidth($str , 0, 100, '...', "UTF-8");

$font = './PingFang-Regular.ttf';

//创建画布
$ban_width = 750;
$ban_height = 1206;
$img = imagecreatetruecolor($ban_width, $ban_height);
$white = imagecolorallocate($img, 255, 255,255);
imagefill($img, 0, 0, $white);

//添加背景图片
$src_header_path = './share.png';
$src_header = imagecreatefromstring(file_get_contents($src_header_path));
$src_header_arr = getimagesize($src_header_path);
$header_w = 750;
$header_h = 1206;
$header = imagecreatetruecolor($header_w, $header_h);
imagecopyresized($header, $src_header, 0, 0, 0, 0, $header_w, $header_h, $src_header_arr[0], $src_header_arr[1]);
imagecopymerge($img, $header, 0, 0, 0, 0, $header_w, $header_h, 100);


//处理文字
$content = autowrap(20, 0, $font, $str, 500);
//添加文字
$black = imagecolorallocate($img, 0, 0, 0);
imagettftext($img, 20, 0, 125, 240, $black, $font, $content);

$str0 = $score . '分';
$str1 = "您是慧加\"不吼娃亲子作业\"今日排行榜第".$rank."名";
$str2 = "您今天表扬了孩子".$praise_times."次";
$str3 = "慧加金句库收录了您".$collect_count."句表扬句型";
$str4 = "已经坚持不吼娃第".$keep_days."天";
$str5 = "陪作业，不吼娃，我是智慧的好爸妈";
$str6 = "长按去参加";

$b1 = imagettfbbox(40,0,$font,$str0);
$w1 = abs($b1[2] - $b1[0]);
$marginleft = (750 - $w1)/2;

imagettftext($img, 40, 0, $marginleft, 190, $black, $font, $str0);
imagettftext($img, 20, 0, 120, 750, $black, $font, $str1);
imagettftext($img, 20, 0, 120, 825, $black, $font, $str2);
imagettftext($img, 20, 0, 120, 890, $black, $font, $str3);
imagettftext($img, 24, 0, 50, 1120, $black, $font, $str4);
imagettftext($img, 20, 0, 50, 1160, $black, $font, $str5);
imagettftext($img, 16, 0, 595, 1110, $black, $font, $str6);

//添加头像
imagebackgroundmycard($avatar_path,$avatar,$img,50,950,100,100,50);
////添加昵称
imagettftext($img, 16, 0, 60, 1080, $black, $font, $nickname);
//添加二维码
$qrcode_path = './qrcode.png';
$newqrcode_path = './newqrcode.png';
imageresize($qrcode_path,$newqrcode_path,100,100);
$qrcode = imagecreatefromstring(file_get_contents($newqrcode_path));
imagecopymerge($img, $qrcode, 600, 980, 0, 0, 100, 100, 100);

imagepng($img);
imagedestroy($img);

function imagebackgroundmycard($avatar_path,$avatar ,$im, $dst_x, $dst_y, $image_w, $image_h, $radius) {
    $resource = imagecreatetruecolor($image_w, $image_h);
    $imghttp = get_headers($avatar_path,true);
    if($imghttp['Content-Type'] == "image/jpeg") {
        $source = imagecreatefromjpeg($avatar);
    }
    if($imghttp['Content-Type'] == "image/png") {
        $source = imagecreatefrompng($avatar);
    }
    if(!$source){
        $source  = imagecreatetruecolor(132, 132);
        $bg = imagecolorallocate($source, 0, 0, 0);
        imagefill($source, 0, 0, $bg);
        imagecopyresized($resource, $source, 0, 0, 0, 0, $image_w, $image_h, 132, 132);
    }else {
        $avatar_size = getimagesize($avatar);
        imagecopyresized($resource, $source, 0, 0, 0, 0, $image_w, $image_h, $avatar_size[0], $avatar_size[1]);
    }


    $lt_corner = get_lt_rounder_corner($radius, 255, 255, 255);//圆角的背景色
    imagecopymerge($resource, $lt_corner, 0, 0, 0, 0, $radius, $radius, 100);
    $lb_corner = imagerotate($lt_corner, 90, 0);
    imagecopymerge($resource, $lb_corner, 0, $image_h - $radius, 0, 0, $radius, $radius, 100);
    $rb_corner = imagerotate($lt_corner, 180, 0);
    imagecopymerge($resource, $rb_corner, $image_w - $radius, $image_h - $radius, 0, 0, $radius, $radius, 100);
    $rt_corner = imagerotate($lt_corner, 270, 0);
    imagecopymerge($resource, $rt_corner, $image_w - $radius, 0, 0, 0, $radius, $radius, 100);
    imagecopy($im, $resource, $dst_x, $dst_y, 0, 0, $image_w, $image_h);
}

function autowrap($fontsize, $angle, $fontface, $string, $width) {
// 这几个变量分别是 字体大小, 角度, 字体名称, 字符串, 预设宽度
    $content = "";
    // 将字符串拆分成一个个单字 保存到数组 letter 中
    for ($i=0;$i<mb_strlen($string);$i++) {
        $letter[] = mb_substr($string, $i, 1);
    }
    foreach ($letter as $l) {
        $teststr = $content." ".$l;
        $testbox = imagettfbbox($fontsize, $angle, $fontface, $teststr);
        // 判断拼接后的字符串是否超过预设的宽度
        if (($testbox[2] > $width) && ($content !== "")) {
            $content .= "\n";
        }
        $content .= $l;
    }
    return $content;
}

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

function get_lt_rounder_corner($radius, $color_r, $color_g, $color_b)
{
    $img = imagecreatetruecolor($radius, $radius);
    $bgcolor = imagecolorallocate($img, $color_r, $color_g, $color_b);
    $fgcolor = imagecolorallocate($img, 0, 0, 0);
    imagefill($img, 0, 0, $bgcolor);
    imagefilledarc($img, $radius, $radius, $radius * 2, $radius * 2, 180, 270, $fgcolor, IMG_ARC_PIE);
    imagecolortransparent($img, $fgcolor);
    return $img;
}
?>