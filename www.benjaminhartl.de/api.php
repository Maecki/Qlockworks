<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-07
 */

include("include/core.inc.php");

$out = "";

if(isset($_GET["act"]) AND $_GET["act"] != ""){
	
	if($_SESSION["user"]->isLoggedIn()){
		
	}
}

Ajax::out($out);
?>