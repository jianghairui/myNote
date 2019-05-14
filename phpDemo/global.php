<?php error_reporting(E_ALL &~ E_NOTICE); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<?php
    $x=5; // global scope
    function myTest() {
        global $x,$y;
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

?>

</body>
</html>
