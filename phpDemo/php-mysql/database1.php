<?php
//创建Mysql数据表
	header("Content-Type:text/html;charset=utf8");
	$link=mysql_connect('localhost','root','root');
	if(!$link){die("未连接数据库！".mysql_error());
	}
	echo "链接数据库成功！";
	mysql_select_db('mysql',$link) or die(mysql_error());
	// $sql="drop table article";删除表格
	$sql="CREATE TABLE bookss(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	bookname VARCHAR(50) NOT NULL,
	author VARCHAR(50) NOT NULL,
	price DOUBLE NOT NULL DEFAULT 0.00,
	detail TEXT,
	publishdate DATE
	-- PRIMARY KEY(id)
	)";
	$res=mysql_query('set names UTF8');
	$res=mysql_query($sql,$link);




//以下是数据表格增删改，表结构增删代码
	$sql="insert into book (``,``,``) vlaues ('','','')";//表头引号要么不加，要加就加``;
	$sql="update book set username='' where id='1' or id in('1','2','3') or id between '1' and '10'";
	$sql="delete * from book where id='1'";
	$sql="alter table book add age char(3)";
	$sql="alter table book drop column(可以不加，意思是纵队，列) age";



	if(mysql_affected_rows($link)>0){
		echo "操作成功！一共有".mysql_affected_rows($link)."行发生了变动。";
	}else{
		echo "没有影响到行数";
	}

?>