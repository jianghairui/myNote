<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2018/3/22
 * Time: 11:12
 */
$link1 = 'http://blog.csdn.net/paulluo0739/article/details/17711851';
$link2 = 'http://blog.csdn.net/chentaoxie/article/details/52425531';

$server = $_SERVER;

//GitHub is NOT OK!
//20180802 DALAS SSSERVER IS OK

$arr = array('a'=>'A','b'=>'B','c'=>'C');
$arrs = array();



function multi_upload($arr) {
    foreach ($arr as $k=>$v) {
        return $v;
    }

}

var_dump(serialize($arrs));