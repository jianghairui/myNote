<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/28
 * Time: 22:10
 */

session_start();
date_default_timezone_set('Asia/Shanghai');
include 'config.php';
header("Content-type: text/html; charset=utf-8");
//过滤xss代码
foreach ($_POST as $key=>$value){

    $_POST[$key] = xss_clean($value);

}
foreach ($_GET as $key=>$value){
    $_GET[$key] = xss_clean($value);
}
foreach ($_COOKIE as $key=>$value){
    $_COOKIE[$key] = xss_clean($value);
}
foreach ($_REQUEST as $key=>$value){
    $_REQUEST[$key] = xss_clean($value);
}
$db = new mysqli($config['database']['host'],$config['database']['user'],$config['database']['pass'],$config['database']['name'],$config['database']['port']);
if ($db->errno){
    die('MySQL Connect Error: ('.$db->connect_errno.') '.$db->connect_error);
}
$db->query('set names utf8');
$runtime['nav'] = '';
foreach ($config['nav'] as $n => $v){
    $runtime['nav'] .= '<dd><a href="'.$v.'">'.$n.'</a></dd>';
}

/*
 * 获取用户的真实IP
 */
function get_real_ip()
{
    $ip=false;
    if(!empty($_SERVER["HTTP_CLIENT_IP"]))
    {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
        if ($ip)
        {
            array_unshift($ips, $ip); $ip = FALSE;
        }
        for ($i = 0; $i < count($ips); $i++)
        {
            if (@!preg_match ("^(10|172\.16|192\.168)\.", $ips[$i]))
            {
                $ip = $ips[$i];
                break;
            }
        }
    }
    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}

/*
 * 将时间戳转换为北京标准时间，如果时间戳为空则是取当前时间
 */
function Get_Date($time = ''){
    if (empty($time)){
        $time = time();
    }
    if(!is_numeric($time)){
        return $time;
    }
    return date('Y-m-d H:i:s', $time);
}

/*
 * 随机字符生成
 */
function rand_str($length,$p='all'){
    $yznums = '0123456789';
    $lowers = 'abcdefghijklmnopqrstuvwxyz';
    $uppers = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if ($p == 'all') {
        $src = $yznums.$lowers.$uppers;
    } else {
        $src = '';
        if (strpos($p, 'num') !== false)
            $src .= $yznums;
        if (strpos($p, 'lower') !== false)
            $src .= $lowers;
        if (strpos($p, 'upper') !== false)
            $src .= $uppers;
    }
    return $src? substr(str_shuffle($src), 0, $length) : $src;
}
/**
 * XSS暴力过滤神器，防止xss攻击
 */
function xss_clean($data){
    // Fix &entity\n;
    $data=str_replace(array('&amp;','&lt;','&gt;'),array('&amp;amp;','&amp;lt;','&amp;gt;'),$data);
    $data=preg_replace('/(&#*\w+)[\x00-\x20]+;/u','$1;',$data);
    $data=preg_replace('/(&#x*[0-9A-F]+);*/iu','$1;',$data);
    $data=html_entity_decode($data,ENT_COMPAT,'UTF-8');
    // Remove any attribute starting with "on" or xmlns
    $data=preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu','$1>',$data);
    // Remove javascript: and vbscript: protocols
    $data=preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu','$1=$2nojavascript...',$data);
    $data=preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu','$1=$2novbscript...',$data);
    $data=preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u','$1=$2nomozbinding...',$data);
    // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
    $data=preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i','$1>',$data);
    $data=preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i','$1>',$data);
    $data=preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu','$1>',$data);
    // Remove namespaced elements (we do not need them)
    $data=preg_replace('#</*\w+:\w[^>]*+>#i','',$data);
    // http://www.111cn.net/
    do{// Remove really unwanted tags
        $old_data=$data;
        $data=preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i','',$data);
    }while($old_data!==$data);
    // we are done...
    return $data;
}

/**
 * 使用CURL进行HTTP请求
 * 参数1：访问的URL，
 * 参数2：post数据(不填则为GET)，
 * 参数3：提交的$cookies,
 * 参数4：是否返回$cookies
 */
function curl_request($url,$post='',$cookie='', $returnCookie=0){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
    if($post) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    }
    if($cookie) {
        curl_setopt($curl, CURLOPT_COOKIE, $cookie);
    }
    curl_setopt($curl, CURLOPT_HEADER, $returnCookie);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    if (curl_errno($curl)) {
        return '';
    }
    curl_close($curl);
    if($returnCookie){
        list($header, $body) = explode("\r\n\r\n", $data, 2);
        preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
        $info['cookie']  = substr($matches[1][0], 1);
        $info['content'] = $body;
        return $info;
    }else{
        return $data;
    }
}


$ip = get_real_ip();
$time = time();
$weburl = dirname($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]);


