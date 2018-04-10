<?php
namespace Core;
class core {

    public static $classMap = array();

    static public function run() {

    }

    static public function load($class) {
        //自动加载类库
        if(isset(self::$classMap[$class])) {
            return false;
        }else {
            $path = str_replace('\\','/',__ROOT__ . '/' . $class . '.php');
            if(is_file($path)) {
                include $path;
            }else {
                return false;
            }
            self:$classMap[$class] = $class;
        }

    }
}