<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2018/9/27
 * Time: 18:14
 */
ini_set('session.gc_maxlifetime', 10);
ini_set('session.cookie_lifetime', 3600);
include '../../function.php';

session_start();
$_SESSION['username'] = 'Jianghairui';
$_SESSION['age'] = '27';


p($_SESSION);
p('设置成功');
echo 'SESSION_NAME为:' . session_name() . '<br>';
echo 'SESSION_ID为:' . session_id() . '<br>';
p(ini_get('session.cookie_lifetime'));

