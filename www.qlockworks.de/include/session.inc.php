<?php
/**
 * Copyright 2013 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-23
 */

session_start();

if(!isset($_SESSION["qw"])){
	$_SESSION["qw"] = QwLog::start();
	
}else{
	QwLog::init($_SESSION["qw"]);
}

$log = QwLog::getInstance();

if($log->isLoggedIn()){
	$log->getUser()->setStampLast(time());
	$log->getUser()->safe();
}
?>