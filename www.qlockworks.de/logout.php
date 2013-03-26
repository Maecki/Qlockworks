<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-27
 */

include("include/core.inc.php");

$log = QwLog::getInstance();

$log->logout();

$skeleton = new QwSkeleton();
$skeleton->begin();

?>
<h1>Erfolgreich ausgeloggt</h1>
<br />
<p>
Sie haben sich erfolgreich vom System abgemeldet.
</p>
<?php

$skeleton->end();
?>