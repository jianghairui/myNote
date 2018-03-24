<?php
include './dbconfig.php';



$path = './mysqlbak';
$arr = recurDir($path);

echo '<table width="600" align="center" border="1"><tbody>';
foreach ($arr as $k=>$v) {
    echo '<tr><th style="font-size: 24px">'.str_replace($path . '/','',$k).'</th><th><a href="./restore.php?dbname='.$k.'"><button style="width:150px;height:35px;font-size: 20px">查看版本</button></a></th></tr>';
}
echo '</tbody></table>';




?>




