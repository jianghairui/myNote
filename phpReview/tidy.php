<?php

$str = '<p>哈<br>哈<img ab';
$str = mb_substr($str, 0, -1);
$str = strip_tags($str, "<img><p><br>");
//$str = html_entity_decode($str);

$tidy_config = array(
    'clean' => true,
    'output-xhtml' => true,
    'show-body-only' => true,
    'wrap' => 0
);
$tidy = tidy_parse_string($str, $tidy_config, 'UTF8');
$tidy->cleanRepair();
file_put_contents('./a.txt', $tidy->value);

?>