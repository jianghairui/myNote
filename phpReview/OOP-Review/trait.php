<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2017/10/11
 * Time: 10:11
 */
//解决了单继承问题
trait A
{
    public function a() {
        echo 'Trait A;';
    }
}
trait B
{
    public function b() {
        echo 'Trait B;';
    }
}
class Test
{
    use A,B;
    public function c() {
        $this->a();
        $this->b();
        echo 'Class Test;';
    }
}

$t = new Test();
$t->c();