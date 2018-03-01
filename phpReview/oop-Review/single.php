<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2017/10/11
 * Time: 11:06
 */
//单态模式-工厂模式
class Test
{
    static private $_instance = null;

    private function __construct() {}

    private function __clone() {}

    static public function getInstance() {
        if(!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

}

$test1 = Test::getInstance();
$test2 = Test::getInstance();
$test3 = Test::getInstance();
$test4 = Test::getInstance();

var_dump($test1);
var_dump($test2);
var_dump($test3);
var_dump($test4);