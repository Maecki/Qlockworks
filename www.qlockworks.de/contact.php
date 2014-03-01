<?php
/**
 * Copyright 2013 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-23
 */

include("include/core.inc.php");

$skeleton = new QwSkeleton();
$skeleton->setTitle("Kontakt");
$skeleton->setDescription("Senden Sie uns Ihr Anliegen oder Fragen &uuml;ber ein Kontaktformular zu");

$out = '<h1>Kontakt</h1>';

if(isset($_GET["msg"]) AND $_GET["msg"] == "send"){
	$out .= QwSkeleton::getBoxOk("Ihre Anfrage wurde erfolgreich versendet.");
	$out .= '<br /><br /><h2>Vielen Dank</h2><br />Ihre Anfrage wurde erfolgreich versendet und wir werden uns fr&uuml;hestm&ouml;glich bei Ihnen melden.';
}else{
	if(isset($_POST["name"])){
		if($_POST["name"] != "" AND $_POST["email"] != "" AND $_POST["text"] != ""){
			QwUtils::mail("info@qlockworks.de","Kontaktanfrage","Name: ".$_POST["name"]."<br />
E-Mail: ".$_POST["email"]."<br />
Telefon: ".$_POST["telefon"]."<br />
PLZ, Ort: ".$_POST["ort"]."<br />
Text:<br />".nl2br($_POST["text"]));
			header("Location: ".$_SERVER["PHP_SELF"]."?msg=send");
			exit;
		}
		$out .= QwSkeleton::getBoxError("F&uuml;llen Sie alle Pflichtfelder korrekt aus um die Anfrage absenden zu k&ouml;nnen!");
	}else{
		$_POST["name"] = "";
		$_POST["email"] = "";
		$_POST["telefon"] = "";
		$_POST["ort"] = "";
		$_POST["text"] = "";
	}
	$out .= '
	<p>
	Gerne stehen wir Ihnen bei Fragen zur Verf&uuml;gung. Senden Sie uns dazu eine E-Mail an <a data-mail="info" data-host="qlockworks.de"></a> oder verwenden Sie folgendes Formular:
	</p>
	<br />
	<form action="'.$_SERVER["PHP_SELF"].'" method="post">
		<table>
			<tr>
				<td>Vor- / Nachname*</td><td><input type="text" name="name" value="'.$_POST["name"].'" style="width:80%" /></td>
			</tr>
			<tr>
				<td>E-Mail*</td><td><input type="email" name="email" value="'.$_POST["email"].'" style="width:80%" /></td>
			</tr>
			<tr>
				<td>Telefon</td><td><input type="text" name="telefon" value="'.$_POST["telefon"].'" style="width:80%" /></td>
			</tr>
			<tr>
				<td>PLZ, Ort</td><td><input type="text" name="ort" value="'.$_POST["ort"].'" style="width:80%" /></td>
			</tr>
			<tr>
				<td>Ihr Anliegen*</td><td><textarea name="text" style="height:120px">'.$_POST["text"].'</textarea></td>
			</tr>
			<tr>
				<td style="width:120px"></td><td><br /><input type="submit" value="Senden" /></td>
			</tr>
		</table>
	</form>
	<br />
	<small>* Plichtangaben</small>';
}
$skeleton->begin();

echo $out;

$skeleton->end();
?>