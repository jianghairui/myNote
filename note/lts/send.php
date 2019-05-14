<?php
require_once("config.php");
isset($_POST['content'])?$content=$_POST['content']:$content=null;
isset($_POST['nicheng'])?$nicheng=$_POST['nicheng']:$nicheng=null;
$time = time();
$sql = "insert into dunling_chat (nicheng,content,time) values ('$nicheng','$content','$time')";
$ok = mysqli_query($config,$sql);
mysqli_close($config);
if($ok){
    echo "ok";
}
?>