<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2017/10/11
 * Time: 11:43
 */
interface A
{
    const TEL = '1310213019';
    public function say();
    public function run();
}

interface B
{
    const ANOTHER_TEL = '18526860284';
    public function study();
    public function work();
}
class Demo implements A,B
{
    public function say()
    {
        // TODO: Implement say() method.
        echo '我不能BB<br>';
    }

    public function run()
    {
        // TODO: Implement run() method.
        echo '我跑的很快<br>';
    }

    public function work()
    {
        // TODO: Implement work() method.
        echo '我工作很努力<br>';
    }

    public function study()
    {
        // TODO: Implement study() method.
        echo '我学习很努力<br>';
    }

    public function start() {
        echo '我有两个手机号,一个是'.self::TEL.',另一个是'.self::ANOTHER_TEL;
    }
}

$demo = new Demo();
$demo->start();
//echo A::TEL;