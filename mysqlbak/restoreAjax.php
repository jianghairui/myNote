<?php
include './dbconfig.php';
$dbname = $_POST['dbname'];
$databases = getResult($con,'SHOW DATABASES');
$arr = [];
foreach ($databases as $v) {
    $arr[] = $v['Databases'];
}
$post_arr = explode('/',$dbname);
!in_array($post_arr[2],$arr) || exit(json_encode(array('code'=>-2,'msg'=>'数据库不存在')));

$restore_file = '/var/www/html/' . $dbname;
exec('mysql -u' .$db['user']. ' -p' .$db['pwd']. ' ' .$post_arr[2]. '  < ' . $restore_file,$log,$int);
if($int == 0) {
    echo json_encode(array('code'=>1,'msg'=>'还原成功'));
}else {
    echo json_encode(array('code'=>-1,'msg'=>'还原失败'));
}
