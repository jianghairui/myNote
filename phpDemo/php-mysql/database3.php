<?php
header('Content-Type:text/html;charset=utf8');
	//error_reporting(E_ALL & ~E_NOTICE);
	$link = mysql_connect('localhost','root','shit') or die('连接数据库失败');
	mysql_select_db('test');
	
	//echo mysql_get_client_info().'<br>';

/*数据库执行语句分为两种，1.没有结果的返回布尔值真或假。DML,DCL,DDL 
例如：create,insert,update,delete
2.有结果的返回资源，需要处理资源，从结果集中取出并格式化处理
例如：select
*/
	//$sql = "insert into fenshu (name,class,score) values ('{$_GET['name']}','{$_GET['class']}','{$_GET['score']}')";
	//mysql_query('set names utf8');这句能不用尽量不用。
	//$sql = "insert into fenshu (name,class,score) values ('诸葛亮','天才班','100')";
	//$sql = "insert into web (name,url,top,country) values ('百度','www.baidu.com','50','CN')";
	$sql = "select site_id,name,url,top,country from web order by site_id";
	$result = mysql_query($sql,$link);
	// if($result){
	// 	echo "操作数据成功！<br>";
	// }else{
	// 	echo "操作数据失败!".mysql_error();
	// }
	echo 'SQL语句：'.ucfirst($sql).';<br>';

	// while($row = mysql_fetch_assoc($result)){
	// 	foreach($row as $key=>$value){
	// 		echo '<label style="display:inline-flex;width:60px;">'.$key.'</label>=> '.$value.'<br>';
	// 	}
	// }

	echo "<table border='1px' width='600px'><tr>";
	//获取字段信息（一般不用，因为效率太低）
	for($i=0;$i<mysql_num_fields($result);$i++){
		echo "<th>".mysql_field_name($result,$i)."</th>";
	}
	echo "</tr>";
	//获取表格内容信息
	// while ($arr = mysql_fetch_assoc($result)){
	// 	echo '<tr>';
	// 	foreach($arr as $col){
	// 		echo '<td>'.$col.'</td>';
	// 	}
	// 	echo '</tr>';
	// }
	while (list($id,$name,$url,$top,$country) = mysql_fetch_row($result)){
		echo '<tr>';
			echo '<td>'.$id.'</td>';
			echo '<td>'.$name.'</td>';
			echo '<td>'.$url.'</td>';
			echo '<td>'.$top.'</td>';
			echo '<td>'.$country.'</td>';
		echo '</tr>';
	}


echo '</table><br>这个表一共有'.mysql_num_rows($result).'条数据<br>';
//返回表格数据行数
	
	











/*
	mysql_fetch_row($result);索引数组
	mysql_fetch_assoc($result);关联数组
	mysql_fetch_array($result,MYSQL_NUM);索引数组和关联数组的组合（MYSQL_ASSOC关联,MYSQL_NUM索引,MYSQL_BOTH默认都返回）不建议使用，浪费系统资源
	mysql_fetch_object($result);返回一个对象（不建议使用）
	1.默认指针指向第一条（可以用mysql_data_seek()来指定第几行）
	2.获取第一条后，再使用此函数，指针会自动下移。如果已经获取最后一条，再获取返回假。
*/



	
































//mysql_close($link);




	// $a = "<form method='post' action='' style='margin:0 auto;width:400px;background:#eee;padding:20px;border-radius:5px;text-align:center;'>
	// 账号：<input style='margin:5px' type='text' name='admin' value=''><br>
	// 密码：<input style='margin:5px' type='password' name='admin' value=''><br>
	// <input type='submit' name='sub'>
	// </form>";
	// echo $a;

	// $b = '1+1';
	// $b.= '是=';
	// $b.= '2的充分不必要条件';
	// echo $b;

	//echo "<script type='text/javascript'>alert('Link Database Successful')</script>";





?>