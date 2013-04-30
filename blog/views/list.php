<?php
/*
 * List blog entries
*/
$out_includes = $dynamic->loadHooks("blog");
foreach($out_includes AS $key => $value){ require_once($value); }

//loading our plugins templates...
$templates = $dynamic->loadTemplates($plugin_name["blog"]);

$entries = getAll($db_core);
$out_posts = "";
foreach($entries AS $key => $value){
	$out_entries["blog_title"] = $value[3];
	$out_entries["blog_summary"] = shortText($value[5]);
	$out_entries["blog_id"] = $value[0];
	$out_posts .= $parser->fillMainTemplate($out_entries,NULL,$templates["blog_entry"]);
}

$output = array();
$output["blog_entries"] = $out_posts;
//and parse the output to the template
$output["page"] = $parser->fillMainTemplate($output,NULL,$templates["blog_home"]);
$main = $parser->fillMainTemplate($output,NULL,$templates["blog_body"]);

//and we put the output out...
$page = array();
$page["blog_home"] = $parser->cleanup($main);
?>