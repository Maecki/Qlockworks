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
<pre>
    ________________________
   (                        )
   (  Da hat doch schon     )
   (  wieder ein Kommunist  )
   (  eine Seite geklaut..  )
   (________________________)
          O
           O   ^__^
            o  (oo)\_______
               (__)\       )\/\
                   ||----w |
                   ||     ||
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
</pre>
<small>... Ich glaube das h&auml;tt' ich jetzt nicht sagen d&uuml;rfen ^^</small>
<br />
<br />
<pre>
    _______________________________
   (                               )
   (  Was nun?                     )
   (  &raquo; <a href="index.php">auf zur Startseite</a>         )
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