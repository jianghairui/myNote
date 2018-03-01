<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2018/3/1
 * Time: 16:10
 */
session_start();
include '../../function.php';

//将SESSION会话数据清空
$_SESSION = [];
//彻底删除会话,删除会话本身
if(ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(),session_id(),time()-1,$params['path'],$params['domain'],$params['secure'],$params['httponly']);
}

session_destroy();
