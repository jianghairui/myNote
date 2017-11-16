<?php
namespace Core;
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2017/10/23
 * Time: 16:27
 */
error_reporting(E_ALL &~ E_NOTICE);
class Controller
{
    public function __construct() {
        if(method_exists($this,'__init')) {
            $this->__init();
        }
    }

    protected function success() {
        include DATA_PATH . "/Tpl/success.html";
    }

    protected function error() {
        echo 'error';
    }

    protected function template($tpl_name) {
        $tpl = new \Core\Template($tpl_name . '.html');
        include $tpl->compile('cache/' . $tpl_name . '.html');
    }
}