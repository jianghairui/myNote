<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2017/10/11
 * Time: 10:18
 */
//产品说明书
interface Person {
    public function eat();
    public function sleep();
}
//功能页面
class Man implements Person
{
    public function eat()
    {
        echo '烧烤撸串,海鲜大餐。';
    }

    public function sleep()
    {
        echo '半夜睡觉。';
    }
}

class Women implements Person
{
    public function eat()
    {
        echo '减肥水果。';
    }

    public function sleep()
    {
        echo '9点睡觉。';
    }
}
//开始使用
class L
{
    static public function factory(Person $user) {
        return $user;
    }
}

$user = L::factory(new Women());
$user->eat();
$user->sleep();