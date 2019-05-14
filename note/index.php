<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2019/5/9
 * Time: 14:25
 */
require_once './vendor/autoload.php';
require_once './vendor/QueryList.php';
use QL\QueryList;

$hj = QueryList::Query('https://blog.csdn.net/dsrpt17/article/details/89818556',array(
    "url"=>array('#content_views','html')
));
$data = $hj->getData(function($x){
    return $x['url'];
});

p($data);






function p($Arr) {
    echo '<pre>';
    print_r($Arr);
    echo '</pre>';
}
