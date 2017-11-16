<?php
include "header.php";
include "./class/page.class.php";
	echo "<h3>图书列表</h3>";
	// if(isset($_GET['action'])&&$_GET['action']=='del'){
	// 	$sql = "delete from bookstore where bookid='".$_GET['bookid']."'";
	// 	mysql_query($sql);
	// 	if(mysql_affected_rows()>0){
	// 		echo "删除成功";
	// 	}else{
	// 		echo "删除失败".mysql_error();
	// 	}
	// 	echo "<br>".$sql;
	// }

	// if(isset($_POST['sub'])){
	// 	$sql = "delete from bookstore where bookid in (".implode(',',$_POST['id']).")";
	// 	mysql_query($sql);
	// 	if(mysql_affected_rows()>0){
	// 		echo "删除成功,影响了".mysql_affected_rows()."条数据<br>";
	// 	}else{
	// 		echo "删除失败".mysql_error().'<br>';
	// 	}
	// 	echo $sql;
	// }
	$sql = "select count(*) as total from bookstore";
	$res = mysql_query($sql);
	$data = mysql_fetch_assoc($res);
	$page = new Page($data['total'],10,3);
	$sql = "select bookid,bookname,author,detail,publisher,publishdate,price from bookstore order by bookid limit {$page->list}";
	$result = mysql_query($sql);
	echo "<form method='post' action='?page={$page->cpage}'>";
	echo "<table border='1px' width='900px'><tr>";
	echo "<th>全选</th>";
	echo "<th>编号</th>";
	echo "<th>书名</th>";
	echo "<th>作者</th>";
	echo "<th>内容</th>";
	echo "<th>出版社</th>";
	echo "<th>出版日期</th>";
	echo "<th>价格</th>";
	echo "<th>编辑</th>";
	echo "</tr>";

	while (list($bookid,$bookname,$author,$detail,$publisher,$publishdate,$price) = mysql_fetch_row($result)){
		echo '<tr>';
			echo '<td><input type="checkbox" name="id[]" value="'.$bookid.'"</td>';
			echo '<td>'.$bookid.'</td>';
			echo '<td>《'.$bookname.'》</td>';
			echo '<td>'.$author.'</td>';
			echo '<td>'.$detail.'</td>';
			echo '<td>'.$publisher.'</td>';
			echo '<td>'.date('Y-m-d H:i',$publishdate).'</td>';
			echo '<td>￥'.number_format($price,2,'.',',').'元</td>';
			echo "<td><a href='mod.php?bookid={$bookid}'>修改</a>/<a href='?action=del&bookid={$bookid}&page={$page->cpage}'>删除</a></td>";
		echo '</tr>';
	}
	echo '<tr><td><input type="submit" name="sub" value="删除"></form></td><td colspan="6">'.$page->fpage(4,5,6).'</td><td colspan="2">'.$page->fpage(7).'</td></tr><br>';
	






	//echo '</table><br>这个表一共有'.mysql_num_rows($result).'条数据<br>';
	//echo 'time()时间戳函数输出结果：'.time();






?>











<?php include "footer.php"; ?>