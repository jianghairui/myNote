<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2018/1/13
 * Time: 16:50
 */
function numberHandle($num) {
    $newNum=str_pad($num,3,"0",STR_PAD_LEFT);
    return $newNum;
}

echo numberHandle('85');