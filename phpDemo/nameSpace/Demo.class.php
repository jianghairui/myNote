<?php
namespace DemoNameSpace;
class Demo{

	// public $tale;
	// public $story;
	// function __construct($tale='安徒生童话',$story='TylorSwift'){
	// 	$this->tale = $tale;
	// 	$this->story = $story;
	// 	echo "这里是Demo类文件，命名空间为::".__NAMESPACE__.'<br>';
	// }	
}
/**
* 
*/
class Story
{
	private $tale;
	private $story;
	function __construct($tale='安徒生童话',$story='TylorSwift')
	{
		$this->tale = $tale;
		$this->story = $story;
		echo "This is a sorrowful story!<br>";
	}
}


?>