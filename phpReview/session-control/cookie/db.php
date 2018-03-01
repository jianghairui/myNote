<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2018/2/28
 * Time: 12:03
 */
error_reporting(E_ALL &~ E_NOTICE);
date_default_timezone_set('PRC');
$link = mysqli_connect('localhost','root','root') or die('Connect Error');
mysqli_set_charset($link,'utf8');
mysqli_select_db($link,'test') or die('database connect error');


function p($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}