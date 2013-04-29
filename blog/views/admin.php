<?php
/*
 * write a blog entry
 */
if($_SESSION["user"] == ""){
	header("Location: ?page=blog_login");
}

//loading our database stuff...
$out_includes = $dynamic->loadHooks("blog");
foreach($out_includes AS $key => $value){ require_once($value); }

//and run our userFunc to insert the blog entry...
//but only if submitted.
if($_POST){
	//for debugging we can shortform write to file...
	//file_put_contents('debug_post.txt', $_POST["blogtext"]);
	$result = addBlogEntry($write_post_data,$img_name,$tmp_path,$img_path,$db_core);
	if(!is_numeric($result)){
		print $result;
		die("error");
	} else {
		echo '<div id="success"><strong>posting worked, youre done here.</strong></div>';
	}
}

//loading our plugins templates...
$templates = $dynamic->loadTemplates($plugin_name["blog"],$data_con);

//getting userid for editing and fetching purposes...
$userid = getUserid($_SESSION["user"],$db_core);

//receive postdata for displaying as list
$entries = getEntryTitles($userid,$db_core);
$out_posts = "";
foreach($entries AS $key => $value){
	$out["post_id"] = $value[0];
	$out["post_title"] = $value[3];
	$out_posts .= $parser->fillMainTemplate($out,NULL,$templates["admin_post"]);
}

//give our template array the data we just selected
$output = array();
$output["userid"] = $userid;
$output["blogposts"] = $out_posts;
$output["page"] = $parser->fillMainTemplate($output,NULL,$templates["admin"]);
//and parse the output to the template
$main = $parser->fillMainTemplate($output,NULL,$templates["blog_body"]);

//and we put the output out...
$page = array();
$page["blog_admin"] = $parser->cleanup($main);
?>