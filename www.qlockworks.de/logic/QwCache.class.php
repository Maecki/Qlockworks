<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-26
 */
class QwCache {
	
	private $key="";
	
	public function __construct($key){
		$this->key = $key;
	}
	
	public function check($time){
		$file = "data/cache/".$this->key.".tpl";
		return (!file_exists($file) OR filemtime($file) <= $time*60);
	}
	
	public function setContent($content){
		QwFileManager::setContent("data/cache/".$this->key.".tpl",$content);
	}
	
	public function __toString(){
		return QwFileManager::getContent("data/cache/".$this->key.".tpl");
	}
}
?>