<?php

$config['appid'] = '';
$config['appsceret'] = '';


/**
 * 1、获取微信用户信息，判断有没有code，有使用code换取access_token，没有去获取code。
 */
if(!isset($_GET['code'])) {
    $callback = $_SERVER['REQUEST_SCHEME'] . '://'.$_SERVER['HTTP_HOST'] . '/gzh.php';  //微信服务器回调url，这里是本页url
    get_code($callback);
}else {
    echo($_GET['code']);
    $code = $_GET['code'];
    $data = get_access_token($code);//获取网页授权access_token和用户openid
    $data_all = get_user_info($data['access_token'],$data['openid']);//获取微信用户信息
    /*保存用户信息到数据库并设置session*/
}

/**
 * 2、用户授权并获取code
 * @param string $callback 微信服务器回调链接url
 */
    function get_code($callback){
        $appid = config('appid');
        $scope = 'snsapi_userinfo';
        $state = md5(uniqid(rand(), true));//唯一ID标识符绝对不会重复
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . urlencode($callback) .  '&response_type=code&scope=' . $scope . '&state=' . $state . '#wechat_redirect';
        header("Location:".$url);exit;
    }

/**
 * 3、使用code换取access_token
 * @param string 用于换取access_token的code，微信提供
 * @return array access_token和用户openid数组
 */
    function get_access_token($code){
        $appid = config('appid');
        $appsecret = config('app_secret');
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $appsecret . '&code=' . $code . '&grant_type=authorization_code';
        $user = json_decode(file_get_contents($url));
        if (isset($user->errcode)) {
            $msg = $user->errcode . ' : ' . $user->errmsg;
            return $msg;
        }else {
            $data = json_decode(json_encode($user),true);//返回的json数组转换成array数组
            return $data;
        }
    }

/**
 * 4、使用access_token获取用户信息
 * @param string access_token
 * @param string 用户的openid
 * @return array 用户信息数组
 */
    function get_user_info($access_token,$openid){
        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $openid . '&lang=zh_CN';
        $user = json_decode(file_get_contents($url));
        if (isset($user->errcode)) {
    //            echo 'error:' . $user->errcode.'<hr>msg  :' . $user->errmsg;exit;
            return $user->errmsg;
        }
        $data = json_decode(json_encode($user),true);//返回的json数组转换成array数组
        return $data;
    }


