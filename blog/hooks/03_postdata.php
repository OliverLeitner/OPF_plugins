<?php
/*
 * Handling post requests...
 */
function getUserid($name,$dbcore){
	//get userid by name
	$check = $dbcore->getQuery(
		"users",	//database table
		array("userid"),	//fields to return
		NULL,	//lef join
		array("username" => $name),	//where ...
		NULL,NULL,NULL,NULL,NULL,NULL,"SINGLE"
	);
	
	//return userid
	return $check[0];
}

function addBlogEntry($blogentry,$filename,$tmp_path,$img_path,$dbcore){
	//first we create the image in the filesystem
	move_uploaded_file($tmp_path,getcwd()."/".$img_path.$filename);
	
	//then we write the data to the database
	$result = $dbcore->setQuery("blogs",$blogentry,array(),"INSERT");
	return $result;
}

function getEntryTitles($uid,$dbcore){
	//get all blog entries by user...
	$check = $dbcore->getQuery(
		"blogs",	//database table
		array("*"),	//fields to return
		NULL,	//lef join
		array("userid" => $uid),	//where ...
		NULL,NULL,NULL,NULL,NULL,NULL,"FULL"
	);
	return $check;
}

function getAll($dbcore){
	//get all blog entries
	$check = $dbcore->getQuery(
		"blogs",	//database table
		array("*"),	//fields to return
		NULL,	//left join
		NULL,	//where ...
		NULL,NULL,NULL,NULL,NULL,NULL,"FULL"
	);
	return $check;
}

function getEntry($entryid,$dbcore){
	$check = $dbcore->getQuery(
	"blogs",
	array("*"),
	NULL,
	array("blogid" => $entryid),
	NULL,NULL,NULL,NULL,NULL,NULL,"SINGLE"
	);		
	return $check;
}

//from: http://www.totallyphp.co.uk/shorten-a-text-string
function ShortenText($text){
	// Change to the number of characters you want to display
	$chars = 500;
	$text = $text." ";
	$text = substr($text,0,$chars);
	$text = substr($text,0,strrpos($text,' '));
	$text = $text."...";
	return $text;
}

function shortText($blogtext){
	//cleanup and shorten
	$blogtext = strip_tags($blogtext);
	$blogtext = trim($blogtext);
	$blogtext = ShortenText($blogtext);
	return $blogtext;
}
?>