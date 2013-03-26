<?php
/**
 * Copyright 2013 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-23
 */

include("include/core.inc.php");

$skeleton = new QwSkeleton();
$skeleton->setSelect(QwSkeleton::CONTACT);
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
	<table width=100%>
		<tr valign=top>
			<td width=50%>
				<b>Vor- / Nachname*</b><br />
				<input type="text" name="name" style="width:80%" /><br />
				<br />
				<b>E-Mail*</b><br />
				<input type="email" name="email" style="width:80%" /><br />
			</td>
			<td>
				<b>PLZ / Ort</b><br />
				<input type="text" name="ort" style="width:80%" /><br />
				<br />
				<b>Telefon</b><br />
				<input type="text" name="ort" style="width:80%" /><br />
			</td>
		</tr>
		<tr height=10><td colspan=2></td></tr>
		<tr>
			<td colspan=2>
				<b>Text*</b><br />
				<textarea name="text" style="height:120px"></textarea><br />
				<br />
				<input type="submit" value="Senden" />
			</td>
		</tr>
	</table>
</form>
<br />
<small>* Plichtangaben</small>';

$skeleton->end();
?>