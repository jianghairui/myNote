<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2018/1/27
 * Time: 13:53
 */
date_default_timezone_set('PRC');

$db = array(
    'host'=>'127.0.0.1',
    'user'=>'root',
    'pwd'=>'1',
    'port'=>3306
);
$con = mysqli_connect($db['host'],$db['user'],$db['pwd']) or die('链接数据库失败');

function getResult($con='',$sql='') {
    $res = mysqli_query($con,$sql);
    $arr = [];
    while($row = mysqli_fetch_assoc($res)) {
        $arr[] = $row;
    }
    return $arr;
}

function recurDir($pathName)
{
    //将结果保存在result变量中
    $result = array();
    $temp = array();
    //判断传入的变量是否是目录
    if(!is_dir($pathName) || !is_readable($pathName)) {
        return null;
    }
    //取出目录中的文件和子目录名,使用scandir函数
    $allFiles = scandir($pathName);
    //遍历他们
    foreach($allFiles as $fileName) {
        //判断是否是.和..因为这两个东西神马也不是。。。
        if(in_array($fileName, array('.', '..'))) {
            continue;
        }
        //路径加文件名
        $fullName = $pathName.'/'.$fileName;
        //如果是目录的话就继续遍历这个目录
        if(is_dir($fullName)) {
            //将这个目录中的文件信息存入到数组中
            $result[$fullName] = recurDir($fullName);
        }else {
            //如果是文件就先存入临时变量
            $temp[] = $fullName;
        }
    }
    //取出文件
    if($temp) {
        foreach($temp as $f) {
            $result[] = $f;
        }
    }
    return $result;
}


function p($arr)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}