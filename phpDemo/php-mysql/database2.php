<?php
header("Content-Type:text/html;charset=utf8");


/*平年闰年算法
	for($i=1890;$i<=2016;$i++){
		if($i%400==0|($i%100!=0&&$i%4==0)){
			echo $i.'<br>';
		}
	}*/

//!!!!新知识，，，，拼接字符串！！！！
	$con = mysql_connect('localhost','root','root');
	mysql_select_db('mysql');
//一条SQL语句插入多条数据。	
	// for($i=1;$i<=2000;$i++){
	// 	if($i==1){
	// 		$sql = "insert into test (admin,password) values ('jiang".$i."','".$i."')";
	// 	}else{
	// 		$sql.=",('jiang".$i."','".$i."')";
	// 	}
	// }
	// mysql_query($sql,$con);

	// if(mysql_affected_rows($con)>0){
	// 	echo "一共有".mysql_affected_rows($con)."行发生了变化";
	// }else{
	// 	echo "数据没有变化";
	// }

 //查看数据表数据条数
	$sql = "select count(*) from test";
	$res = mysql_query($sql,$con);
	$row = mysql_fetch_row($res);
	echo "test表一共有".$row[0]."条数据";
	
	
	



?>