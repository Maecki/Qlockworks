<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-23
 */


// Domain- und Datei-Pfade
define("QW_WEB","http://".$_SERVER["SERVER_NAME"]."/Qlockworks/www.qlockworks.de");
define("QW_FTP",QW_WEB."/ftp");

// Ftp-Verbindung
define("QW_FTP_HOST","qlockorks.maecki.com");
define("QW_FTP_USER","qu2ftp");
define("QW_FTP_PASS","pass2ftp");

// Verbindung zur MySQL-Datenbank
define("QW_SQL_HOST","localhost");
define("QW_SQL_USER","root");
define("QW_SQL_PASS","");
define("QW_SQL_BASE","qlockworks");


// Globale Variablen
global $project_status;
$project_status = array(
	"n" => "Neu / In Planung",
	"b" => "In Bearbeitung",
	"y" => "Abgeschlossen",
	"c" => "Abgebrochen",
	"p" => "Pausiert"
);
?>