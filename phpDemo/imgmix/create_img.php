<?php
function getPic()
{
    // 创建一块大白板
$info = $_GET['info'];
    $ban_width = 280;
    $ban_height = 280;
    $img = imagecreatetruecolor($ban_width, $ban_height);
    $white = imagecolorallocate($img, 255, 177, 45);
    imagefill($img, 0, 0, $white);



    /* 创建头像，缩放，切圆角 放大白板上 */
    $src_header_path = './peo1.png';
    $src_header = imagecreatefromstring(file_get_contents($src_header_path));
//    list($dst_w, $dst_h) = getimagesize($src_header_path);
    $src_header_arr = getimagesize($src_header_path);
    $header_w = 200;
    $header_h = 150;
    $header = imagecreatetruecolor($header_w, $header_h);
    imagecopyresized($header, $src_header, 0, 0, 0, 0, $header_w, $header_h, $src_header_arr[0], $src_header_arr[1]);
    imagecopymerge($img, $header, 40, 20, 0, 0, $header_w, $header_h, 100);

    $word_color = imagecolorallocate($img, 0, 0, 0);
    imagefttext($img, 12, 0 , 50, 200, $word_color, './PingFang-Regular.ttf', '韩驰给清流支付了0.01元'.$info);
    $word_color2 = imagecolorallocate($img, 0, 0, 0);
    imagefttext($img, 12, 0 , 50, 220, $word_color2, './PingFang-Regular.ttf', '');



    require_once './phpqrcode/qrlib.php';
    $qrcode_path = './qrcode.png';
    QRcode::png('http://www.taobao.com',$qrcode_path , 'L', 1);
    $qrcode = imagecreatefromstring(file_get_contents($qrcode_path));
    imagecopymerge($img, $qrcode, 200, 210, 0, 0, 66, 66, 80);

    header("Content-type:image/png");
    imagepng($img);
    imagedestroy($img);
    

}
getPic();


