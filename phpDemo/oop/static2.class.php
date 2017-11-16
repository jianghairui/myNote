<?php
header("Content-Type:text/html;charset=utf8");
/*一个类只创建一个对象的方法,将构造方法private让类不能创建对象
php单态设计模式*/
class Person{

	static $obj = null;

	private function __construct(){

	}

	static function getObj(){
		//如果第一次调用，没有对象则创建一个。以后调用时，直接使用第一次调用的对象。
		if(is_null(self::$obj))
			self::$obj = new self;
		return self::$obj;

	}

	function __destruct(){
		echo "释放资源";
	}

	
}
$p = Person::getObj();


/*
类中常量用const 。
java中用final声明常量。
SEX='男'声明，不能用define声明，
常量用大写不能用$,常量访问方式和static相同，
一定要在在声明时赋值。
*/


?>