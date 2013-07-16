<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-28
 */

include("include/core.inc.php");

$skeleton = new Skeleton($_SESSION["user"]);

$out = "";

$skeleton->getNavigation()->setSelect("images");

$gm = new GalleryManager($_SESSION["user"]);
if(isset($_GET["id"]) AND $_GET["id"] != ""){
	$g = $gm->getGallery($_GET["id"]);
	
	if($g instanceof Gallery){
		$out .= '<br />';
		$out .= (string)$g;
		$skeleton->getHtmlHead()->setTitle($g->getName());
	}
}
if($out == ""){
	$out = (string)$gm;
}

$skeleton->begin();

echo $out;

$skeleton->end();
?>