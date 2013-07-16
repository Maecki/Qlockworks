<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-09-02
 */

include("../include/core4ajax.inc.php");

$out = "";

if(isset($_GET["act"]) AND $_GET["act"] == "tinymce-imagelist"){
	
	$gm = new GalleryManager($_SESSION["user"]);
	$a = $gm->getImages();
	foreach($a AS $img){
		if($out != ""){
			$out .= ",";
		}
		$out .= '["'.$img->getGallery()->getName()." / ".$img->getName().'", "'.$img->getFile("lo").'"]';
	}
	
	header("Content: text/javascript");
	
	echo "var tinyMCEImageList = new Array(".$out.");";
	exit;
}

Ajax::out($out);
?>