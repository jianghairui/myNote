<?php
header('Content-Type:text/html;charset=utf-8');
date_default_timezone_set('PRC');

//ini_set('session.gc_maxlifetime', 15);
ini_set('session.cookie_lifetime', 15);

session_start();

function p($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}