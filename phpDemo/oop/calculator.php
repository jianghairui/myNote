<html>
<head>
	<title>图形计算器</title>
	<meta charset="utf8">
	<style type="text/css">
		.form{background:#eee;padding:20px;width:300px;margin:0 auto;margin-top:20px;}
		input{margin:5px;}
	</style>
</head>
<body>
	<center>
		<h1>简单的图形计算器</h1>
		<a href="?action=rect">矩形</a>||
		<a href="?action=triangle">三角形</a>||
		<a href="?action=circle">圆形</a>
	</center>
	<div class="form">
	<?php
	function __autoload($className){
		include strtolower($className).".class.php";
	}
	
//1.打开网页第一步：判断是否有$_GET['action'],如果没有继续2	
	if(empty($_GET['action'])){
		echo "请选择一个要计算的图形";
	}else{
/*2.点击href链接的GET到图形名字后用ucfirst首字母大写,然后创建一个对象，创建对象会自动调用__autoload()方法包含其对应的类文件，此时$shape对象里的参数$_POST为空数组。
*/
		$className = ucfirst($_GET['action']);
		$shape = new $className($_POST);
//3.调用对象的图形view()方法，点击计算按钮后刷新页面再从1.2.3.再开始，此时$_POST数组不为空，进行第4步。
		$shape->view();
//4.调用check()方法检验长宽是否合法，合法就输出area()和perimeter()。
		if(isset($_POST['sub'])){
			if($shape->check($_POST)==true){
				echo $shape->name."的面积为".$shape->area().'<br>';
				echo $shape->name."的周长为".$shape->perimeter();
			}
			
		}
	}
	?>
	</div>
</body>
</html>