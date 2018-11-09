<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/29
 * Time: 17:32
 */
use PHPZxing\PHPZxingDecoder;

header("Access-Control-Allow-Origin: *");
//ini_set('memory_limit','512M');
if ($_GET['mod'] === 'redget'){
    $lifeTime = 24 * 3600;

    session_set_cookie_params($lifeTime);
    session_start();
    $_SESSION['alipay'] = date('d');
    die();
}
if ($_GET['mod'] === 'QrDecode'){
    if (!in_array($_GET['c'],array('alipay','alired','qqpay','wxpay'))) die(json_encode(array('code'=>-1,'msg'=>'参数错误')));
    // php中的代码
    require __DIR__ . '/vendor/autoload.php';
    $config = array(
        'try_harder' => true, // 当不知道二维码的位置是设置为true
        'multiple_bar_codes' => false, // 当要识别多张二维码是设置为true
//    'crop' => '200,200,300,300', // 设置二维码的大概位置
    );

    $filename = $_FILES['file']['tmp_name'];
    $imagesize = getimagesize($filename);

    $width = $imagesize[0];
    $height = $imagesize[1];
    $newwidth = 500;
    imageresize($_FILES['file']['name'],$_FILES['file']['tmp_name'],$newwidth,$height*$newwidth/$width);

    $decoder        = new PHPZxingDecoder($config);
    $result    = current($decoder->decode($_FILES['file']['tmp_name'])); // 路径需要时绝对路径或相对路径，不能是url
    if (empty($result) || !$result){
        die(json_encode(array('code'=>-1,'msg'=>'二维码解析失败')));
    }
    switch ($_GET['c']) {
        case 'alipay':
            $qrcheck = 'https://qr.alipay.com';
            break;
        case 'alired':
            $qrcheck = 'https://qr.alipay.com';
            break;
        case 'qqpay':
            $qrcheck = 'https://i.qianbao.qq.com';
            break;
        case 'wxpay':
            $qrcheck = 'wxp://';
            break;
        default:
            die();
    }
    if (strtolower(mb_substr($result,0,strlen($qrcheck)))!=$qrcheck) {
        die(json_encode(array('code' => -2, 'msg' => '选择的二维码非指定平台')));
    }
    die(json_encode(array('code'=>1,'result'=>$result )));
}
if ($_GET['mod'] === 'payqr') {
    include "database.php";
    $postvalue = json_decode($_POST['c'], true);
    if (!empty($config['verification']['vid'])) {

        if (empty($postvalue['token'])) {
            die(json_encode(array('code' => -6, 'msg' => '请先完成人机验证')));
        }
        $postdata['id'] = $config['verification']['vid'];
        $postdata['secretkey'] = $config['verification']['key'];
        $postdata['token'] = $postvalue['token'];
        $postdata['ip'] = get_real_ip();
        $back = json_decode(curl_request('http://api.vaptcha.com/v2/validate', http_build_query($postdata)),true);
        if (empty($back['success']) || $back['success'] != '1'){
            die(json_encode(array('code' => -7, 'msg' => '人机验证失败，请重新验证'.json_encode($back))));
        }

    }
    if (empty($postvalue['alipay'])) {
        die(json_encode(array('code' => -1, 'msg' => '请先上传识别支付宝收款码')));
    }
    if (empty($postvalue['wxpay'])) {
        die(json_encode(array('code' => -2, 'msg' => '请先上传识别微信收款码')));
    }
    if (empty($postvalue['qqpay'])) {
        die(json_encode(array('code' => -3, 'msg' => '请先上传识别QQ钱包收款码')));
    }
    if (empty($postvalue['nick'])) {
        die(json_encode(array('code' => -4, 'msg' => '请输入收款人姓名或者昵称')));
    }
    if ($postvalue['template'] > 18 || $postvalue['template'] < 0) {
        die(json_encode(array('code' => -5, 'msg' => '模板选择异常')));

    }

    $postvalue['alipay'] = addslashes($postvalue['alipay']);
    $postvalue['alired'] = addslashes($postvalue['alired']);
    $postvalue['qqpay'] = addslashes($postvalue['qqpay']);
    $postvalue['wxpay'] = addslashes($postvalue['wxpay']);
    $postvalue['nick'] = addslashes($postvalue['nick']);
   if (!$db->query("INSERT INTO `qr` SET `alipay` = '{$postvalue['alipay']}', `alired` = '{$postvalue['alired']}', `qqpay` = '{$postvalue['qqpay']}', `wxpay` = '{$postvalue['wxpay']}', `nick` = '{$postvalue['nick']}', `time` = '{$time}', `ip` = '{$ip}'")){
        die(json_encode(array('code' => -8, 'msg' => 'MySQL Error: ('.$db->errno.') '.$db->error)));
    }
    require_once 'lib/phpqrcode.php';
    ob_start();
    if ($postvalue['template'] == '0'){
        $size = 20;

    }else{
        $size = ceil($config['template'][$postvalue['template']]['s']/25);
    }

    $r = QRencode::factory(QR_ECLEVEL_L,$size,0);
    $r->encodePNG($weburl.'/turn.php?id='.$db->insert_id);
    $pic = ob_get_contents();
    ob_end_clean();
    header("Content-type: text/html; charset=utf-8");
    if ($postvalue['template'] == 0)
        die(json_encode(array('code' => 1, 'msg' => 'ok', 'pic' => base64_encode($pic))));
    if (!file_exists('template/'.$postvalue['template'].'.jpg')){
        die(json_encode(array('code' => -9, 'msg' => '服务器中没有该模板')));
    }
    $qrimg =imagecreatefromstring($pic);
    list($width, $height) = getimagesizefromstring($pic);
    $temimg = imagecreatefromjpeg('template/'.$postvalue['template'].'.jpg');
    imagecopyresampled($temimg,$qrimg,$config['template'][$postvalue['template']]['x'],$config['template'][$postvalue['template']]['y'],0,0,$config['template'][$postvalue['template']]['s'],$config['template'][$postvalue['template']]['s'],$width,$height);
    ob_start();
    imagepng($temimg);
    $pic=ob_get_contents();
    ob_end_clean();


    die(json_encode(array('code' => 1, 'msg' => 'ok', 'pic' => base64_encode($pic))));

}

function unicode_decode($name){

    $json = '{"str":"'.$name.'"}';
    $arr = json_decode($json,true);
    if(empty($arr)) return '';
    return $arr['str'];
}



function p($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}


function imageresize($filename,$tmp_name,$newwidth,$newheight){

    if(!empty($tmp_name) && file_exists($tmp_name)){
        list($width, $height) = getimagesize($tmp_name);
        $thumb = imagecreatetruecolor($newwidth, $newheight);

        $suffix = strrchr($filename,'.');
        switch($suffix){
            case '.gif':
                $source = imagecreatefromgif($tmp_name);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagegif($thumb,$tmp_name);
                break;
            case '.png':
                $source = imagecreatefrompng($tmp_name);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagepng($thumb,$tmp_name);
                break;
            case '.jpg':
                $source = imagecreatefromjpeg($tmp_name);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagejpeg($thumb,$tmp_name);
                break;
            case '.bmp':
                $source = imagecreatefromwbmp($filename);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagewbmp($thumb,$tmp_name);
                break;
        }
        imagedestroy($thumb);
    }else {
        echo 'invalid image';
    }
}