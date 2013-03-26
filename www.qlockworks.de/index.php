<?php
/**
 * Copyright 2013 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-23
 */

include("include/core.inc.php");

$skeleton = new QwSkeleton();
$skeleton->setSelect(QwSkeleton::HOME);
$skeleton->setTitle("Startseite");
$skeleton->begin();

$pm = new QwProjectManager();
$pm->execute(true);
$pa = $pm->getObjects();
if(count($pa) > 0){
	
}else{
	echo 'Folgt in k&uuml;rze ...';
}

$skeleton->end();
?>