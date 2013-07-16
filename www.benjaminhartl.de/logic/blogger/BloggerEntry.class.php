<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-09-16
 */
class BloggerEntry {
	
	protected $iStamp="",$sName="",$sText="",$sLink="";
	
	public function __construct($xml=null){
		if($xml != null){
			$this->setDataFromXml($xml);
		}
	}
	
	public function setDataFromXml($xml){
		$this->setStamp(strtotime((string)$xml->published));
		$this->setName((string)$xml->title);
		$this->setText((string)$xml->content);
		foreach($xml->link AS $l){
			if((string)$l->attributes()->rel == "alternate"){
				$this->setLink((string)$l->attributes()->href);
			}
		}
	}
	
	public function __toString(){
		return "<br /><h2>".$this->getName()."</h2>".$this->getText().'<table class="BloggerPost"><tr><td width=80>'.Utils::inaccurateTime($this->getStamp()).'</td><td width=80><div class="g-plusone" data-size="small" data-href="'.$this->getLink().'"></div></td><td>'.$this->getLink(true).'</td></tr></table>';
	}
	
	public function getStamp(){
		return $this->iStamp;
	}
	public function setStamp($i){
		$this->iStamp = $i;
	}
	
	public function getName(){
		return $this->sName;
	}
	public function setName($name){
		$this->sName = $name;
	}
	
	public function getText(){
		return $this->sText;
	}
	public function setText($text){
		$this->sText = $text;
	}
	
	public function getLink($link=false){
		if($link){
			$l = new HtmlLink("Zum Eintrag &raquo;",$this->sLink);
			$l->setAttribute("target","_blank");
			return $l;
		}
		return $this->sLink;
	}
	public function setLink($link){
		$this->sLink = $link;
	}
}
?>