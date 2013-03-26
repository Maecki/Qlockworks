<?php
/**
 * Copyright 2013 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-27
 */

include("include/core.inc.php");

$skeleton = new QwSkeleton();
$skeleton->setSelect(QwSkeleton::IMPRINT);
$skeleton->setTitle("Impressum");
$skeleton->begin();

?>
<h1>Impressum</h1>
<br />
<h3>Anbieter</h3>
Qlockworks<br />
Am Schulberg 10<br />
E-Mail: <a href="#" data-mail="info" data-host="qlockworks.de"></a><br />
<br />
<h3>Kontakt</h3>
E-Mail: <a href="#" data-mail="info" data-host="qlockworks.de"></a><br />
Website: <a href="http://www.qlockworks.de" target="_blank">www.qlockworks.de</a><br />
<br />
<h3>Verantwortlich nach � 6 Abs.2 MDStV</h3>
<a href="http://www.benjaminhartl.de" target="_blank">Benjamin Hartl</a><br />
Redakteur "Hardware und Software"<br />
am Schulberg 10<br />
94163 Saldenburg<br />
<br />
<br />
<h3>Haftungsauschluss</h3>
<br />
<b>Haftung f�r Inhalte</b>
<p>Die Inhalte unserer Seiten wurden mit gr��ter Sorgfalt erstellt. F�r die Richtigkeit, Vollst�ndigkeit und Aktualit�t der Inhalte k�nnen wir jedoch keine Gew�hr �bernehmen.</p>
<p>Als Diensteanbieter sind wir gem�� � 7 Abs.1 TMG f�r eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach �� 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht verpflichtet, �bermittelte oder gespeicherte fremde Informationen zu �berwachen oder nach Umst�nden zu forschen, die auf eine rechtswidrige T�tigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unber�hrt. Eine diesbez�gliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung m�glich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.</p>
<br />
<b>Haftung f�r Links</b>
<p>Unser Angebot enth�lt Links zu externen Webseiten Dritter, auf deren Inhalte wir keinen Einflu� haben. Deshalb k�nnen wir f�r diese fremden Inhalte auch keine Gew�hr �bernehmen.</p>
<p>F�r die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf m�gliche Rechtsverst��e �berpr�ft. Rechtswidrige  Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Links umgehend entfernen.</p>
<br />
<b>Urheberrecht</b><br />
<p>Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht.</p>
<p>Die Vervielf�ltigung, Bearbeitung, Verbreitung und jede Art der Verwertung au�erhalb der Grenzen des Urheberrechtes bed�rfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur f�r den privaten, nicht kommerziellen Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.</p>
<br />
<b>Datenschutz</b>
<p>Die Nutzung unserer Webseite ist in der Regel ohne Angabe personenbezogener Daten m�glich. Soweit auf unseren Seiten personenbezogene Daten (beispielsweise Name, Anschrift oder E-Mail-Adre�en) erhoben werden, erfolgt dies, soweit m�glich, stets auf freiwilliger Basis. Diese Daten werden ohne Ihre ausdr�ckliche Zustimmung nicht an Dritte weitergegeben.</p>
<p>Wir weisen darauf hin, da� die Daten�bertragung im Internet (z.B. bei der Kommunikation per E-Mail) Sicherheitsl�cken aufweisen kann. Ein l�ckenloser Schutz der Daten vor dem Zugriff durch Dritte ist nicht m�glich.</p>
<p>Der Nutzung von im Rahmen der Impre�umspflicht ver�ffentlichten Kontaktdaten durch Dritte zur �bersendung von nicht ausdr�cklich angeforderter Werbung und Informationsmaterialien wird hiermit ausdr�cklich widersprochen. Die Betreiber der Seiten behalten sich ausdr�cklich rechtliche Schritte im Falle der unverlangten Zusendung von Werbeinformationen, etwa durch Spam-Mails, vor.</p>
<?php

$skeleton->end();
?>