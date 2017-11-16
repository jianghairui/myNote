<?php
header('Content-Type:text/html;charset=utf-8');
/*
continue    跳过内for循环的此次循环
return      终止所有for循环及外层循环(脚本)
break       终止内for循环
*/
$array = range('a','d');
foreach($array as $v) {
    if($v == 'c') {
        echo 'c处停止<br>';break;
    }
    echo '输出'.$v.'<br>';
    for($i=1;$i<=4;$i++) {
        if($i == 2) break;
        echo '输出'.$v.'-'.$i.'<br>';
    }
}



if(function_exists('action')) {
    echo 'YES';
}else {
    echo 'NO';
}
function action() {
    return 'WOW';
}


?>