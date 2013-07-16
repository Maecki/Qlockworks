<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-15
 */

include("../include/core4ajax.inc.php");

$out = "";

if(isset($_GET["act"]) AND $_GET["act"] != ""){
	
	if($_GET["act"] == "get"){
		$out = Skeleton::getContent($_SESSION["user"]->getNavigationElement($_POST["key"]));
	
	}else if($_GET["act"] == "gallery"){
		if(!isset($_POST["id"])){
			$_POST["id"] = 0;
		}
		$gm = new GalleryManager($_SESSION["user"]);
		$g = $gm->getGallery($_POST["id"]);
		if($g instanceof Gallery){
			$out .= "<br />";
			$out .= (string)$g;
		}else{
			$out .= (string)$gm;
		}
	
	}else if($_SESSION["user"]->isLoggedIn()){
		
		if($_GET["act"] == "editTpl"){
			$tm = new TplManager($_SESSION["user"],$_POST["key"]);
			$out .= $tm->getFormular();
			
		}else if($_GET["act"] == "cancelTpl" OR $_GET["act"] == "safeTpl"){
			$tm = new TplManager($_SESSION["user"],$_POST["key"]);
			if($_GET["act"] == "safeTpl" AND isset($_POST["html"])){
				$tm->setText($_POST["html"]);
			}
			$out .= (string)$tm;
		
		}else if($_GET["act"] == "editSite"){
			
			if(isset($_POST["key"])){
				$s = $_SESSION["user"]->getNavigationElement($_POST["key"]);
			}else{
				$s = new NavigationElement($_SESSION["user"]);
			}
			if(isset($_POST["name"]) AND $_POST["name"] != "" AND isset($_POST["key"]) AND $_POST["key"] != ""){
				if(!($s instanceof NavigationElement)){
					$s = new NavigationElement($_SESSION["user"]);
				}
				$s->setKey($_POST["key"]);
				$s->setName($_POST["name"]);
				$s->setPublic(isset($_POST["public"]) AND $_POST["public"] == "y");
				$_SESSION["user"]->setNavigationElement($s);
				$_SESSION["user"]->safeNavigationElements();
				
				$out .= (string)$s->getLink()->getHref();
			}else{
				if($s instanceof NavigationElement){
					$out .= $s->getFormular();
				}else{
					$out .= "Fehler! Die Seite wurde nicht gefunden.";
				}
			}
			
		}else if($_GET["act"] == "delSite"){
			$_SESSION["user"]->delSite($_POST["key"]);
			$out .= PATH_WEB;
			
		}else if($_GET["act"] == "setSortNavigation"){
			$a = explode("//",$_POST["sort"]);
			foreach($a AS $i=>$key){
				echo $i."=".$key."<br />";
				$_SESSION["user"]->getNavigationElement($key)->setSort($i+1);
			}
			$_SESSION["user"]->safeNavigationElements();
		}
	}
}

Ajax::out($out);
?>