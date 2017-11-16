<?php
header("Content-Type:text/html;charset=utf8");
	$arr = array("name"=>"姜海蕤","sex"=>"Male","age"=>26);
/*
json格式可以跨语言
*/
//串行化
	$str = json_encode($arr);
//转化为对象
	// $decode = json_decode($str);
	//var_dump($decode);
	// echo $decode->name;

//参数true反串行化为数组 
	// $decode = json_decode($str,true);
	// echo '<hr>';
	// echo $decode['name'];

//eval可以检查并执行字符串,注：eval n.重新运算求出参数的内容 
	// $string = "echo '输出字符串';";
	// eval($string);
/*var_export()
__set_state()：使用var_export()，导出一个类的信息时自动调用的方法
*/
	// $a = array('a'=>'A','b'=>'B','c'=>'C');
	// var_dump($a);echo '<hr>';
	// $b = var_export($a,true);
	// var_dump($b.'<br>');
	// $c = eval("\$d = ".$b.';');
	// var_dump($d);
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
		echo "自动调用的__sleep()方法.<br>";
		return array("name");
	}
	function __wakeup(){
		echo "自动调用的__wakeup()方法.<br>";
	}

	static function __set_state($arr){
		$p = new Person('姜海蕤',30,'男');
		//print_r($arr);
		return $p;
		
	}

	function __invoke($a,$b,$c){
		echo "对象加括号如，\$p({$a}，{$b}，{$c})后自动调用的魔术方法。";
	}

}
$p = new Person('Jiang',18,'男');
// $p->name = '王浩';
// $p->age = 19;
// eval('$b='.var_export($p,true).';');
// var_dump($b);
$p('参数一','参数二','参数三');


?>