<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2017/10/23
 * Time: 15:57
 */

final class Core{

    static public function run() {
        defined('DEBUG') or define('DEBUG',false);
        self::_set_const();
        if(DEBUG) {
            self::_create_dir();
        }else {
            error_reporting(0);
        }
        self::_import_file();
        Application::run();
    }

    static private function _set_const() {
        $path = str_replace('\\','/',__DIR__);
        define('COMMON_PATH',$path);
        define('CONFIG_PATH',COMMON_PATH.'/Config');
        define('DATA_PATH',COMMON_PATH.'/Data');
        define('LIB_PATH',COMMON_PATH.'/Lib');
        define('CORE_PATH',LIB_PATH.'/Core');
        define('FUNCTION_PATH',LIB_PATH.'/Function');
        define('ROOT_PATH',dirname(COMMON_PATH));
        define('TMP_PATH',ROOT_PATH . '/Tmp');

        define('APP_PATH',dirname($path) . '/App/'.APP_NAME);
        define('APP_CONFIG_PATH',APP_PATH . '/config');
        define('APP_CONTROLLER_PATH',APP_PATH . '/controller');
        define('APP_TPL_PATH',APP_PATH . '/tpl');
        define('APP_PUBLIC_PATH',APP_TPL_PATH . '/public');
        define('APP_TPL_CACHE',APP_TPL_PATH . '/cache');
        define('__PUBLIC__',dirname(COMMON_PATH) . '/Public');
    }

    static private function _create_dir() {
        $path_arr = array(
            APP_PATH,
            APP_CONFIG_PATH,
            APP_CONTROLLER_PATH,
            APP_TPL_PATH,
            APP_TPL_CACHE,
            APP_PUBLIC_PATH,
            TMP_PATH,
            __PUBLIC__
        );

        foreach($path_arr as $v) {
            is_dir($v) or mkdir($v,0777,true);
        }
    }

    static private function _import_file() {
        $fileArr = array(
            FUNCTION_PATH . '/function.php',
            CORE_PATH . '/Controller.class.php',
            CORE_PATH . '/Application.class.php',
            CORE_PATH . '/Template.class.php',
        );

        foreach($fileArr as $v) {
            require_once $v;
        }
    }


}

Core::run();