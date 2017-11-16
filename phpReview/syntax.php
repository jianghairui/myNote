<?php error_reporting(E_ALL &~ E_NOTICE); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<?php
    $color="red";
    echo "My car is " . $color . "<br>";
    echo "My house is " . $COLOR . "<br>";
    echo "My boat is " . $coLOR . "<br>";

    $x=5; // global scope

    function myTest() {
        global $x,$y;//先声明,再定义
        $y=10;
        echo "<p>在函数内部测试变量：</p>";
        echo "变量 x 是：$x";
        echo "<br>";
        echo "变量 y 是：$y";
        $x++;
        $y++;
    }

    myTest();

    echo "<p>在函数之外测试变量：</p>";
    echo "变量 x 是：$x";
    echo "<br>";
    echo "变量 y 是：$y",'<br>';

//define("GREETING", "Welcome to W3School.com.cn!");
//echo GREETING;
$a = 10;
$b = 15;
$a++;
echo $a.'<br>';

//and or xor
if($b > $a xor $b == 16) {
    echo 'OK<br>';
}else {
    echo 'NO<br>';
}

?>

</body>
</html>
