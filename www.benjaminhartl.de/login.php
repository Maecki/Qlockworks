<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-15
 */

include("include/core.inc.php");

if(!isset($_POST["nick"])){
	$_POST["nick"] = "";
}
if(isset($_POST["pass"]) AND $_POST["pass"] != ""){
	$_SESSION["user"]->login($_POST["nick"],$_POST["pass"]);
	
	if($_SESSION["user"]->isLoggedIn()){
		
		header("Location: ".PATH_WEB);
		exit;
	}
}
?><html>
<head>
	<title>Login</title>
	<style type="text/css">
	html,body {
		font-size:11px;
		font-family:arial,sans-serif;
	}
	</style>
</head>
<body><br />
<br />
<center><?php

echo '<form action="'.PATH_WEB.'/login.php" method="post">';
if($_POST["nick"] != ""){
	echo "Falscher Login!<br />";
}
echo '<br />Benutzer:<br /><input type="text" name="nick" value="'.$_POST["nick"].'" /><br />Passwort:<br /><input type="password" name="pass" /><br /><br /><input type="submit" value="Login" /></form>';

?></center>
</body>
</html>