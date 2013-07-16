<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-07
 */

include("include/core.inc.php");

$skeleton = new Skeleton($_SESSION["user"]);

$out = "";

if(isset($_GET["key"])){
	$skeleton->getNavigation()->setSelect($_GET["key"]);
}

$out = Skeleton::getContent($skeleton->getNavigation()->getSelectedItem());

$skeleton->begin();


echo $out;

$skeleton->end();
?>