<?php
/**
 * Copyright 2013 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-23
 */

include("include/core.inc.php");

$skeleton = new QwSkeleton();
$skeleton->begin();

?>
<h1>Page not Found (404)</h1>
<br />
Leider konnte der gesuchte Inhalt nicht gefunden werden. M&ouml;glicherweise wurde dieser gel&ouml;scht, Sie haben nicht die Berechtigung diese Seite aufzurufen oder
haben einen Fehler gefunden.<br />
Sollte dieses Problem weiterhin auftreten, k&ouml;nnen Sie uns HIER diesbez&uuml;glich kontaktieren.
<br />
<br />
<pre>
    _______________________________
   (                               )
   (  Was nun?                     )
   (  &raquo; <a href="index.php">zur Startseite</a>             )
   (  &raquo; <a href="#" onClick="return qw.back()">zur&uuml;ck zur letzten Seite</a>   )
   (  &raquo; <a href="#" onClick="document.getElementsByTagName('input')[0].focus();return false">die Suche (oben) benutzen</a>  )
   (_______________________________)
          O
           O   ^__^
            o  (oo)\_______
               (__)\       )\/\
                   ||----w |
                   ||     ||
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
</pre>
<?php

$skeleton->end();
?>