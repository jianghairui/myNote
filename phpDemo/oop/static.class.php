<?php
header("Content-Type:text/html;charset=utf8");
/*
static 可以修饰属性，方法，不能修饰类
1.使用static 修饰成员属性，并在内存的初始化表态段
2.可以被所有同一个类的对象共用
3.第一个用到类（类名第一次出现），类在加载到内存时，就已经将静态的成员加载到内存。
对象->成员
类::成员
4.静态成员一定要用类来访问
5.类中使用self访问自己成员 相当于 $this
6.静态成员一旦加载，只有脚本结束才释放
7.在静态方法中是不能访问非静态成员的（即不能使用$this）
8.能使用静态环境下的声明方法，尽量使用静态方法（效率高）
*/
class Person{
	public $name;
	public $sex;
	public $age;
	static $country = "China";
	function __construct($name="J",$sex="Male",$age=18){
		$this->name = $name;
		$this->sex = $sex;
		$this->age = $age;
	}
	static function say(){
		echo "我的国家是".self::$country."<br>";
	}


}
Person::say();
$p = new Person();
echo "性别{$p->sex}<br>";

?>