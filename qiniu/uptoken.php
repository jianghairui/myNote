<?php

require_once './autoload.php';
use Qiniu\Auth;

$accessKey = config('qiniu_ak');
$secretKey = config('qiniu_sk');
$auth = new Auth($accessKey, $secretKey);
$bucket = config('qiniu_bucket');
$domain = config('qiniu_domain');

$suffix = $_POST['suffix'];

$filename = 'tmp/' . time() . $suffix;

$callbackBody = [
    'fname' => $filename,
    'fkey' => time(),
    'desc' => '文件描述'
];
$policy = [
    'callbackUrl' => 'http://j.jianghairui.com/callback.php',
    'callbackBody' => json_encode($callbackBody)
];

// 生成上传Token
$token = $auth->uploadToken($bucket,null,3600,$policy);

$data = [
    'token' => $token,
    'domain' => $domain,
    'imgUrl' => $filename
];

header('Access-Control-Allow-Origin: *');
exit(json_encode([
    'code' => 1,
    'data' => $data
]));







function config($key) {
    $config = [
        'qiniu_ak' => 'frItACjCKcfgAM965WcfDv3J8H8sQJNq9fvUQooB',
        'qiniu_sk' => 'OJg8WtoT-cyGdhFyJUShzaRGRdPcbhwP4g_rE7xC',
        'qiniu_bucket' => 'jiagongbao',
        'qiniu_domain' => 'qiniu.jiagongbao.net',
    ];
    return $config[$key];
}