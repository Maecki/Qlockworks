<?php
/**
 * Copyright 2013 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-23
 */

include("include/core.inc.php");

$skeleton = new QwSkeleton();
$skeleton->setTitle("Kontakt");
$skeleton->setDescription("Senden Sie uns Ihr Anliegen oder Fragen &uuml;ber ein Kontaktformular zu");
$skeleton->begin();

echo '
<h1>Kontakt</h1>
<p>
	Gerne k&ouml;nnen Sie uns &uuml;ber folgendes Formular Ihr Anliegen oder Fragen zusenden.
</p>
<br />
<form action="'.$_SERVER["PHP_SELF"].'" method="post">
	<table>
		<tr>
			<td>Vor- / Nachname*</td><td><input type="text" name="name" style="width:80%" /></td>
		</tr>
		<tr>
			<td>E-Mail*</td><td><input type="email" name="email" style="width:80%" /></td>
		</tr>
		<tr>
			<td>PLZ, Ort</td><td><input type="text" name="ort" style="width:80%" /></td>
		</tr>
		<tr>
			<td>Telefon</td><td><input type="text" name="ort" style="width:80%" /></td>
		</tr>
		<tr>
			<td>Ihr Anliegen*</td><td><textarea name="text" style="height:120px"></textarea></td>
		</tr>
		<tr>
			<td style="width:120px"></td><td><br /><input type="submit" value="Senden" /></td>
		</tr>
	</table>
</form>
<br />
<small>* Plichtangaben</small>';

$skeleton->end();
?>