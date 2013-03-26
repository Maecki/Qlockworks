<?php
/**
 * Copyright 2013 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-23
 */

include("include/core.inc.php");

$log = QwLog::getInstance();
$info = "";

if(!isset($_GET["id"])){
	$_GET["id"] = $log->getUserId();
}
if(!isset($_GET["edit"]) OR $_GET["id"] != $log->getUserId()){
	$_GET["edit"] = "";
}
if($_GET["id"] == $log->getUserId()){
	$u = $log->getUser();
}else{
	$um = new QwUserManager();
	$um->setId($_GET["id"]);
	$um->execute(true);
	$u = $um->getObject($_GET["id"]);
}

if(!($u instanceof QwUser)){
	header("Location: ".QW_WEB."/404.php");
	exit;
	
}else if($u->getId() == $log->getUserId()){
	
	if(isset($_GET["act"]) AND $_GET["act"] == "imgdel"){
		$u->deleteImage();
		$u->safe();
		header("Location: ".QW_WEB."/user.php?edit=profil&msg=ok");
		exit;
		
	}else if(isset($_POST["profil"])){
		$u->setFirstname($_POST["firstname"]);
		$u->setLastname($_POST["lastname"]);
		$u->setGender($_POST["gender"]);
		$u->setBirthdate(QwUtils::toSqlDate($_POST["birthdate"]));
		$u->setEmail($_POST["email"]);
		$u->setWebsite($_POST["website"]);
		$u->setDescription($_POST["description"]);
		$u->safe();
		if(isset($_FILES["image"]) AND $_FILES["image"]["tmp_name"] != ""){
			if(!$u->uploadImage($_FILES["image"]["tmp_name"])){
				header("Location: ".QW_WEB."/user.php?msg=error-image");
				exit;
			}
		}
		header("Location: ".QW_WEB."/user.php?msg=ok");
		exit;
		
	}else if(isset($_GET["msg"]) AND $_GET["msg"] != ""){
		switch($_GET["msg"]){
			case "ok":
				$info = '<div class="Box BoxOk">Alle &Auml;nderungen wurden erfolgreich gespeichert :-)</div>';
				breaK;
			case "error":
				$info = '<div class="Box BoxError">Es ist ein Fehler aufgetreten :-(</div>';
				break;
			case "error-image":
				$info = '<div class="Box BoxError">Fehler beim hochladen des Profilbild :-(</div>';
				break;
		}
	}
}

$skeleton = new QwSkeleton($u->getFirstname()." ".$u->getLastname()." | Team");
$skeleton->setSelect(QwSkeleton::TEAM);
$skeleton->begin();

echo $info;

if($_GET["edit"] == "profil"){
	$img = "";
	if($u->getImage() != ""){
		$img = '<p><img src="'.$u->getImage("kl").'" /> <a href="'.QW_WEB.'/user.php?edit=profil&act=imgdel" onclick="return confirm(\'Das Profilbild wirklich l&ouml;schen?\')">l&ouml;schen</a></p>';
	}
	echo '
	<h1>Aktuelle Benutzerangaben bearbeiten</h1>
	<form action="'.QW_WEB.'/user.php" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Vorname</td>
				<td><input type="text" name="firstname" value="'.$u->getFirstname().'" /></td>
			</tr>
			<tr>
				<td>Nachname</td>
				<td><input type="text" name="lastname" value="'.$u->getLastname().'" /></td>
			</tr>
			<tr>
				<td>Geburtsdatum</td>
				<td><input type="text" name="birthdate" value="'.QwUtils::toGermanDate($u->getBirthdate()).'" /></td>
			</tr>
			<tr>
				<td>Geschlecht</td>
				<td>
					<p>
						<label><input type="radio" name="gender" value="m"'.($u->getGender() == QwUser::GENDER_MALE ? " CHECKED" : "").' /> m&auml;nnlich</label>
						<label><input type="radio" name="gender" value="f"'.($u->getGender() == QwUser::GENDER_FEMALE ? " CHECKED" : "").' /> weiblich</label>
					</p>
				</td>
			</tr>
			<tr>
				<td>E-Mail</td>
				<td><input type="email" name="email" value="'.$u->getEmail().'" /></td>
			</tr>
			<tr>
				<td>Webseite</td>
				<td><input type="text" name="website" value="'.$u->getWebsite().'" /></td>
			</tr>
			<tr>
				<td>&Uuml;ber dich</td>
				<td><textarea name="description">'.$u->getDescription().'</textarea></td>
			</tr>
			<tr>
				<td>Bild</td>
				<td>
					'.$img.'
					<input type="file" name="image" />
				</td>
			</tr>
			<tr>
				<td width=100></td>
				<td>
					<br />
					<input type="submit" name="profil" value="Speichern" />
					<input type="button" value="Abbrechen" onclick="window.location.href=\''.QW_WEB.'/user.php\'" />
				</td>
			</tr>
		</table>
	</form>';
	
}else{
	echo '
	<table style="width:100%">
		<tr valign=top>
			<td width=200>
				<img src="'.$u->getImage("th").'" />
			</td>
			<td>
				<h1>'.$u->getFirstname().' '.$u->getLastname().'</h1>';
	if($u->getId() == $log->getUserId()){
		echo '<p><a href="'.QW_WEB.'/user.php?edit=profil">&raquo; Profilangaben bearbeiten</a></p>';
	}
	echo '
				<table class="Zebra">';
	
	$a = array(
		"ID" => $u->getId(),
		"Geschlecht" => $u->getGender(true),
		"Alter" => $u->getAge()." Jahre / ".QwUtils::toGermanDate($u->getBirthdate()),
		"E-Mail" => $u->getEmail()
	);
	if($u->getWebsite() != ""){
		$a["Website"] = $u->getWebsite();
	}
	$a["Dabei seit"] = QwUtils::toGermanDate($u->getStamp());
	$a["Letzte Aktivi&auml;t"] = QwUtils::toGermanDate($u->getStampLast());
	$i = 0;
	foreach($a AS $k=>$v){
		echo '<tr><td'.($i == 0 ? ' width=100' : '').'><b>'.$k.':</b></td><td>'.$v.'</td></tr>';
		$i++;
	}
	echo '
				</table>
				<br />
				<p>'.$u->getDescription().'</p>
			</td>
		</tr>
	</table>';
}


$skeleton->end();
?>