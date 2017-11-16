<?php
/*
常量，类，和函数不能重复定义，为了避免冲突需要用命名空间来解决。
*/
namespace myself;
header("Content-Type:text/html;charset=utf-8");
include "function.inc.php";

	//const FUCK = '我是namespace里的FUCK';	
	define('FUCK','我是namespace里的FUCK');

	function one(){
		echo "这是namespace里的one()方法<br>";
	}
	function two(){
		echo "这是namespace里的two()方法<br>";
	}
	one();
	two();
	echo FUCK.'<br>';

	\fuck\abc\shit\one();//      /意思调用全局
	\fuck\abc\shit\two();







?>