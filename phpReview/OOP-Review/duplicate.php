<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2017/10/11
 * Time: 9:18
 */
//对象的拷贝
class A
{
    public $name='姜海蕤';
    public $age=26;
    public $obj = null;

    public function __clone()
    {
        $this->obj = clone $this->obj;
    }
}
class B
{
    public $sex = '男';
}
$p1 = new A();
$p1->obj = new B();
$p2 = clone $p1;//浅拷贝,内存中共用一份区域

$p2->name = '张林';
$p2->obj->sex = '女';//对象的属性还是对象,仍然是浅拷贝

var_dump($p1->name);
echo '<br>';
var_dump($p1->obj->sex);
//$p2 = clone $p1;//深拷贝,内存中独立存在两个区域
