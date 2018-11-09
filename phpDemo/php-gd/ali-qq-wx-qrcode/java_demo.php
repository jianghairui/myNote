<?php
// php中的代码
require __DIR__ . '/vendor/autoload.php';
use PHPZxing\PHPZxingDecoder;



$config = array(
    'try_harder' => true, // 当不知道二维码的位置是设置为true
    'multiple_bar_codes' => false, // 当要识别多张二维码是设置为true
//    'crop' => '200,200,300,300', // 设置二维码的大概位置
);

$decoder        = new PHPZxingDecoder($config);
//$decoder->setJavaPath('/your/path/to/java');  //设置jdk的安装路径，该扩展是居于java的，所以需要jdk。如果设置了jdk的环境变量则无需设置

$decodedData    = current($decoder->decode('./red.png')); // 路径需要时绝对路径或相对路径，不能是url
p($decodedData);

function p($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
