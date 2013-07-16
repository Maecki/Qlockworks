<?php
/**
 * Copyright 2012 @  Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-14
 */
class XmlManager {
	
	protected $sFile="",$aData=array();
	
	public function __construct($file){
		$this->setFile($file);
	}
	
	public function load(){
		if($xml = @simplexml_load_file($this->getFile() AND isset($xml->row))){
			
			$this->aData = $this->toArray($xml->row);
			
			return true;
		}else{
			return false;
		}
	}
	
	public function safe(){
		return FileManager::setContent($this->getFile(),'<?xml version="1.0" encoding="UTF-8"?><data>'.$this->toXml($this->aData).'</data>');
	}
	
	protected function toArray($xml){
		if(is_array($xml)){
			$a = array();
			foreach($xml AS $val){
				$a[(string)$val->attributes()->id] = $this->toArray($val);
			}
			return $a;
		}else{
			return (string)$xml;
		}
	}
	protected function toXml($val){
		if(is_array($val)){
			$str = "";
			foreach($val AS $k=>$v){
				$str .= '<row id="'.$k.'"><![CDATA['.$this->toXml($v).']]></row>';
			}
			return $str;
		}else{
			return $val;
		}
	}
	
	public function getData(){
		return $this->aData;
	}
	public function get($key){
		if(isset($this->aData[$key])){
			return $this->aData[$key];
		}
	}
	public function set($key,$val){
		$this->aData[$key] = $val;
	}
	
	public function getFile(){
		return $this->sFile;
	}
	public function setFile($file){
		$this->sFile = $file;
	}
}
?>