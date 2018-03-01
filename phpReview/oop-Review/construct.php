<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2017/10/9
 * Time: 16:22
 */
header('Content-Type:text/html;charset=utf-8');
class Computer{
    private $cpu;
    public function __construct($cpu='i5 6600HQ') {
        $this->cpu = $cpu;
        echo 'CPU:'.$this->cpu.'<br>';
    }

    public function game() {
        echo 'PLAY GAME<br>';
    }

    public function __destruct() {
        echo '默认脚本结束时释放对象<br>';
    }
}

$computer = new Computer('i7 7700K');
$computer->game();
//unset($computer);
echo '可提前销毁对象<br>';