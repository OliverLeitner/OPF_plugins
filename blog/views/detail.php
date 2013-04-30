<?php 
/*
 * view a blog entry
 */
$out_includes = $dynamic->loadHooks("blog");
foreach($out_includes AS $key => $value){ require_once($value); }

//detail data into detail template
$templates = $dynamic->loadTemplates($plugin_name["blog"]);
$entry = getEntry($_GET["blogid"],$db_core);
$blog = array();
$blog["blogimage"] = $img_path.$entry[4];
$blog["blogname"] = $entry[3];
$blog["blogtext"] = $entry[5];
$detail = $parser->fillMainTemplate($blog,NULL,$templates["blog_detail"]);

//detail template into main template
$output = array();
$output["page"] = $detail;
$main = $parser->fillMainTemplate($output,NULL,$templates["blog_body"]);

$page = array();
$page["blog_detail"] = $parser->cleanup($main);
?>