<?php
/*
命名空间：namespace必须在文件第一行
只有类class{}，常量const，函数function()不能重复定义，可以用命名空间解决命名冲突问题。
命名空间用\反斜杠链接空间名。*/
//声明一个名字空间，前缀为space
/*同一文件定义多个名字空间，以最后一个为主。
同一文件不适合命名多个空间，但是语法支持可以用namespace xxx{}命名 namespace默认全局 */
namespace space;
header("Content-Type:text/html;charset=utf8");

include "namespace.class.php";
function var_dump($int){
	echo 'var_dump()方法输出的'.$int;
}
var_dump(100);echo '<br>';
\var_dump(100);echo '<br>';

function one($a){
	echo "namespace{$a}里的one()<br>";
}

function two($b){
	echo "namespace{$b}里的two()<br>";
}
one('');
two('');
\one();
\two();
\space\one("绝对路径");
\space\two("相对路径");










?>