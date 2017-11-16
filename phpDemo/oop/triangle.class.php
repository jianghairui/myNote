<?php
/*日期2017-2-10，基于shape.class.php抽象类的扩展图形——三角形*/
include "shape.class.php";
error_reporting(E_ALL &~ E_NOTICE);
class Triangle extends Shape{
	public $side1;
	public $side2;
	public $side3;

	function __construct($arr){
		if(!empty($arr)){
			$this->side1 = $arr['side1'];
			$this->side2 = $arr['side2'];
			$this->side3 = $arr['side3'];
		}
		$this->name = "三角形";
	}

	function area(){
		$s = 0.5*($this->side1 + $this->side2 + $this->side3);
		return sqrt($s*($s-$this->side1)*($s-$this->side2)*($s-$this->side3)); 
	}

	function perimeter(){
		return $this->side1 + $this->side2 + $this->side3;
	}

	function view(){
		$form = "<form method='post' action='?action=triangle'>";
		$form.= "输入第一边长度：<input type='text' name='side1' value='".$_POST['side1']."' required><br>";
		$form.= "输入第二边长度：<input type='text' name='side2' value='".$_POST['side2']."' required><br>";
		$form.= "输入第三边长度：<input type='text' name='side3' value='".$_POST['side3']."' required><br>";
		$form.= "<input type='submit' name='sub' value='计算'><br>";
		echo $form;
	}

	function check($arr){
		if(!is_numeric($arr['side1'])|!is_numeric($arr['side2'])|!is_numeric($arr['side3'])){
			echo "边长不能为非数字<br>";
			return false;
		}
		if($arr['side1']<0|$arr['side2']<0|$arr['side3']<0){
			echo "边长不能为负数<br>";
			return false;
		}
		if(($arr['side1']+$arr['side2'])<$arr['side3']|($arr['side1']+$arr['side3'])<$arr['side2']|($arr['side3']+$arr['side2'])<$arr['side1']){
			echo "两边之和小于第三边";
			return false;
		}
		return true;
	}




}





?>