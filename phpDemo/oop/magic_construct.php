<?php

class Person
{
	private $name;
	var $sex;
	var $age;
	var $height;
	/*构造方法：
	对象创建完成以后第一个自动调用的方法。
	方法名可以与类名相同
	是给对象赋初值使用的
	魔术构造方法:两个下划线开头__construct(){}，优先于类名构造方法*/
	function __construct($name="Jiang",$age=20,$sex="男",$height="177cm")
	{
		$this->name = $name;
		$this->sex = $sex;
		$this->age = $age;
		$this->height = $height;
		echo $this->name."__构造方法<br>";
	}

	function say(){
		echo $this->name."说,我身高".$this->height."<br>";
	}
	/*析构方法：对象失去引用（被回收）前最后一个自动调用的方法，析构方法不带任何参数。
	作用比如：关闭文件，释放结果集，释放资源*/
	function __destruct(){
		echo $this->name."__析构方法<br>";
	}
}



?>