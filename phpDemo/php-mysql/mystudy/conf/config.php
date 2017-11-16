<?php                                               
mysql_connect('localhost','root','root') or die('连接数据库失败');
mysql_select_db('test') or die(mysql_error());
mysql_query('set names utf8');
?>