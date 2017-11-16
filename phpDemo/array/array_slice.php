<?php
/*
从一组数中选出最大的5位数字，
*/
//array_slice($arr,从哪开始,几位)，asort()以值升序排列，arsort()以值降序排列。
	header('Content-Type:text/html;charset=utf-8');
	$arr = array(-20,10,1,2,6,8,9,5,4,3,7,200,101,-500,110,103,152,192,168,225,255); 
	arsort($arr);
	$arrs = array_slice($arr,0,5);
	// foreach($b as $key=>$value){
	// 	echo $value.'<br>';
	// }
	echo '大小顺序 '.implode(' > ',$arrs).'<br>';
//array_merge()数组合并
	//$d=array_merge($arr1,$arr2,$arr3);
//array_rand()输出的是键名
	// $rand = array('a','b','c','d','e');
	// echo $rand[array_rand($rand)].'<br>';
//range('a','z',1)其中1为间隔
	// $range = range('a','z',1);
	// print_r($range);
//array_unique()删除重复元素
	// $a=array("A","A","B","B","C","C","C");
	// $b=array_unique($a);
//array_unshift()数组首位置插入元素，键名重新排序且从0开始递增
	// $a=array("a"=>"Cat","b"=>"Dog");
	// array_unshift($a,"Horse","Panda");
	// $b=array("c"=>"Bear","d"=>"Donkey");
	// print_r(array($a,$b));echo '<hr>';
//数组里添加元素array_push()
	// $array = array('a','b');
	// array_push($array,'a','b','c','d');
	// foreach($array as $key=>$value){
	// 	echo $key."=>".$value.'<br>';
	// }
//打乱数组，取几位元素
	// $a = range(1,10);//定义一个数组
	// shuffle($a);//shuffle打乱这个数组元素的顺序
	// $b = array_slice($a,0,3);//取数组中某一段。从键值0开始取10个元素。
	// print_r($b);//输出这个数组。
//array_pop();array_shift();（取尾，取头）array_value();给数组重新索引
	//索引数组和关联数组
?>