<?php
/**
 * 框架入口文件
 * 1.定义常量
 * 2.加载函数库
 * 3.启动框架
 */

define('__ROOT__' ,__DIR__);
define('CORE' ,__ROOT__ . '/Core');
define('APP_PATH' ,__ROOT__ . '/App');

define('DEBUG',True);

if(DEBUG) {
    ini_set('display_errors','On');
}else {
    ini_set('display_errors','Off');
}

require CORE . '/Common/function.php';
require CORE . '/core.php';

spl_autoload_register('\Core\core::load');

\core\route::index();
\Core\core::run();