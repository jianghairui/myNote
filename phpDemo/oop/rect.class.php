<?php
/*

*/
include "shape.class.php";
error_reporting(E_ALL &~ E_NOTICE);
class Rect extends Shape{
	private $width;
	private $height;
	function __construct($arr){
		if(!empty($arr)){
			$this->width = $arr['width'];
			$this->height = $arr['height'];
			
		}
		$this->name = "矩形";
	} 

	function area(){
		return $this->width * $this->height;
	}
	function perimeter(){
		return ($this->width + $this->height)*2;
	}
	function view(){
		$form = "<form method='post' action='calculator.php?action=rect'>";
		$form.= "输入宽度：<input type='text' name='width' value='".$_POST['width']."' required><br>";
		$form.= "输入高度：<input type='text' name='height' value='".$_POST['height']."' required><br>";
		$form.= "<input type='submit' name='sub' value='计算'><br>";
		$form.= "</form>";
		echo $form;
	}
	function check($arr){
		if($arr['width']<0){
			echo $this->name."宽度不能为负<br>";
		}
		if($arr['height']<0){
			echo $this->name."高度不能为负<br>";
		}
		if(!is_numeric($arr['width'])){
			echo "你他妈告诉我这".$arr['width']."是多长<br>";
		}
		if(!is_numeric($arr['height'])){
			echo "你他妈告诉我这".$arr['height']."是多长<br>";
		}
		if($arr['width']<0|$arr['height']<0|!is_numeric($arr['width'])|!is_numeric($arr['height'])){
			return false;
		}else{
			return true;
		}
	}
}





?>