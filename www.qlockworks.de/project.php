<?php
/**
 * Copyright 2013 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-27
 */

include("include/core.inc.php");

$skeleton = new QwSkeleton();
$skeleton->setSelect(QwSkeleton::PROJECTS);
$skeleton->setTitle("Projekte");

$skeleton->begin();


$skeleton->end();
?>