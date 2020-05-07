<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2018/3/1
 * Time: 16:16
 */
include '../../function.php';
//ini_set('session.gc_maxlifetime', 10);
//ini_set('session.cookie_lifetime', 3600);
session_start();
//setcookie(session_name(),session_id(),time()+3600,'/');
//session_destroy();
p($_SESSION);
