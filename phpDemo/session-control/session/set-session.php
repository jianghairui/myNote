<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2018/3/1
 * Time: 13:04
 */
date_default_timezone_set('PRC');
header('Content-Type:text/html;charset=utf-8');
session_start();
$_SESSION['name'] = '姜海蕤';
$_SESSION['age'] = 27;
$_SESSION['gender'] = '男';
echo 'SESSION_NAME为:' . session_name() . '<br>';
echo 'SESSION_ID为:' . session_id() . '<br>';

setcookie(session_name(),session_id(),time()+3600*2);

