<?php

$str = '[{"name":"\u5c40\u6570","id":1,"required":true,"group":[{"default":true,"name":"8\u5c40","id":2,"option":{"round":8}},{"name":"16\u5c40","id":3,"option":{"round":16}}],"option":[]},{"name":"\u5e95\u5206","id":4,"required":true,"group":[{"default":true,"name":"1\u5206","id":5,"option":{"baseScore":1}},{"name":"2\u5206","id":6,"option":{"baseScore":2}},{"name":"5\u5206","id":7,"option":{"baseScore":5}}],"option":[]},{"name":"\u53eb\u5206\u6a21\u5f0f","id":8,"required":true,"group":[{"default":true,"name":"\u53eb\u5206","id":9,"handleChecks":[22,24,25,23,40,31]},{"name":"\u53eb\u5730\u4e3b","id":10,"handleChecks":[30,37,39,20,21]}],"option":[]},{"name":"\u70b8\u5f39\u4e0a\u9650","id":8,"required":true,"group":[{"name":"3\u70b8","id":11,"option":{"maxBombCount":3}},{"name":"4\u70b8","id":12,"option":{"maxBombCount":4}},{"name":"5\u70b8","id":13,"option":{"maxBombCount":5}},{"default":true,"name":"\u65e0\u4e0a\u9650","id":14,"option":{"maxBombCount":100}}],"option":[]},{"name":"\u663e\u793a\u624b\u724c\u6570","id":15,"required":true,"group":[{"default":true,"name":"\u663e\u793a\u624b\u724c\u6570","id":16,"option":{"showHandsCount":1}},{"name":"\u4e0d\u663e\u793a\u624b\u724c\u6570","id":17}],"option":[]},{"name":"\u73a9\u5bb6\u4eba\u6570","id":18,"required":true,"group":[{"default":true,"name":"2\u4eba","id":24,"option":{"playerSize":2}},{"default":true,"name":"3\u4eba","id":19,"visibleSet":[20,21,22],"option":{"playerSize":3}}],"option":[]},{"name":"\u5fc5\u53eb\u6ee1\u5206","id":20},{"name":"\u6ce5\u513f","id":21,"handleChecks":[77,74,-76,78]},{"name":"\u8e39\u5730\u4e3b","id":22,"handleChecks":[-36]}]';

$arr = json_decode($str,true);
p(getNameValue($arr,'playerSize'));





//function getRoomNeedUserNumArr($array, $key,$prefix=''){
//    $ret = [];
//    if(is_array($array)){
//        foreach($array as $k => $v){
//            if($prefix === '') {
//                $full_key = $prefix.$k;
//            }else {
//                $full_key = $prefix.'-'.$k;
//            }
//            if($k === $key){
//                $ret[$full_key] = $v;
//            }
//            $child = getRoomNeedUserNumArr($v, $key,$full_key);
//            $ret = array_merge($ret,$child);
//        }
//    }
//    return $ret;
//}

function getNameValue($array, $key){
    $ret = [];
    if(is_array($array)){
        foreach($array as $k => $v){
            if($k === $key){
                $ret[] = $v;
            }
            $child = getNameValue($v, $key);
            $ret = array_merge($ret,$child);
        }
    }
    return $ret;
}


function p($obj) {
    echo '<pre>';
    print_r($obj);
    echo '</pre>';

}



