<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-07
 */

include("include/core.inc.php");

$_SESSION["user"]->logout();

header("Location: ".PATH_WEB);
?>