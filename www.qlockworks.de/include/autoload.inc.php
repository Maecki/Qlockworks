<?php
/**
 * Copyright 2013 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-23
 */

function __autoload($class){
	switch(strtolower($class)){
		case "qwskeleton":
			require_once("view/".$class.".class.php");
			break;
		case "qwobject":
			require_once("logic/".$class.".interface.php");
			break;
		default:
			require_once("logic/".$class.".class.php");
			break;
	}
}
?>