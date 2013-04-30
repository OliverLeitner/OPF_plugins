<?php
/*
 * a simple login handler
 */
$out_includes = $dynamic->loadHooks("blog");
foreach($out_includes AS $key => $value){ require_once($value); }

//here comes the login function logic stuff...
if($_POST){
	$valid = createSession($where_array,$and_array,$db_core);
	if($valid == TRUE){
		$_SESSION["user"] = $_POST["user"];
	}
}

//redirect us to admin if were allowed to access it.
if($_SESSION["user"] != ""){
	header('Location: ?page=blog_admin');
}

//loading our plugins templates...
$templates = $dynamic->loadTemplates($plugin_name["blog"]);

$output = array();
$output["page"] = $parser->fillMainTemplate($output,$templates["login"]);

//and parse the output to the template
$main = $parser->fillMainTemplate($output,$templates["blog_body"]);

//and we put the output out...
$page = array();
$page["blog_login"] = $parser->cleanup($main);
?>