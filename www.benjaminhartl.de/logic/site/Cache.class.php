<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-20
 */
class Cache {
	
	protected $sKey="";
	
	public function __construct($key){
		$this->setKey($key);
	}
	
	public function check($m){
		return !file_exists($this->getFile()) OR filemtime($this->getFile()) < time()-($m*60);
	}
	
	public function setContent($str){
		FileManager::setContent($this->getFile(),$str);
	}
	
	public function getContent(){
		return FileManager::getContent($this->getFile());
	}
	
	public function getKey(){
		return $this->sKey;
	}
	public function setKey($key){
		$this->sKey = $key;
	}
	
	public function getFile(){
		return PATH_CACHE."/".$this->getKey().".tpl";
	}
}
?>