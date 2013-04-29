<?php
/*
 * some simple auth f00
 */
function createSession($wherearray,$andarray,$dbcore){
	
	//checker bool.
	$valid = FALSE;
	
	//get userdata from database...
	$check = $dbcore->getQuery(
		"users",	//database table
		array("username","password"),	//fields to return
		NULL,	//lef join
		array("password" => md5($_REQUEST["password"])),	//where ...
		NULL,NULL,NULL,NULL,NULL,NULL,"SINGLE"
	);

	//if passwords match
	if(md5($_REQUEST["password"]) == $check[1]){
		$valid = TRUE;
	}
	
	//return a validation of sorts...
	return $valid;
}
?>