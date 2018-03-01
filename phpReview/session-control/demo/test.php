<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2018/3/1
 * Time: 20:09
 */
require_once 'CustomSession.class.php';
$CustomSession = new CustomSession();
ini_set('session.save_handler','user');
session_set_save_handler($CustomSession,true);
session_start();
$_SESSION['username'] = 'jianghairui';
$_SESSION['password'] = 'abcd1234';
$_SESSION['test'] = 'I AM A GOOD MAN';
$_SESSION['email'] = 'jianghairui@sina.cn';
//session_destroy();
//p($_SESSION);
