<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-27
 */

include("include/core.inc.php");

$log = QwLog::getInstance();

if($log->isLoggedIn()){
	header("Location: ".QW_WEB."/user.php");
	exit;
}else if(isset($_POST["user"]) AND $_POST["user"] != ""){
	if($log->login($_POST["user"],$_POST["pass"])){
		header("Location: ".QW_WEB);
	}else{
		header("Location: ".QW_WEB."/login.php?error=passwd&user=".$_POST["user"]);
	}
	exit;
}

if(!isset($_GET["user"])){
	$_GET["user"] = "";
}

$skeleton = new QwSkeleton();
$skeleton->begin();

?>
<h1>Anmeldung</h1>
<?php
if($_GET["user"] != ""){
	echo QwSkeleton::getBoxError("Leider war das Passwort falsch oder es konnte kein passender Benutzer gefunden werden!");
}
?>
<br />
<form action="<?php echo QW_WEB; ?>/login.php" method="post" class="Loginform" style="width:300px">
E-Mail Adresse<br />
<input type="text" name="user" value="<?php echo $_GET["user"]; ?>" /><br />
<br />
Passwort<br />
<input type="password" name="pass" /><br />
<br />
<input type="submit" value="Anmelden" />
</form>
<br />
<br />
<br />
<br />
<h2>Passwort vergessen?</h2>
<p>
Sollten Sie ihr Passwort vergessen haben, k&ouml;nnen Sie sich mit folgendem Formular ein neues Passwort per E-Mail zusenden lassen.
</p>
<br />
<form action="<?php echo QW_WEB; ?>/login.php" method="post" class="Loginform" style="width:300px">
E-Mail Adresse<br />
<input type="text" name="passwd" /><br />
<br />
<input type="submit" value="Passwort anfordern" />
</form>
<?php
$skeleton->end();
?>