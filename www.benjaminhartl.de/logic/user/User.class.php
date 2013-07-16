<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-07
 */
class User {
	
	protected $bLog=false,$aNavigationElements=array();
	
	public function __construct(){
		$this->loadNavigationElements();
	}
	
	public function isLoggedIn(){
		return $this->bLog;
	}
	
	public function login($nick,$pass){
		if(strtolower(LOGIN_USER) == strtolower($nick) AND $pass == LOGIN_PASS){
			$this->bLog = true;
		}
	}
	
	public function logout(){
		$this->bLog = false;
	}
	
	
	public function loadNavigationElements(){
		$this->aNavigationElements = array();
		$xml = @simplexml_load_file(PATH_ROOT."/data/navigation.xml");
		$i = 0;
		foreach($xml AS $obj){
			$i++;
			$e = new NavigationElement($this,$obj);
			$this->setNavigationElement($e);
		}
	}
	public function safeNavigationElements(){
		$a = array();
		foreach($this->aNavigationElements AS $e){
			if(!isset($a[$e->getSort()])){
				$a[$e->getSort()] = array();
			}
			$a[$e->getSort()][] = $e;
		}
		ksort($a);
		$xml = '<?xml version="1.0" encoding="UTF-8"?><data>';
		foreach($a AS $b){
			foreach($b AS $e){
				$xml .= '<site key="'.$e->getKey().'" typ="'.$e->getType().'" public="'.($e->isPublic() ? "y" : "n").'"><![CDATA['.$e->getName().']]></site>';
			}
		}
		FileManager::setContent(PATH_ROOT."/data/navigation.xml",$xml.'</data>');
	}
	public function getNavigationElements($parent=0){
		$a = array();
		foreach($this->aNavigationElements AS $element){
			$a[$element->getKey()] = $element;
		}
		return $a;
	}
	public function getNavigationElement($id){
		if(isset($this->aNavigationElements[$id])){
			return $this->aNavigationElements[$id];
		}
	}
	public function setNavigationElement(NavigationElement $element){
		if($element->getSort() == 0){
			$element->setSort(count($this->aNavigationElements)+1);
		}
		$this->aNavigationElements[$element->getKey()] = $element;
	}
	public function unsetNavigationElement($id){
		unset($this->aNavigationElements[$id]);
	}
	
	public function delSite($key){
		$m = new TplManager($this,$key);
		$m->delete();
		$this->unsetNavigationElement($key);
		$this->safeNavigationElements();
	}
}
?>