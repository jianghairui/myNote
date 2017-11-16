<?php
include "header.php";
	
	if(isset($_POST['sub'])){
		$sql = "insert into bookstore (bookname,publisher,author,price,publishdate,detail) values ('{$_POST['bookname']}','{$_POST['publisher']}','{$_POST['author']}','{$_POST['price']}','".time()."','{$_POST['detail']}')";
		$res = mysql_query($sql);
		echo '<br>'.$sql.'<br>';
		if(mysql_affected_rows()>0){
			echo "添加成功！有".mysql_affected_rows()."行受到影响<br>";
		}else{
			echo mysql_error()."添加失败！<br>";
		}

	}

?>
<h3>添加图书</h3>
<form action="" method="post">
	<label style="display:inline-flex;width:100px">图书名称</label><input type="text" name="bookname" value=""><br>
	<label style="display:inline-flex;width:100px">出版社</label><input type="text" name="publisher" value=""><br>
	<label style="display:inline-flex;width:100px">作者</label><input type="text" name="author" value=""><br>
	<label style="display:inline-flex;width:100px">价格</label><input type="text" name="price" value=""><br>
	<label style="display:inline-flex;width:100px">出版日期</label><input type="text" name="publishdate" value=""><br>
	<label style="display:inline-flex;width:100px">描述</label><textarea cols="40" rows="5" name="detail"></textarea>
	<label style="display:inline-flex;width:100px"></label>
	<input type="submit" name="sub" value="添加图书">
</form>



<?php include "footer.php"; ?>