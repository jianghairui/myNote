<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2017/10/11
 * Time: 11:59
 */
abstract class AB
{
    abstract public function talk();
    abstract public function fuck();
    public function forget() {
        echo 'After a while,we forgot it';
    }
}

class Son extends AB
{
    public function talk() {
        echo 'We are talking about';
    }

    public function fuck() {
        echo ' a Fucking idiot.';
    }

    public function output() {
        $this->talk();
        $this->fuck();
        $this->forget();
    }
}

$s = new Son();
$s->output();