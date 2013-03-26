<?php
/**
 * Copyright 2013 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-27
 */

include("include/core.inc.php");

$skeleton = new QwSkeleton();
$skeleton->setSelect(QwSkeleton::TEAM);
$skeleton->setTitle("Das Team");

$skeleton->begin();

$i = 0;
$um = new QwUserManager();
$um->execute();
$ua = $um->getObjects();
foreach($ua AS $u){
	if($i > 0){
		echo "<hr />";
	}
	echo '
	<table width=100%>
		<tr valign=top>
			<td width=200>
				<a href="'.QW_WEB.'/user.php?id='.$u->getId().'"><img src="'.$u->getImage("th").'" /></a>
			</td>
			<td>
				<a href="'.QW_WEB.'/user.php?id='.$u->getId().'" style="font-weight:bold;font-size:16px;color:black;">'.$u->getFirstname().' '.$u->getLastname().'</a>';
	if($u->getWebsite() != ""){
		echo '<p>'.$u->getWebsite().'</p>';
	}
	echo '
				<p>'.$u->getDescription().'</p>
			</td>
		</tr>
	</table>';
	$i++;
}

$skeleton->end();
?>