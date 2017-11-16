<?php
header("Content-Type:text/html;charset=utf8");
//魔术方法:2017-2-8
/*
__set(),__get(),__isset(),__unset()
1.自动调用，但不同的魔术方法，有自己的调用时机
2.方法名固定，都是以__开始。不写就不存在，没有默认功能。
__toString()
1.在直接使用echo print printf输出一个对象引用时，直接调用的方法
2.将对象的方法信息放在__toString()方法内部，形成字符串返回
3.不能有参数，必须返回字符串
*/
class Person
{
	public $name;
	public $sex;
	public $age;
	public $marr=array('aaa','bbb','ccc','run');

	function __construct($name='',$age=20,$sex='Male')
	{
		$this->name = $name;
		$this->sex = $sex;
		$this->age = $age;
	}

	function say(){
		echo "我的名字是{$this->name}，性别{$this->sex}，年龄{$this->age}。<br>";
	}

	function __toString(){
		return "Magic Input<br>";
	}

	function __clone(){
		$this->name = "克隆对象";
		$this->age = 30;
		$this->sex = "female";
	}

	function __call($method,$args){
		if(in_array($method,$this->marr)){
			echo $args[0].'<br>';
		}else{
			echo "名为{$method}()的方法不存在<br>";
		}
		// echo "参数为";
		// print_r($args);
		
	}

	static function __callStatic($method,$args){
		echo "调用的静态方法{$method}('".implode("','",$args)."')不存在<br>";
	}

	function __destruct(){
		echo "{$this->name}的析构，释放。<br>";
	}
}
//$p1 = new Person("Jiang",26,"Male");
// $p1->say();
// $p2 = clone $p1;
// $p2->name = "李四";
// $p2->say();
// $p1->run('parameter');
// $p1->play('Game');
Person::fuck("'a'","'b'","'c'");







/*
克隆对象:
__clone()魔术方法
1.克隆对象时自动调用的方法 ,对新克隆的对象进行初始化
2.这个方法中$this代表副本，所以能够初始化。

__call($method,$args)魔术方法
1.调用的方法不存在时自动调用的方法
2.两个参数，第一个参数为不存在的方法名，第二个参数为不存在的方法的参数（是数组类型）
3.使用环境：需求方法功能相似，但方法名不同。也可作提示用
*/

?>