<?php
$a = array('r'=>'red','b'=>'blue','c'=>'color');
$b = array('b'=>'black','w'=>'white','y'=>'yellow');
$c = array_merge($a,$b);
$d = $b + $a;
var_dump($d);
//array_merge 后面覆盖前面 + 前面覆盖后面
?>