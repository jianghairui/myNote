<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/4
 * Time: 11:58
 */
//die('正在开发中:)');

include 'database.php';
if (empty($_GET['id'])){
    header('location:'.$weburl);
    die();
}
//$db->query('SELECT * FROM ');
if (strpos($_SERVER['HTTP_USER_AGENT'],'QQ/')){
    //QQ
    if(!$result = $db->query('SELECT `qqpay`,`nick` FROM `qr` WHERE `ID` = '.intval($_GET['id']))){
        header('location:'.$weburl);
        die();
    }
    if ($result->num_rows == 0){
        header('location:'.$weburl);
        die();
    }
    require_once 'lib/phpqrcode.php';
    $info = $result->fetch_array();
    ob_start();
    $r = QRencode::factory(QR_ECLEVEL_L,10,0);
    $r->encodePNG($info['qqpay']);
    $pic = ob_get_contents();
    ob_end_clean();
    header("Content-type: text/html; charset=utf-8");
    $base64 = base64_encode($pic);
    $nick = $info['nick'];
    include './sao/qq.inc.php';
    die();
}
if (strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')){
    //微信
    if(!$result = $db->query('SELECT `wxpay`,`nick` FROM `qr` WHERE `ID` = '.intval($_GET['id']))){
        header('location:'.$weburl);
        die();
    }
    if ($result->num_rows == 0){
        header('location:'.$weburl);
        die();
    }

    require_once 'lib/phpqrcode.php';
    $info = $result->fetch_array();

    ob_start();
    $r = QRencode::factory(QR_ECLEVEL_L,10,0);
    $r->encodePNG($info['wxpay']);
    $pic = ob_get_contents();
    ob_end_clean();
    header("Content-type: text/html; charset=utf-8");
    $base64 = base64_encode($pic);
    $nick = $info['nick'];
    include './sao/wechat.inc.php';
    die();
}
if (strpos($_SERVER['HTTP_USER_AGENT'],'AlipayClient')){
    //支付宝
    if(!$result = $db->query('SELECT `alired`,`alipay`,`nick` FROM `qr` WHERE `ID` = '.intval($_GET['id']))){
        header('location:'.$weburl);
        die();
    }
    if ($result->num_rows == 0){
        header('location:'.$weburl);
        die();
    }
    $info = $result->fetch_array();
    if (empty($info['alired'])){
        header('location:'.$info['alipay']);

    }
    $lifeTime = 24 * 3600;
    session_set_cookie_params($lifeTime);
    session_start();
    if (!empty($_SESSION['alipay']) && $_SESSION['alipay'] == date('d')){
        header('location:'.$info['alipay']);
    }
    $nick = $info['nick'];
    $pay = $info['alipay'];
    $red = $info['alired'];
    include './sao/alipay.inc.php';

    die();
}
header('location:'.$weburl);