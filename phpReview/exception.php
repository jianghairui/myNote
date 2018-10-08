<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2018/9/21
 * Time: 18:11
 */
try {
    $redis = new Redis();
} catch (Exception $e) {
    print $e->getMessage();
    exit();
}