<?php
/*日期：2017-2-10
图形计算器圆形类
*/
include "shape.class.php";
error_reporting(E_ALL &~ E_NOTICE);
class Circle extends Shape{
	public $radius;
	function __construct($arr){
		if(!empty($arr)){
			$this->radius = $arr['radius'];
		}
		$this->name = "圆形";
	}

	function area(){
		//return $this->radius*$this->radius*PI();
		return pow($this->radius,2)*PI();
	}

	function perimeter(){
		return $this->radius*PI()*2;
	}

	function view(){
		$form = "<form method='post' action='?action=circle'>";
		$form.= "输入圆形半径<input type='text' name='radius' value='".$_POST['radius']."' required><br>";
		$form.= "<input type='submit' name='sub' value='计算'><br>";
		$form.= "</form>";
		echo $form;
	}

	function check($arr){
		if($arr['radius']<0){
			echo "圆形的半径不能为负<br>";
			return false;
		}elseif(!is_numeric($arr['radius'])){
			echo "你他妈告诉我这".$arr['radius']."是多长<br>";
			return false;
		}else{
			return true;
		}
	}




}




?>