<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-27
 */

include("include/core.inc.php");

$skeleton = new QwSkeleton();
$skeleton->setTitle("Links &amp; Partner");
$skeleton->begin();

?>
<h1>Links &amp; Partner</h1>
<br />
<h2>Seiten von Authoren</h2>
<p><a href="http://www.andreas-bildl.de" target="_blank"><img src="partner/andreas-bildl.png" /></a></p>
<p><a href="http://www.benjaminhartl.de" target="_blank"><img src="partner/benjaminhartl.jpg" /></a></p>

<br />
<br />
<br />

<h2>Regionale Portale</h2>
<table style="width:100%">
<tr>
<td><a href="http://www.bsm.de" target="_blank"><img src="partner/bsm.png" /></a></td>
<td><a href="http://www.bsmparty.de" target="_blank"><img src="partner/bsmparty.png" /></a></td>
<td><a href="http://www.waidler.com" target="_blank"><img src="partner/waidler.png" /></a></td>
</tr>
</table>

<br />
<br />
<br />

<h2>Firmen &amp; Produkte</h2>
<table style="width:100%">
<tr>
<td><a href="http://www.bwmedien.biz" target="_blank"><img src="partner/bwmedien.png" /></a></td>
<td><a href="http://www.bwcms.eu" target="_blank"><img src="partner/bwcms.png" /></a></td>
<td><a href="http://www.bwsystem.eu" target="_blank"><img src="partner/bwsystem.png" /></a></td>
</tr>
</table>
<?php
$skeleton->end();
?>