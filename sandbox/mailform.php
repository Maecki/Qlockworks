<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-11-30
 */

if(!isset($_GET["mail-to"])){
	$_GET["mail-to"] = "info";
	$_GET["mail-host"] = "maecki.com";
}
if(!isset($_GET["mail-info"])){
	$_GET["mail-info"] = "Standard";
}
if(!isset($_GET["color"])){
	$_GET["color"] = "black";
}

$link = $_SERVER["PHP_SELF"]."?mail-info=".$_GET["mail-info"]."&mail-to=".$_GET["mail-to"]."&mail-host=".$_GET["mail-host"]."&color=".$_GET["color"];
$info = "";

if(isset($_POST["submit"])){
	foreach($_POST AS $key=>$val){
		$_POST[$key] = htmlentities($val,ENT_QUOTES,"utf-8");
	}
	if($_POST["betreff"] != "" AND $_POST["email"] != "" AND $_POST["text"] != ""){
		mail($_GET["mail-to"]."@".$_GET["mail-host"],"Kontaktanfrage ".$_GET["mail-info"],'<div style="font-family:arial,sans-serif;font-size:13px">
<p><strong>Neue Kontaktanfrage | '.$_GET["mail-info"].'</strong></p>
<br />
<p>Von: '.$_POST["vorname"]." ".$_POST["nachname"].' &lt;'.$_POST["email"].'&gt;</p>
<p>Betreff: '.$_POST["betreff"].'</p>
<p>Geburtsdatum: '.$_POST["geburtsdatum"].'</p>
<p>Wohnort: '.$_POST["wohnort"].'</p>
<p>Text:</p>'.nl2br($_POST["text"]).'
</div>',"Content-type:text/html; charset=utf-8");
		header("Location: ".$link."&send=ok");
		exit;
	}else{
		$info = '<h2>Bitte beachten Sie die Plichtangaben!</h2>';
	}
}else{
	$_POST["betreff"] = "";
	$_POST["email"] = "";
	$_POST["vorname"] = "";
	$_POST["nachname"] = "";
	$_POST["geburtsdatum"] = "";
	$_POST["wohnort"] = "";
	$_POST["text"] = "";
}
?><!DOCTYPE html>
<html>
<head>
<title>Maecki mailto</title>

<style>
html,body {
	font-size:13px;
	font-family:arial,sans-serif;
	color:<?php echo $_GET["color"]; ?>
}

html,body,iframe,form,table,tr,td,ul,ol,li,h1,h2,h3,p,img {
	margin:0px;
	padding:0px;
	border:0px;
}
hr {
	margin:5px 0px;
	padding:0px;
	border:0px;
	border-top:1px solid #AAA;
}
h1 {
	margin:10px 0px 5px 0px;
	padding:3px 8px;
	font-size:15px;
}
h2 {
	padding-bottom:5px;
	font-size:15px;
	color:red;
}
p {
	padding:3px 0px;
}
small {
	font-size:11px;
}
table {
	width:100%;
}
table tr {
	vertical-align:top;
}
table tr td {
	padding:5px 0px;
}
table tr td:first-child:not([colspan]) {
	padding-top:8px;
	width:110px;
}
input[type=text],input[type=email],input[type=submit],textarea {
	margin:0px;
	padding:2px 10px;
	background-color:#EEE;
	border:1px solid #AAA;
	border-radius:2px;
	width:90%;
}
textarea {
	height:100px;
}
input[type=submit] {
	width:auto;
	padding:2px 22px;
	cursor:pointer;
}
</style>

</head>
<body>
<?php

if(isset($_GET["send"]) AND $_GET["send"] == "ok"){

?>
<h1>Erfolgreich versendet!</h1>
<p>Vielen Dank f&uuml;r Ihre Anfrage. Diese wurde soeben erfolgreich versendet.</p>
<?php

}else{

echo $info;
?>
<form action="<?php echo $link; ?>" method="post">
<table>
	<tr><td>Betreff*</td><td><input type="text" name="betreff" value="<?php echo $_POST["betreff"]; ?>" required /></td></tr>
	<tr><td>E-Mail Adresse*</td><td><input type="email" name="email" value="<?php echo $_POST["email"]; ?>" required /></td></tr>
	<tr><td colspan=2><hr /></td></tr>
	<tr><td>Vorname</td><td><input type="text" name="vorname" value="<?php echo $_POST["vorname"]; ?>" /></td></tr>
	<tr><td>Nachname</td><td><input type="text" name="nachname" value="<?php echo $_POST["nachname"]; ?>" /></td></tr>
	<tr><td>Geburtsdatum</td><td><input type="text" name="geburtsdatum" value="<?php echo $_POST["geburtsdatum"]; ?>" /></td></tr>
	<tr><td>Wohnort</td><td><input type="text" name="wohnort" value="<?php echo $_POST["wohnort"]; ?>" /></td></tr>
	<tr><td colspan=2><hr /></td></tr>
	<tr><td>Ihr Anliegen*</td><td><textarea name="text" required><?php echo $_POST["text"]; ?></textarea></td></tr>
	<tr><td colspan=2><hr /></td></tr>
	<tr><td></td><td><input type="submit" name="submit" value="Anfrage versenden" /></td></tr>
</table>
</form>
<p><small>Bitte Beachten: alle Felder mit einem * sind Pflichtangaben!</small></p>
<?php
}
?>
</body>
</html>