<?php
/*
当前文件的文件名为根目录。用绝对地址\表示。
namespace后面为根目录下的子目录。
include包含的是其他文件里的代码，根目录没有变化都是\

连续定义多个名字空间，以最后一个为主。下面的代码会覆盖上面。
单个文件不建议命名多个空间，非要这样写，就用大括号namespace xxx{}namespace yyy{}
*/
namespace yourself;
header('Content-Type:text/html;charset=utf-8');
include "function.inc.php";
{	

	class Demo{
		const SHIT = 'OH,ho,This my shit!';
		static function one(){
			echo "这是one()方法<br>";
		}

	}

	

	function test(){
		echo "这是youself里的test()方法<br>";
	}

	echo Demo::SHIT.'<br>';
	test();
	\yourself\test();
	\fuck\abc\shit\test();
	namespace\test();
	echo '<hr style="margin-right:50%;">';
		
}

namespace yourself\ass\hole;

{
	function test(){
		echo "这是ass\hole里的test()方法<br>";
	}

	\yourself\ass\hole\test();
	echo '<hr style="margin-right:50%;">';
}

namespace bastard;

{
	\yourself\ass\hole\test();
	echo \yourself\Demo::SHIT.'<br>';
	\fuck\abc\shit\test();
}





?>