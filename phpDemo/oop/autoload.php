<?php
header("Content-Type:text/html;charset=utf8");
/*
只要在这个脚本中，需要加载类的时候才会调用这个方法__autoload(),不会重复调用
是定义在类外面的方法
*/
	// function __autoload($className){
	// 	include strtolower($className).".class.php";
	// } 
	// $t = new One();
	// $t->say();
	// $d = new Two();
	// $d->say();
//静态方法调用	
	//Three::say();

class Person{
	public $name;
	private $sex;
	private $age;
	function __construct($name='?',$sex='?',$age='?'){
		$this->name = $name;
		$this->age = $age;
		$this->sex = $sex;
	}
	function say(){
		echo $this->name."说，我的年龄是".$this->age."<br>".$this->fuck();
	}

	private function fuck(){
		return "我已经成年了<br>";
	}

	function __call($method,$args){
		echo "名为{$method}('".implode("','",$args)."')的方法不存在<br>";
	}
}
$p = new Person("Jiang","Male",26);
$p->say();
echo $p->fuck("法","克","油");







?>