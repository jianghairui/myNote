<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2019/3/16
 * Time: 10:58
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