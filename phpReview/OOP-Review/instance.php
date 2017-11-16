<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2017/10/11
 * Time: 10:00
 */
//类型约束
class A
{
    public function go() {
        echo 'Here We Gogogogo....';
    }
}

function test(A $a) {
    $a->go();
}

test(new A());