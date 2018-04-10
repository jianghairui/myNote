<?php
header('Content-Type:text/html;charset=utf8');
	date_default_timezone_set('PRC');
	// $time=explode(' ',microtime());
	// echo ($time[1] + $time[0]).'<br>';       	

	// echo microtime(true);

// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';
	
	//echo 'Hello world!';
	echo '现在时间戳和日期<hr>';
	echo strtotime(date('Y-m-d H:i:s'));echo '<br>';//现在时间戳
	echo date('Y-m-d H:i:s').'<br>';//当前日期
	echo '<br>';
	echo '30天前时间戳和日期<hr>';
	echo strtotime(date('Y-m-d H:i:s',strtotime('-30 days')));echo '<br>';//30天前时间戳
	echo date('Y-m-d H:i:s',strtotime('-30 days')).'<br>';//30天前日期
	echo '<br>';
	echo date('Y-m-d 08:00:01',strtotime('-30 days'));


?>