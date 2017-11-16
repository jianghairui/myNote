<?php
/*日期：2017-2-9
接口是一种特殊的抽象类
1.抽象类和接口中都有抽象方法
2.抽象类和接口都不能创建对象
接口和类的区别：
1.接口中必须全是抽象方法，所以方法不用加abstract区分
2.接口中成员属性必须全是！常量！
3.所有权限必须是public 
4.声明接口不使用class，而是使用interface 
接口使用细节：
1.可以让接口继承接口（只能扩展新抽象方法，没有覆盖关系）
2.可以使用一个类实现接口的全部方法，也可以使用一个抽象类，来实现接口的部分方法。
3.就不要使用extends,使用implements来实现；implements相当于extends。
extends继承（扩展），在PHP中一个类只能有一个父类。
4.一个类可以在继承另一个类的同时，可以用implements实现一个接口(一定要先继承再实现接口)
5.实现多个接口，只需用逗号隔开
*/
header("Content-Type:text/html;charset=utf8");

interface Port{
	const NAME = "姜海蕤";
	const AGE = 26;
	public function test1();
	public function test2();
	function test3();
}

interface Demo extends Port{
	function test4();  
}

class World{
	function test5(){

	}
} 
interface Abc{
	function test6();
}
//下面也可以加abstract
class Hello extends World implements Demo,Abc{

	function test1(){

	}
	function test2(){
		echo "辗转迂回的test2()终于输出了";
	}
	function test3(){

	}
	function test4(){

	}
	function test6(){

	}


}
$h = new Hello();
$h->test2();




?>