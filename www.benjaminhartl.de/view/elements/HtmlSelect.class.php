<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-04-07
 */
class HtmlSelect extends HtmlInput {
	
	protected $aOptions,$iSelect;
	
	public function __construct($name){
		parent::__construct($name);
		$this->bClosed = false;
		$this->setTag("select");
		$this->delAttribute("type");
	}
	
	
	public function getInner(){
		$str = "";
		foreach($this->aOptions AS $key=>$value){
			$option = new HTMLElement("option");
			$option->setAttribute("value",$key);
			$option->setInner($value);
			if($this->iSelect == $key){
				$option->setAttribute("SELECTED");
			}
			$str .= $option->render();
		}
		return $str;
	}
	
	
	public function getValue(){
		$i = 0;
		foreach($this->aOptions AS $value){
			if($i == $this->iSelect){
				return $value;
			}
			$i++;
		}
	}
	public function setValue(){}
	
	
	public function getSelect(){
		return $this->iSelect;
	}
	public function setSelect($i){
		$this->iSelect = $i;
	}
	
	public function getOptions(){
		return $this->aOptions;
	}
	public function setOptions($a){
		$this->aOptions = $a;
	}
}
?>