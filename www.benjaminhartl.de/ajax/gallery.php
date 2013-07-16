<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-15
 */

include("../include/core4ajax.inc.php");

$out = "Es ist ein Fehler aufgetreten!";

if($_SESSION["user"]->isLoggedIn()){
	
	$gm = new GalleryManager($_SESSION["user"]);
	
	if(isset($_GET["img_id"]) AND $_GET["img_id"] != ""){
		
		$img = $gm->getImage($_GET["img_id"]);
		if($img instanceof GalleryImage){
			$img->setName($_POST["name"]);
			
			$g = $gm->getGallery($_POST["gid"]);
			if($g instanceof Gallery AND $img->getGallery()->getId() != $g->getId()){
				$img->setGallery($g);
				$g->setImage($img);
			}
			$gm->safeImages();
			$out = "<br />".$g;
		}
	}else if(isset($_POST["name"]) AND $_POST["name"] != ""){
		$g = null;
		if(isset($_GET["id"]) AND $_GET["id"] != ""){
			$g = $gm->getGallery($_GET["id"]);
		}
		if(!($g instanceof Gallery)){
			$g = new Gallery($_SESSION["user"]);
		}
		$g->setName($_POST["name"]);
		$g->setPublic(isset($_POST["public"]) AND $_POST["public"] == "y");
		$gm->setGallery($g);
		$gm->safe();
		$out = '<div class="Ok">Erfolgreich gespeichert</div><br />'.$g;
	
	}else if(isset($_FILES["img"]) AND $_FILES["img"]["tmp_name"] != ""){
		$g = $gm->getGallery($_GET["id"]);
		if($g instanceof Gallery){
			$img = new GalleryImage($g);
			$img->setName($_FILES["img"]["name"]);
			$id = $gm->setImage($img);
			$g->setImage($gm->getImage($id));
			if($gm->getImage($id)->upload($_FILES["img"]["tmp_name"])){
				$gm->safeImages();
				$out = '<br />'.$g;
			}
		}
	
	}else if(isset($_GET["act"]) AND $_GET["act"] == "imgdel"){
		$img = $gm->getImage($_POST["id"]);
		if($img instanceof GalleryImage){
			$g = $img->getGallery();
			$g->delImage($_POST["id"]);
			$out = "<br />".(string)$g;
		}
		
	}else if(isset($_GET["act"]) AND $_GET["act"] == "galdel"){
		$gm->delGallery($_POST["id"]);
		$gm->safe();
		$gm->safeImages();
		$out = (string)$gm;
	}
}

Ajax::out($out);
?>