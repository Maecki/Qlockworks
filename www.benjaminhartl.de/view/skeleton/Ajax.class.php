<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-03-28
 */
final class Ajax {
	
	/**
	 * Show Header-Informations for HTML
	 * @param $str : html
	 */
	public static function out($str){
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT");
		header("Cache-Control: no-cache, must-revalidate");
		header("Pragma: no-cache");
		header("Content-Type: text/html; charset=utf-8");
		
		echo $str;
	}
}
?>