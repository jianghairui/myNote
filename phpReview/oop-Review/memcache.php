<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2017/10/11
 * Time: 11:15
 */
//单态模式-工厂模式
class Memcache
{
    public function set($k,$v) {

    }

    public function get($k) {

    }

    public function delete($k) {

    }
}

class Redis
{
    public function set($k,$v) {

    }

    public function get($k) {

    }

    public function delete($k) {

    }
}

class Cache
{
    static public function factory() {
        return new Memcache();
    }
}

$cache = Cache::factory();
var_dump($cache);
