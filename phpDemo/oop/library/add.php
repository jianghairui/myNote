<?php
include "header.php";
	if(isset($_POST['sub'])){
		$sql = "insert into bookstore (bookname,publisher,author,price,publishdate,detail) values ('{$_POST['bookname']}','{$_POST['publisher']}','{$_POST['author']}','{$_POST['price']}','{$_POST['publishdate']}','{$_POST['detail']}')";
		$res = mysqli_query($link,$sql);
		echo '<br>'.$sql.'<br>';
		if(mysqli_affected_rows($link)>0){
			echo "添加成功！有".mysqli_affected_rows($link)."行受到影响<br>";
		}else{
			echo mysqli_error($link)."添加失败！<br>";
		}

	}

?>
<h3>添加图书</h3>
<form action="" method="post">
	<label style="display:inline-flex;width:100px">图书名称</label><input type="text" name="bookname" value="<?php echo $_POST['bookname'];?>"><br>
	<label style="display:inline-flex;width:100px">出版社</label><input type="text" name="publisher" value="<?php echo $_POST['publisher'];?>"><br>
	<label style="display:inline-flex;width:100px">作者</label><input type="text" name="author" value="<?php echo $_POST['author'];?>"><br>
	<label style="display:inline-flex;width:100px">价格</label><input type="text" name="price" value="<?php echo $_POST['price'];?>"><br>
	<label style="display:inline-flex;width:100px">出版日期</label><input type="date" name="publishdate" value="<?php echo $_POST['publishdate'];?>"><br>
	<label style="display:inline-flex;width:100px">描述</label><textarea cols="40" rows="5" name="detail"><?php echo $_POST['detail'];?></textarea>
	<label style="display:inline-flex;width:100px"></label>
	<input type="submit" name="sub" value="添加图书">
</form>



<?php include "footer.php"; ?>