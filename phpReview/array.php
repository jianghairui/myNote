<?php
/**
 * 数组合并相加
 */
$a = array('r'=>'red','b'=>'blue','c'=>'color');
$b = array('b'=>'black','w'=>'white','y'=>'yellow');
$c = array_merge($a,$b);//后面的重复元素覆盖前面的元素
$d = $a + $b;//只加入前面数组内没有的元素
var_dump($d);
//array_merge 后面覆盖前面 + 前面覆盖后面
?>