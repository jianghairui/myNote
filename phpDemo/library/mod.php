<?php
include "header.php";
?>
<?php
if(isset($_POST['sub'])){
	$sql = "update bookstore set bookname='{$_POST['bookname']}',publisher='{$_POST['publisher']}',publishdate='".strtotime($_POST['publishdate'])."',price='{$_POST['price']}',author='{$_POST['author']}',detail='{$_POST['detail']}' where bookid={$_POST['bookid']}";

	mysql_query($sql);
		if(mysql_affected_rows()>0){
			echo "修改成功<br>";
		}else{
			echo "修改失败".mysql_error().'<br>';
		}
	echo $sql;
}


if(!empty($_GET['bookid'])){
		$sql = "select * from bookstore where bookid={$_GET['bookid']}";
		$result = mysql_query($sql);
		while(list($bookid,$bookname,$author,$detail,$publisher,$publishdate,$price) = mysql_fetch_row($result)){
			
	
?>
<h3>修改图书</h3>
<form action="mod.php" method="post">
	<input type="text" name="bookid" value="<?php echo $bookid ?>" hidden>
	<label style="display:inline-flex;width:100px">图书名称</label><input type="text" name="bookname" value="<?php echo $bookname ?>"><br>
	<label style="display:inline-flex;width:100px">出版社</label><input type="text" name="publisher" value="<?php echo $publisher ?>"><br>
	<label style="display:inline-flex;width:100px">作者</label><input type="text" name="author" value="<?php echo $author ?>"><br>
	<label style="display:inline-flex;width:100px">价格</label><input type="text" name="price" value="<?php echo $price ?>"><br>
	<label style="display:inline-flex;width:100px">出版日期</label><input type="text" name="publishdate" value="<?php echo date('Y-m-d H:i:s',$publishdate) ?>"><br>
	<label style="display:inline-flex;width:100px">描述</label><textarea cols="40" rows="5" name="detail"><?php echo $detail ?></textarea>
	<label style="display:inline-flex;width:100px"></label>
	<input type="submit" name="sub" value="保存修改">
</form>

<?php

		}
	}

?>











<?php
include "footer.php";
?>