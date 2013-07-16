<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-07
 */

session_start();

if(!isset($_SESSION["user"]) OR (isset($_GET["action"]) AND $_GET["action"] == "debug")){
	$_SESSION["user"] = new User();
}
$_SESSION["user"]->loadNavigationElements();
?>