<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-26
 */
final class QwFileManager {
	
	public static function getContent($file){
		return file_get_contents($file);
	}
	
	public static function setContent($file,$content){
		if($f = fopen($file,"w+")){
			fwrite($f,$content);
			fclose($f);
			return true;
		}
		return false;
	}
}
?>