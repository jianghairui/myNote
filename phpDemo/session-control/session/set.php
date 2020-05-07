<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2018/3/1
 * Time: 13:04
 */
include './config.php';

$_SESSION['name'] = '姜海蕤';
$_SESSION['age'] = 27;
$_SESSION['gender'] = '男';
$_SESSION['datetime'] = date('Y-m-d H:i:s');

echo 'SESSION_NAME为: ' . session_name() . '<br>';
echo 'SESSION_ID为: ' . session_id() . '<br>';

//setcookie(session_name(),session_id(),time()+3600*24);

