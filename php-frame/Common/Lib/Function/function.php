<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2017/10/23
 * Time: 17:24
 */
function p($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

function C($var=NULL ,$value=NULL) {
    static $config = array();
    if(is_array($var)) {
        $config = array_merge($config, array_change_key_case($var,CASE_UPPER));
        return $config;
    }
    if(is_string($var)) {
        $var = strtoupper($var);
        if(!is_null($value)) {
            $config[$var] = $value;
            return $config;
        }
        return isset($config[$var]) ? $config[$var] : NULL;
    }
    if(is_null($var) && is_null($value)) {
        return $config;
    }

}