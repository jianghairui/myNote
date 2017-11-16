<?php
header("Content-Type:text/html;charset=utf8");
/*对象串行化
1.将对象转化为字符串(不用看懂)————串行化
2.将串行化的字符串转回对象；————反串行化
注意串行化的时机：
1.将对象在网络上传输
2.将对象持久保存
__sleep()串行化时自动调用的魔术方法
作用：可以设置需要串行化的对象属性，将在方法中返回一个数组。默认全部成员属性串行化
__wakeup()反串行化时自动调用的魔术方法
作用：
*/
class Person
{
	public $name;
	public $sex;
	public $age;
	function __construct($name='',$age=20,$sex='Male')
	{
		$this->name = $name;
		$this->sex = $sex;
		$this->age = $age;
	}

	function say(){
		echo "我的名字是{$this->name}，性别{$this->sex}，年龄{$this->age}。<br>";
	}

	function __sleep(){
		echo "将对象串行化时自动调用的__sleep()方法.<br>";
		return array("name");
	}
	function __wakeup(){
		echo "对象反串行化时自动调用的__wakeup()方法.<br>";
	}

}


?>