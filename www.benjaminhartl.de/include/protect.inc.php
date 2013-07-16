<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-07
 */

if(isset($_POST)){
	foreach($_POST AS $key=>$val){
		$_POST[$key] = Utils::protect($key,$val);
	}
}

if(isset($_GET)){
	foreach($_GET AS $key=>$val){
		$_GET[$key] = Utils::protect($key,$val);
	}
}
?>