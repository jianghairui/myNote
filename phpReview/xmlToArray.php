<?php
header('Content-Type:text/html;charset=utf-8');

function xmlToArray($xml){ 
 //禁止引用外部xml实体 
libxml_disable_entity_loader(true); 
$xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA); 
$val = json_decode(json_encode($xmlstring),true); 
 
return $val; 

} 

$xml = '<xml>
<ToUserName><![CDATA[公众号]]></ToUserName>
<FromUserName><![CDATA[粉丝号]]></FromUserName>
<CreateTime>1460537339</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[欢迎开启公众号开发者模式]]></Content>
<MsgId>6272960105994287618</MsgId></xml>';
$arr = xmlToArray($xml);
echo '<pre>';
print_r($arr);
echo '</pre>';

?>