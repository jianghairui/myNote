<?php
/*日期2017-2-9这是一个形状的抽象类;calculator:n,计算器；
定义子类必须实现的方法
*/
abstract class Shape{
//形状的名称
	public $name;
//形状的面积
	abstract function area();
//形状的周长
	abstract function perimeter();
//形状的图形表单界面
	abstract function view();
//图形的验证方法 
	abstract function check($arr);
} 


?>