<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2018/10/13
 * Time: 16:30
 */
//redis数据出队操作,从redis中将请求取出
$redis = new Redis();
$redis->pconnect('127.0.0.1',6379);
while(true){
    try{
        $value = $redis->LPOP('click');
        if(!$value){
            break;
        }
        var_dump($value)."\n";
        /*
        * 利用$value进行逻辑和数据处理
        */
    }catch(Exception $e){
        echo $e->getMessage();
    }
}