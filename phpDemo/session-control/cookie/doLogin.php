<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2018/2/28
 * Time: 11:17
 */
include 'db.php';
$username = $_POST['username'];
$password = $_POST['password'];
$autoLogin = $_POST['autoLogin'];

$sql = "SELECT * FROM user WHERE username='{$username}' AND password='{$password}'";
//$sql = mysqli_escape_string($link,$sql);
$result = mysqli_query($link,$sql);
if(mysqli_num_rows($result) == 1) {
    if($autoLogin == 1) {
        $row = mysqli_fetch_assoc($result);
        setcookie('username',$username,strtotime('+7 days'));
        $salt = 'signal';
        $auth = md5($username.$password.$salt) . ":" . $row['id'];
        setcookie('auth',$auth,strtotime('+7 days'));
    }else {
        setcookie('username',$username);
    }
    exit('<script>alert("登录成功!");location.href="index.php"</script>');
}else {
    exit('<script>alert("登录失败!");location.href="login.php"</script>');
}
