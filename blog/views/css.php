<?php
/*
 * stylesheet file
 */
//loading our plugins templates...
$templates = $dynamic->loadTemplates($plugin_name["blog"],$data_con);

$data = array();
$data["dummy"] = "hello world";

header("Content-type: text/css; charset: UTF-8");
header("Cache-Control: must-revalidate");
$offset = 60 * 60 ;
$ExpStr = "Expires: " .
gmdate("D, d M Y H:i:s",
time() + $offset) . " GMT";
header($ExpStr);
        
$main = $parser->fillMainTemplate($data,NULL,$templates["css"]);
$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $main);
$buffer = str_replace(': ', ':', $buffer);
$buffer = str_replace(array("\r\n", "\r", "\n","\t"), '', $buffer);

//and we put the output out...
$page = array();
$page["css"] = $buffer;
?>