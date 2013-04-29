<?php
/*
 * REQUEST parameters
 */
//just some base limits for db handler...
$limit = array(
	"limit" => 5,
    "offset" => 0
);

//data for login...
$and_array = array(
	"password" => $_REQUEST["password"]
);

//where for login
$where_array = array(
	"username" => " LIKE '".$_REQUEST["user"]."' ",
);

$write_post_data = array(
	"userid" => trim($_REQUEST["userid"]),
	"blogname" => $_POST["blogtitle"],
	"blogtext" => $_POST["blogtext"],
	"catid" => trim($_REQUEST["categories"]),
	"blogimage" => $img_path.$_FILES["blog_image"]["name"]
);

$img_name = $_FILES["blog_image"]["name"];
$tmp_path = $_FILES["blog_image"]["tmp_name"];

//some base paths etc...
$img_path = "plugins/blog/images/";

//alternate database for this plugin
$config["db_name"] = "blog";

//and we build a connection
//we make sure that we connect to our database...
//$db_con = new OPF\Database\DB($config);
$db_core = new OPF\Database\DB_CORE($config);
?>