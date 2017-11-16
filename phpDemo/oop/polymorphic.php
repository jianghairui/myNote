<?php
/**日期2017-2-9
多态特性：
1.程序扩展准备
技术：1.必须有继承关系，父类最好是接口或抽象类
*/
header("Content-Type:text/html;charset=utf8");
interface USB{
	const WIDTH = 12;
	const HEIGHT = 3;
	function load();
	function run();
	function alert();
}

class Computer{
	function useUSB(USB $usb){
		$usb->load();
		$usb->run();
		$usb->alert();
	}
}

class Mouse implements USB{
	function load(){
		echo "加载鼠标成功<br>";
	}
	function run(){
  		echo "鼠标运行中<br>";
	}
	function alert(){
		echo "鼠标USB已拔出<br>";
	}
}

class Keyboard implements USB{
	function load(){
		echo "加载键盘成功<br>";
	}
	function run(){
  		echo "键盘运行中<br>";
	}
	function alert(){
		echo "键盘USB已拔出<br>";
	}
}

class Worker{
	function uses(){
		$c = new Computer();
		$m = new Mouse();
		$c->useUSB($m);

		$k = new Keyboard();
		$c->useUSB($k);
	}
}
$p = new Worker();
$p->uses();



?>