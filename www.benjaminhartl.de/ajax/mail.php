<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-15
 */

include("../include/core4ajax.inc.php");

$out = '<center style="color:red">Es m&uuml;ssen alle Pflichtfelder ausgef&uuml;llt werden!</center><br />';


if(isset($_POST["name"]) AND $_POST["name"] != "" AND isset($_POST["text"]) AND $_POST["text"] != ""){
	if(!isset($_POST["mail"])){
		$_POST["mail"] = MAIL_REPLY;
	}
	$title = "Kontakt von ".PATH_WEB;
	Utils::mail(MAIL_SENDER,$_POST["mail"],$title,'<h1>'.$title.'</h1><table><tr><td>Name</td><td>'.$_POST["name"].'</td></tr><tr><td>E-Mail</td><td>'.$_POST["mail"].'</td></tr></table>'.nl2br($_POST["text"]));
	
	$out = "ok";

}else if(isset($_GET["act"]) AND $_GET["act"] == "ok"){
	
	$out = '<br /><h1>Kontakt</h1><br ></br><center><b style="color:green">Erfolgreich Versendet :-)</b></center>';
}


Ajax::out($out);
?>