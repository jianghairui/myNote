<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2018/10/13
 * Time: 16:29
 */
//redis数据入队操作
$redis = new Redis();
$redis->connect('127.0.0.1',6379);
for($i=0;$i<50;$i++){
    try{
        $redis->LPUSH('click',rand(1000,5000));
    }catch(Exception $e){
        echo $e->getMessage();
    }
}