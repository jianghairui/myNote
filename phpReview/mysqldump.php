<?php
exec('mysqldump -uroot -proot test >> D:/test.sql',$log,$int);
//exec('ipconfig',$log,$int);
p($int);


function p($arr) {
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}
?>
