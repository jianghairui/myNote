<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2019/5/13
 * Time: 11:38
 */

function dlfile($file_url, $save_to) {

    $content = file_get_contents($file_url);
    if($content) {
        file_put_contents($save_to, $content);
        echo $file_url . 'YES <br>';
    }else {
        echo $file_url . 'NO <br>';
    }
}

for($i=0;$i<100;$i++) {
    dlfile('http://www.yxsss.com/ui/sk/'.$i.'.gif','./sk/'. $i . '.gif');
}
