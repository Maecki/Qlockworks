<?php
/**
 * Copyright 2013 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-23
 */

include("include/core.inc.php");

if(preg_match("/\/(\d+)\.(.+)\.html$/",$_SERVER["REQUEST_URI"],$tmp)){
	$_GET["id"] = $tmp[1];
}

$skeleton = new QwSkeleton();
$skeleton->setTitle("Startseite");
$log = QwLog::getInstance();
$out = "";

if(isset($_GET["id"])){
	$p = new QwProject($_GET["id"]);
	if($p->getId() > 0 AND ($p->getPublic() OR $log->isLoggedIn())){
		$p->click();
		$out .= '<table style="width:100%"><tr><td>erstellt am '.QwUtils::toGermanDate($p->getStamp()).' | '.$p->getClicks().' Klicks';
		if($log->isLoggedIn() AND $p->checkPermission()){
			$out .= ' | <a href="'.QW_WEB.'/edit.php?id='.$p->getId().'">bearbeiten</a>';
		}
		$out .= '</td><td style="text-align:right">'.QwUtils::share($p->getLink(),$p->getName(),$p->getDescription(),$p->getImage("lo")).'</td></tr></table>';
		$out .= '<hr /><br /><h1>'.$p->getName().'</h1>';
		$out .= $p->getText();
		
		$aut = "";
		$um = new QwUserManager();
		$um->setProjectId($p->getId());
		$um->execute();
		$ua = $um->getObjects();
		if(count($ua) > 0){
			$out .= '<br /><h2 style="text-align:right">Author(en)</h2>';
			foreach($ua AS $u){
				$out .= $u->getCard();
			}
		}else{
			$out .= "<br />";
		}
		
		$p->loadTags();
		$tags = $p->getTags();
		if(count($tags) > 0){
			$out .= '<br /><h2>Tags</h2>';
			foreach($tags AS $i=>$tag){
				if($i > 0){
					$out .= ", ";
				}
				$out .= '<a href="'.QW_WEB.'/index.php?tag='.$tag.'">'.$tag.'</a>';
			}
		}else{
			$out .= '<br /><br /><h2 style="text-align:right">Author(en)</h2>';
		}
		$out .= '<div class="Clear"></div>';
	}else{
		header("Location: ".QW_WEB."/404.php");
		exit;
	}
}else{
	$pm = new QwProjectManager();
	if(!$log->isLoggedIn()){
		$pm->setPublic(true);
	}
	$head = "Blog";
	if(isset($_GET["tag"])){
		if($_GET["tag"] != ""){
			$pm->setTag($_GET["tag"]);
			$head .= ' &raquo; '.$_GET["tag"];
		}
	}else{
		$_GET["tag"] = "";
	}
	if(isset($_GET["search"])){
		if($_GET["search"] != ""){
			$pm->setSearch("%".$_GET["search"]."%");
			$head .= ' &raquo; '.$_GET["search"];
		}
	}else{
		$_GET["search"] = "";
	}
	if(isset($_GET["year"])){
		if($_GET["year"] != ""){
			$pm->setStampFrom(mktime(0,0,0,0,0,$_GET["year"]));
			$pm->setStampTo(mktime(0,0,0,0,0,$_GET["year"]+1)-1);
			$head .= ' &raquo; Archiv '.$_GET["year"];
		}
	}else{
		$_GET["year"] = "";
	}
	if(!isset($_GET["start"])){
		$_GET["start"] = 0;
	}
	$out .= '<h1>'.$head.'</h1>';
	$pm->setLimit($_GET["start"].",20");
	$anz = $pm->execute(true);
	$pa = $pm->getObjects();
	if($anz > 0){
		$nav = QwSkeleton::nav(QW_WEB."/index.php?tag=".$_GET["tag"]."&search=".$_GET["search"]."&year=".$_GET["year"]."&start=",$anz,20,$_GET["start"]);
		$out .= $nav;
		foreach($pa AS $p){
			$out .= '<hr /><a href="'.$p->getLink().'" class="Preview"><img src="'.$p->getImage("th").'" /><i>erstellt am '.QwUtils::toGermanDate($p->getStamp()).'</i><strong>'.$p->getName().'</strong>';
			if(!$p->getPublic()){
				$out .= '<b style="color:red">nicht &ouml;ffentlich!</b><br />';
			}
			$out .= nl2br($p->getDescription()).' <em>... mehr</em></a>';
		}
		$out .= '<hr />';
		$out .= $nav;
	}else{
		$out .= 'Leider konnten keine Projekte gefunden werden ...';
	}
}

$skeleton->begin();

echo $out;

$skeleton->end();
?>