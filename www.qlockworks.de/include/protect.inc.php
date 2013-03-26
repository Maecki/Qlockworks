<?php
/**
 * Copyright 2013 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-23
 */

foreach($_GET AS $k=>$v){
	$_GET[$k] = QwUtils::protect($k,$v);
}

foreach($_POST AS $k=>$v){
	$_POST[$k] = QwUtils::protect($k,$v);
}
?>