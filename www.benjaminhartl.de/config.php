<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-07
 */

error_reporting(E_ALL);
ini_set('display_errors',"On");

if(preg_match("/\.(dev|local)$/",$_SERVER["SERVER_NAME"]) OR $_SERVER["SERVER_NAME"] == "localhost"){
	
	define("PATH_JS","/Qlockworks/www.benjaminhartl.de");
	define("PATH_WEB","http://localhost".PATH_JS);
	define("PATH_ROOT","C:/xampp/htdocs".PATH_JS);
	
}else{
	
	define("PATH_ROOT",$_SERVER["DOCUMENT_ROOT"]);
	define("PATH_WEB","http://www.benjaminhartl.de");
	define("PATH_JS","");
}

define("PATH_CACHE",PATH_ROOT."/data/cache");

define("PATH_DESIGN",PATH_WEB."/data");



define("HEADER_TITLE","Benjamin Hartl - Maecki.com");
define("HEADER_DESCRIPTION","Musiker, Gitarrist und Bassist. Webseiten von und &uuml;ber Benjamin Hartl: benjaminhartl.de, diaryofben.de, clockworks-revolution.de und maecki.com.");
define("HEADER_KEYWORDS","Benjamin Hartl,Benjamin,Werner,Hartl,Maecki.com,PHP-Entwickler,Webentwickler,DiaryOfBen,Clockworks-Revolution,Programmierer,Javascript,JQuery,Gitarre,Bass");

define("HEADER_FAVICON",PATH_WEB."/favicon.png");


define("HTACCESS","n");

define("LOGIN_USER","bene");
define("LOGIN_PASS","Ns79=89nA");

define("MAIL_REPLY","info@benjaminhartl.de");


// Sprache
setlocale(LC_TIME,"de_DE@euro","de_DE","de","ge");
?>