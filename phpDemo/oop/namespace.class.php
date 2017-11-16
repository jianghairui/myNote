<?php
header("Content-Type:text/html;charset=utf8");
function one(){
	echo "namespace.class里的one()<br>";
}

function two(){
	echo "namespace.class里的two()<br>";
}

class Person{
	static $name='小红';
	function __construct($name='小明'){
		self::$name = $name;
	}

	static function say(){
		echo "我的名字叫".self::$name;
	}
}
$p = new Person();
// Person::say();
// echo '<br>';
// $p->say();
// echo '<br>';
echo Person::$name;







?>