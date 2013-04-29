<?php
/*
 central plugin loader
 this gets loaded before our
 plugin, here we can influence
 how our actual pages are named etc...
 */
//debugging times...
ini_set("display_errors","Off");

//enable session handling
//globally to our plugin
session_set_cookie_params(1200);
session_start();

//first we define our current name...
$plugin_name["blog"] = "blog";

//index output
$data = array(
	"blog_home" => "blog/views/list.php",
	"blog_detail" => "blog/views/detail.php",
	"blog_admin" => "blog/views/admin.php",
	"blog_login" => "blog/views/login.php",
	"css" => "blog/views/css.php"
);

//add our stuff to output.
$plugin_out = array_merge($plugin_out,$data);
?>