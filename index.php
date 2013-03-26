<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-03-26
 */

?><!DOCTYPE html>
<html>

<head>
<title>Qlockworks Start</title>

<style>
html,body {
	font-size:13px;
	font-family:verdana;
	background-color:#511;
}
html,body,h1,h2,h3,p,ul,li,img {
	margin:0px;
	padding:0px;
	border:0px;
}

.Wrapper {
	width:660px;
	margin:10px auto;
	padding:20px;
	background-color:white;
}
.Wrapper h1 {
	margin-bottom:10px;
	padding:7px 20px 10px 20px;
	background-color:#211;
	color:white;
}

.Wrapper ul {
	padding:2px 0px 5px 20px;
}
.Wrapper ul li, .Wrapper p {
	padding:4px 0px;
}

.Wrapper a {
	text-decoration:none;
	color:blue;
}

.Wrapper footer {
	background-color:#AAA;
	padding:8px;
	color:white;
	text-align:center;
}
.Wrapper footer a {
	color:white;
}

</style>

</head>

<body>

<div class="Wrapper">
<h1>Qlockworks Start</h1>
<p>
	Hello World, hier werden alle Projekte sowie Blog/Website der Entwicklergruppe Qlockworks aufgelistet.
</p>
<br />
<ul>
<?php

$dir = openDir(".");
while($file = readDir($dir)){
	if(is_dir($file) AND !preg_match("/^\./",$file)){
		echo '<li><a href="'.$file.'">'.$file.'</li>';
	}
}

?>
</ul>

<br />
<footer>
	<a href="http://www.qlockworks.de">qlockworks.de</a>
	&middot;
	<a href="http://www.clokcowkrs-revolution.de">clockworks-revolution.de</a>
	&middot;
	<a href="http://www.maecki.com">Maecki.com</a>
	&middot;
	<a href="http://www.benjaminhartl.de">Benjamin Hartl</a>
	&middot;
	<a href="http://www.bsm.de">bsm.de</a>
</footer>

</div>

</body>

</html>