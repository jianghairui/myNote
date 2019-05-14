<?php
include "function.php";
date_default_timezone_set('PRC');
//header('Set-Cookie:username=jianghairui;expires=' . gmdate('D, d M Y H:i:s \G\M\T',time()+3600));
header('Content-Type:text/html;charset=utf-8');
//session_start();
//if(isset($_SESSION['views']))   {
//    $_SESSION['views']=$_SESSION['views'] + 1;
//}else {
//    $_SESSION['views']=1;
//}
//echo "Views=". $_SESSION['views'];
//session_destroy();
//unset($_SESSION['views']);

/*
 * setcookie("user", "Alex Porter", time()+3600);
 * echo $_COOKIE['user'];
 *
 *
 * */
//内存COOKIE,浏览器关闭cookie消失,默认当前路径有效
setcookie('userinfo[name]','jianhairui',strtotime('+7 days'));
setcookie('userinfo[age]',27,strtotime('+7 days'));
setcookie('userinfo[sex]','male',strtotime('+7 days'));

p($_COOKIE);
//硬盘cookie,1周后到期
//setcookie('age',27,time()+3600);
//硬盘cookie,全局路径有效
//setcookie('email','jianghairui@sina.cn',time()+24*3600*7,'/');
//只在https下生效
//setcookie('secure','secure',time()+24*3600*7,'/','',true);


/**
 * 1.什么是会话思想控制?
 *
 *
 *
 *
 * 2.HTTP浅析(无连接,无状态)
 *      客户端建立连接,客户端发送请求,服务端响应请求,客户端断开连接
 *      HTTP Request 和 HTTP Response
 */

























?>