<?php
/**
 * Copyright 2013 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-23
 */

include("include/core.inc.php");

$skeleton = new QwSkeleton();
$skeleton->setTinymce(true);
$skeleton->setTitle("Eintrag bearbeiten / erstellen");

$log = QwLog::getInstance();
if(!$log->isLoggedIn()){
	header("Location: ".QW_WEB);
	exit;
}

if(!isset($_GET["id"])){
	$_GET["id"] = 0;
}
$p = new QwProject($_GET["id"]);
if($p->checkPermission()){
	$out = '<h1>'.($p->getId() > 0 ? "Eintrag bearbeiten" : "Neuen Eintrag erstellen").'</h1>';
	
	if(isset($_POST["name"])){
		$new = $p->getId() == 0;
		$p->setName($_POST["name"]);
		$p->setDescription($_POST["description"]);
		$p->setText($_POST["html"]);
		$p->setPublic(isset($_POST["public"]) AND $_POST["public"] == "y");
		$p->safe();
		if($new){
			$p->addUser($log->getUserId());
		}
		$p->safeTags(explode(", ",$_POST["tags"]));
		$msg = $new ? "create" : "safe";
		if(isset($_FILES["image"]) AND $_FILES["image"]["tmp_name"] != ""){
			if(!$p->uploadImage($_FILES["image"]["tmp_name"])){
				$msg = "error-image";
			}
		}
		header("Location: ".QW_WEB."/edit.php?id=".$p->getId()."&msg=".$msg);
		exit;
	}else if(isset($_GET["act"]) AND $_GET["act"] == "imgdel"){
		$p->deleteImage();
		$p->safe();
		header("Location: ".QW_WEB."/edit.php?id=".$p->getId()."&msg=safe");
		exit;
	}else if(isset($_POST["add-user"])){
		$p->addUser($_POST["add-user"]);
		header("Location: ".QW_WEB."/edit.php?id=".$p->getId()."&msg=safe");
		exit;
	}else if(isset($_GET["rm-user"])){
		$p->rmUser($_GET["rm-user"]);
		header("Location: ".QW_WEB."/edit.php?id=".$p->getId()."&msg=safe");
		exit;
	}else if(isset($_FILES["file"]) AND $_FILES["file"]["tmp_name"] != ""){
		$msg = "ok";
		if(is_array($_FILES["file"]["name"])){
			foreach($_FILES["file"]["name"] AS $i=>$name){
				if(!$p->uploadFile($_FILES["file"]["tmp_name"][$i],$_FILES["file"]["name"][$i])){
					$msg = "error";
				}
			}
		}else{
			if(!$p->uploadFile($_FILES["file"]["tmp_name"],$_FILES["file"]["name"])){
				$msg = "error";
			}
		}
		header("Location: ".QW_WEB."/edit.php?id=".$p->getId()."&file-msg=".$msg."#files");
		exit;
	}else if(isset($_GET["file-del"]) AND $_GET["file-del"] != ""){
		$p->deleteFile($_GET["file-del"]);
		header("Location: ".QW_WEB."/edit.php?id=".$p->getId()."&file-msg=del#files");
		exit;
	}else if(isset($_GET["msg"])){
		switch($_GET["msg"]){
			case "create":
				$out .= QwSkeleton::getBoxOk("Der Eintrag wurde erfolgreich angelegt.");
				break;
			case "safe":
				$out .= QwSkeleton::getBoxOk("Alle &Auml;nderungen wurden erfolgreich gespeichert.");
				break;
			case "error-image":
				$out .= QwSkeleton::getBoxError("Beim Hochladen des Vorschaubild ist ein Fehler aufgetreten!");
				break;
		}
	}
	$img = "";
	if($p->getImage() != ""){
		$img = '<p><img src="'.$p->getImage("kl").'" /> <a href="'.QW_WEB.'/edit.php?id='.$p->getId().'&act=imgdel" onclick="return confirm(\'Das Vorschaubild wirklich l&ouml;schen?\')">l&ouml;schen</a></p>';
	}
	if($p->getId() > 0){
		$out .= '<p>Erstellt am '.QwUtils::toGermanDate($p->getStamp());
		if($p->getStampLast() > 0){
			$out .= ', Letzte &Auml;nderung am '.QwUtils::toGermanDate($p->getStampLast());
		}
		$out .= ' | <a href="'.$p->getLink().'">Vorschau</a>';
		$out .= '</p>';
	}
	$p->loadTags();
	$out .= '
	<form action="'.QW_WEB.'/edit.php?id='.$p->getId().'" method="post" enctype="multipart/form-data">
		<table style="border-bottom-left-radius:0px;border-bottom-right-radius:0px;padding-bottom:5px">
			<tr><td style="width:120px">Bezeichnung</td><td><input type="text" name="name" value="'.$p->getName().'" /></td></tr>
			<tr><td>Kurzbeschreibung</td><td><textarea name="description">'.$p->getDescription().'</textarea></td></tr>
			<tr><td>Vorschaubild</td><td><input type="file" name="image" />'.$img.'</td></tr>
			<tr><td style="padding-top:10px">Inhalt</td><td></td></tr>
		</table>
		<textarea name="html" class="Html" style="height:450px">'.$p->getText().'</textarea>
		<table style="border-top-left-radius:0px;border-top-right-radius:0px">
			<tr><td>Tags <small>(mehrere mit Komma getrennt)</small></td><td><input type="text" name="tags" value="'.implode(", ",$p->getTags()).'" /></td></tr>
			<tr><td></td><td><label><input type="checkbox" name="public" value="y"'.($p->getPublic() ? ' CHECKED' : "").' /> &Ouml;ffentlich</label></td></tr>
			<tr><td style="width:120px"></td><td><br /><input type="submit" value="Speichern" /></td></tr>
		</table>
	</form>';
	
	if($p->getId() > 0){
		$out .= '<a name="files"></a><br /><br /><h2>Verzeichnis</h2>';
		if(isset($_GET["files-msg"]) AND $_GET["files-msg"] == "ok"){
			$out .= QwSkeleton::getBoxOk("Die Datei wurde erfolgreich hochgeladen.");
		}else if(isset($_GET["files-msg"]) AND $_GET["files-msg"] == "error"){
			$out .= QwSkeleton::getBoxOk("Beim Hochladen der Datei ist ein Fehler aufgetreten!");
		}else if(isset($_GET["files-msg"]) AND $_GET["files-msg"] == "del"){
			$out .= QwSkeleton::getBoxOk("Die Datei wurde erfolgreich gel&ouml;scht.");
		}
		$p->loadFiles();
		$list = $p->getFiles();
		if(count($list) > 0){
			$out .= '<ul>';
			foreach($list AS $file=>$name){
				$out .= '<li><a href="'.$file.'" target="_blank">'.$name.'</a> | <a href="'.QW_WEB.'/edit.php?id='.$p->getId().'&file-del='.$name.'" onclick="return confirm(\'Diese Datei wirklich l&ouml;schen?\')">l&ouml;schen</a></li>';
			}
			$out .= '</ul><br />';
		}
		$out .= '
			<form action="'.QW_WEB.'/edit.php?id='.$p->getId().'" method="post" enctype="multipart/form-data">
			<table>
			<tr><td>Neue Datei hochladen<br /><input type="file" name="file" multiple /> <input type="submit" value="Hochladen" /></td></tr>
			</table>';
		
		$out .= '<br /><br /><h2>Author(en)</h2>';
		$opt = QwUserManager::options();
		$um = new QwUserManager();
		$um->setProjectId($p->getId());
		$um->execute();
		$ua = $um->getObjects();
		foreach($ua AS $u){
			unset($opt[$u->getId()]);
			$out .= '
			<li>
				<a href="'.QW_WEB.'/user.php?id='.$u->getId().'">'.$u->getName().'</a> ('.($u->getStatus() == QwUser::STATUS_ACTIVE ? "Aktiv" : "Inaktiv").')
				|
				<a href="'.QW_WEB.'/edit.php?id='.$p->getId().'&rm-user='.$u->getId().'" onclick="return confirm(\'Diese Person wirklich als Author entfernen?\')">entfernen</a>
			</li>';
		}
		$out .= '</ul><br />';
		if(count($opt) > 0){
			$out .= '
			<form action="'.QW_WEB.'/edit.php?id='.$p->getId().'" method="post">
			<table>
			<tr><td>Authoren hinzuf&uuml;gen<br /><select name="add-user">';
			foreach($opt AS $k=>$v){
				$out .= '<option value="'.$k.'">'.$v.'</option>';
			}
			$out .= '</select> <input type="submit" value="Hinzuf&uuml;gen" /></td></tr>
			</table>';
		}
	}
}else{
	header("Location: ".QW_WEB."/404.php");
	exit;
}

$skeleton->begin();

echo $out;

$skeleton->end();
?>