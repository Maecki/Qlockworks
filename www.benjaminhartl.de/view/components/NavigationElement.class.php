<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-14
 */
class NavigationElement {
	
	protected $user,$sKey="",$sType="",$sName="",$bPublic=true,$iSort=0;
	
	public function __construct(User $user,$xml=null){
		$this->setUser($user);
		if($xml != null){
			$this->setDataFromXml($xml);
		}
	}
	
	public function setDataFromXml($xml){
		$this->setKey((string)$xml->attributes()->key);
		$this->setType((string)$xml->attributes()->typ);
		$this->setPublic((string)$xml->attributes()->public == "y");
		$this->setName((string)$xml);
	}
	
	public function __toString(){
		return (string)$this->getLink();
	}
	
	public function getFormular(){
		$form = new Formular(PATH_WEB."/ajax/page.php?act=editSite");
		$form->getSubmit()->setValue($this->getKey() != "" ? "Speichern" : "Erstellen");
		$form->setAttribute("target","iframe");
		$form->setAttribute("onSubmit","return iframePost('neresp')");
		
		$form->addRow($this->getKey() != "" ? "" : "Schl&uuml;ssel",new HtmlInput("key",$this->getKey(),$this->getKey() != "" ? "hidden" : "text"));
		$form->addRow("Name",new HtmlInput("name",$this->getName()));
		
		$s = new HtmlSelect("type");
		$a = Content::getArray();
		$s->setOptions($a);
		$s->setSelect($this->getType());
		$form->addRow("Typ",$s);
		
		$c = new HtmlCheckbox("public","&Ouml;ffentlich");
		$c->setChecked($this->isPublic());
		$form->addRow("",$c);
		
		return '<div id="neresp"></div>'.$form;
	}
	
	public function getLink(){
		$link = new HtmlLink($this->getName(),PATH_WEB."/".(HTACCESS == "y" ? $this->getKey().".html" : "index.php?key=".$this->getKey()));
		$link->setAttribute("data-key",$this->getKey());
		$link->setAttribute("onClick","return show(this)");
		return $link;
	}
	
	public function getUser(){
		return $this->user;
	}
	public function setUser(User $user){
		$this->user = $user;
	}
	
	public function getKey(){
		return $this->sKey;
	}
	public function setKey($key){
		$this->sKey = $key;
	}
	
	public function getType(){
		return $this->sType;
	}
	public function setType($typ){
		$this->sType = $typ;
	}
	
	public function isPublic(){
		return $this->bPublic;
	}
	public function setPublic($b){
		$this->bPublic = $b;
	}
	
	public function getName(){
		return $this->sName;
	}
	public function setName($name){
		$this->sName = $name;
	}
	
	public function getSort(){
		return $this->iSort;
	}
	public function setSort($i){
		$this->iSort = $i;
	}
}
?>