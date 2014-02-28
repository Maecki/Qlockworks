<?php
/**
 * Copyright 2013 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-23
 */

include("include/core.inc.php");

$log = QwLog::getInstance();
$out = "";

if(!$log->isLoggedIn()){
	header("Location: ".QW_WEB);
	exit;
}else if(!isset($_GET["id"])){
	$_GET["id"] = $log->getUserId();
}

if($_GET["id"] == $log->getUserId()){
	$u = $log->getUser();
	$u->setDataFromId($_GET["id"]);
}else{
	$u = new QwUser($_GET["id"]);
}

if($u->getId() > 0 OR $log->getUser()->getType() == QwUser::TYPE_ADMIN){
	
	if($u->getId() > 0){
		if($log->getUser()->getType() == QwUser::TYPE_ADMIN){
			$out .= '<a href="'.QW_WEB.'/user.php?id=-1">&raquo; neuen Benutzer eintragen</a><br /><br />';
		}
		$out .= '<h1>Aktuelle Benutzerangaben bearbeiten</h1>';
	}else{
		$out .= '<h1>Neuen Benutzer eintragen</h1>';
	}
	if(isset($_GET["act"]) AND $_GET["act"] == "imgdel"){
		$u->deleteImage();
		$u->safe();
		header("Location: ".QW_WEB."/user.php?id=".$u->getId()."&msg=ok");
		exit;
		
	}else if(isset($_POST["name"])){
		$u->setName($_POST["name"]);
		$u->setEmail($_POST["email"]);
		$u->setWebsite($_POST["website"]);
		$u->setDescription($_POST["description"]);
		if($log->getUserId() != $u->getId() AND $log->getUser()->getType() == QwUser::TYPE_ADMIN){
			$u->setType((isset($_POST["admin"]) AND $_POST["admin"] == "y") ? QwUser::TYPE_ADMIN : QwUser::TYPE_EDITOR);
			$u->setStatus((isset($_POST["active"]) AND $_POST["active"] == "y") ? QwUser::STATUS_ACTIVE : QwUser::STATUS_INACTIVE);
		}
		if(isset($_POST["pass0"]) AND $_POST["pass0"] == "y"){
			$_POST["pass1"] = $_POST["pass2"] = QwUtils::generatePassword();
		}
		if($_POST["pass1"] != "" AND $_POST["pass1"] == $_POST["pass2"]){
			$u->setPassword(md5($_POST["pass1"]));
		}
		$u->safe();
		if(isset($_POST["pass0"])){
			QwUtils::mail($u->getEmail(),"Zugangsdaten zu Qlockworks","Hallo ".$u->getName().',<br /><br />Folgend erhalten Sie Ihre Zugangsdaten zum Entwickler-Blog <a href="http://www.qlockworks.de" target="_blank">www.qlockworks.de</a>:<br /><br />Benutzer: '.$u->getEmail().'<br />Passwort: '.$_POST["pass1"]);
		}
		$msg = "ok";
		if(isset($_FILES["image"]) AND $_FILES["image"]["tmp_name"] != ""){
			if(!$u->uploadImage($_FILES["image"]["tmp_name"])){
				$msg = "error-image";
			}
		}
		header("Location: ".QW_WEB."/user.php?id=".$u->getId()."&msg=".$msg);
		exit;
		
	}else if(isset($_GET["msg"])){
		switch($_GET["msg"]){
			case "ok":
				$out .= '<div class="Box BoxOk">Alle &Auml;nderungen wurden erfolgreich gespeichert.</div>';
				breaK;
			case "error":
				$out .= '<div class="Box BoxError">Es ist ein Fehler aufgetreten!</div>';
				break;
			case "error-image":
				$out .= '<div class="Box BoxError">Fehler beim hochladen des Profilbild!</div>';
				break;
		}
	}
	$img = "";
	if($u->getImage() != ""){
		$img = '<p><img src="'.$u->getImage("kl").'" /> <a href="'.QW_WEB.'/user.php?id='.$u->getId().'&act=imgdel" onclick="return confirm(\'Das Profilbild wirklich l&ouml;schen?\')">l&ouml;schen</a></p>';
	}
	if($u->getStampLast() > 0){
		$out .= '<p>Letzte Anmeldung: '.QwUtils::toGermanDate($u->getStampLast()).'</p>';
	}
	$out .= '
	<form action="'.QW_WEB.'/user.php?id='.$_GET["id"].'" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Name</td>
				<td><input type="text" name="name" value="'.$u->getName().'" /></td>
			</tr>
			<tr>
				<td>&Uuml;ber dich</td>
				<td><textarea name="description" style="height:140px">'.$u->getDescription().'</textarea></td>
			</tr>
			<tr>
				<td>Bild</td>
				<td>
					<input type="file" name="image" />'.$img.'
				</td>
			</tr>
			<tr>
				<td colspan=2><hr /></td>
			</tr>
			<tr>
				<td>E-Mail</td>
				<td><input type="email" name="email" value="'.$u->getEmail().'" /></td>
			</tr>
			<tr>
				<td>Homepage</td>
				<td><input type="text" name="website" value="'.$u->getWebsite().'" /></td>
			</tr>
			<tr>
				<td colspan=2><hr /></td>
			</tr>
			<tr>
				<td>Passwort</td>
				<td><input type="password" name="pass1" /></td>
			</tr>
			<tr>
				<td>wiederholen</td>
				<td><input type="password" name="pass2" /></td>
			</tr>';
	if($log->getUserId() != $u->getId()){
		$out .= '
			<tr>
				<td></td>
				<td><label><input type="checkbox" name="pass0" value="y" /> zuf&auml;lliges Passwort erzeugen und per E-Mail versenden</label></td>
			</tr>';
	}
	$out .= '
			<tr>
				<td colspan=2><hr /></td>
			</tr>';
	if($log->getUser()->getType() == QwUser::TYPE_ADMIN AND $log->getUserId() != $u->getId()){
		$out .= '
			<tr>
				<td></td>
				<td><label><input type="checkbox" name="admin" value="y"'.($u->getType() == QwUser::TYPE_ADMIN ? " CHECKED" : "").' /> Administrator-Rechte</label></td>
			</tr>
			<tr>
				<td></td>
				<td><label><input type="checkbox" name="active" value="y"'.($u->getStatus() == QwUser::STATUS_ACTIVE ? " CHECKED" : "").' /> Aktiv</label></td>
			</tr>';
	}
	$out .= '
			<tr>
				<td width=100></td>
				<td>
					<br />
					<input type="submit" name="profil" value="'.($u->getId() > 0 ? 'Speichern' : 'Eintragen').'" />
				</td>
			</tr>
		</table>
	</form>';
	if($log->getUser()->getType() == QwUser::TYPE_ADMIN){
		$out .= '<br /><br /><h1>Weitere Benutzer</h1><ul>';
		$um = new QwUserManager();
		$um->execute();
		$ua = $um->getObjects();
		foreach($ua AS $u){
			$out .= '<li><a href="'.QW_WEB.'/user.php?id='.$u->getId().'">'.$u->getName().'</a> ('.($u->getStatus() == QwUser::STATUS_ACTIVE ? "Aktiv" : "Inaktiv").')</li>';
		}
		$out .= '</ul>';
	}
}else{
	header("Location: ".QW_WEB."/404.php");
	exit;
}

$skeleton = new QwSkeleton();
$skeleton->begin();

echo $out;

$skeleton->end();
?>