<?php
//function runLocalCommand($command) {
//    $command = trim($command);
//    $log = '';
//    exec($command . ' 2>&1', $log, $status);
//    return $log;
//}
include './dbconfig.php';
$dbname = $_POST['dbname'];
$databases = getResult($con,'SHOW DATABASES');
$arr = [];
foreach ($databases as $v) {
    $arr[] = $v['Databases'];
}
!in_array($dbname,$arr) || exit(json_encode(array('code'=>-2,'msg'=>'数据库不存在')));

$bakpath = '/var/www/html/mysqlbak/' . $dbname . '/';
is_dir($bakpath) || mkdir($bakpath,0777,true);

exec('mysqldump -u' .$db['user']. ' -p' .$db['pwd']. ' ' .$dbname. '  > ' . $bakpath . $dbname . time() . '.sql',$log,$int);
if($int == 0) {
    echo json_encode(array('code'=>1,'msg'=>'备份成功'));
}else {
    echo json_encode(array('code'=>-1,'msg'=>'备份失败'));
}
