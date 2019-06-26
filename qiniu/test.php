<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2019/6/25
 * Time: 21:10
 */
require  './autoload.php';
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
$accessKey = 'frItACjCKcfgAM965WcfDv3J8H8sQJNq9fvUQooB';
$secretKey = 'OJg8WtoT-cyGdhFyJUShzaRGRdPcbhwP4g_rE7xC';
$auth = new Auth($accessKey, $secretKey);
$bucket = 'jiagongbao';
// 生成上传Token
$token = $auth->uploadToken($bucket);

//exit($token);
// 构建 UploadManager 对象
//$uploadMgr = new UploadManager();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>七牛云上传DEMO</title>
</head>
<body>
    <form method="post" action="http://up.qiniup.com" enctype="multipart/form-data">
        <input name="token" type="hidden" value="<?php echo $token;?>">
        <input name="file" type="file" />
        <input type="submit" value="上传"/>
    </form>
</body>
</html>

