<?php
/**2017-2-9
*
1.抽象方法：定义  一个方法没有方法体，不使用{}直接用分号结束。必须使用abstract关键字来修饰方法
2.抽象类：一个类中如果有一个方法为抽象方法，这个类就是抽象类。如果声明一个抽象类，则必须使用abstract关键字来修饰
注意：
1.抽象类不能实例化对象
2.抽象类必须写子类，将抽象类中的抽象方法覆盖（加上方法体）。
3.子类必须全部实现抽象方法，这个子类才能创建对象，否则还有抽象方法，这个子类还是抽象类。
抽象方法作用：规定子类必须有这个方法的实现，功能交给子类，只写出结构，而实现交给子类。
抽象类作用：要求子类的结构，就相当于一个规范；
*/
header("Content-Type:text/html;charset=utf8");
abstract class Person
{
	public $name;
	public $sex;
	public $age;

	abstract function abs();
	abstract function bbs();

	function run(){
		echo "抽象类的正常run()方法";
	}
	
}

class StudentCn extends Person{

	function abs(){
		echo "我是中国人，我说中文。<br>";
	}

	function bbs(){
		echo "我用筷子吃饭<br>";
	}
}

class StudentEn extends Person{
	function abs(){
		echo "I am English,I speak English.<br>";
	}
	function bbs(){
		echo "I eat by knives and forks";
	}
}

$p1 = new StudentEn();
$p1->abs();
$p1->bbs();




?>