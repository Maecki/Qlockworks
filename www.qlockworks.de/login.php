<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-27
 */

include("include/core.inc.php");

$log = QwLog::getInstance();

if($log->login($_POST["user"],$_POST["pass"],(isset($_POST["remind"]) AND $_POST["remind"] == "y"))){
	header("Location: ".QW_WEB);
	exit;
}

$skeleton = new QwSkeleton();
$skeleton->begin();

?>
<h1>Login Fehlgeschlagen :-(</h1>
<br />
<p>
Leider konnte kein passender Benutzer gefunden werden.
</p>
<?php

$skeleton->end();
?>