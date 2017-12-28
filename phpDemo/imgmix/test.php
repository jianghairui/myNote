<?
header("Content-type: image/png");

//创建并载入一幅图像
$im = @imagecreatefromjpeg("images/flower_1.jpg");

//错误处理
if(!$im){
    $im  = imagecreatetruecolor(132, 132);
    $bg = imagecolorallocate($im, 255, 0, 0);
    imagefill($im, 0, 0, $bg);
}
?>
