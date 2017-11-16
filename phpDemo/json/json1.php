<?php
header('Content-Type:text/html;charset=utf8');

//json_decode()对 JSON 格式的字符串进行编码
	$json  =  '{"a":"姜海蕤","b":"男","c":"密码","d":4,"e":5}' ;//键和值必须用双引号
	echo $json.'<br>';
	$obj = json_decode ( $json );//对象

	echo $obj->c.'<br>';

	$array = json_decode($json,true);//数组
	echo '<pre>';print_r($array);echo '</pre>';

//json_encode()对JSON




?>