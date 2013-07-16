<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-04-07
 */
class HtmlElement {
	
	protected $sTag="",$sInner="",$aAttributes=array(),$bClosed=false;
	
	public function __construct($tag,$inner=""){
		$this->sTag = $tag;
		$this->sInner = $inner;
	}
	
	public function __toString(){
		return $this->render();
	}
	
	public function render(){
		$str = $this->getStartTag();
		if(!$this->getClosed()){
			$str .= $this->getInner().$this->getEndTag();
		}
		return $str;
	}
	
	public function getStartTag(){
		$str = '<'.$this->getTag();
		foreach($this->aAttributes AS $key=>$val){
			$str .= ' ';
			if($val != ""){
				$str .= $key.'="'.$val.'"';
			}else{
				$str .= $key;
			}
		}
		if($this->getClosed()){
			return $str.' />';
		}else{
			return $str.'>';
		}
	}
	public function getEndTag(){
		if(!$this->getClosed()){
			return '</'.$this->getTag().'>';
		}
	}
	

	public function getTag(){
		return $this->sTag;
	}
	public function setTag($tag){
		$this->sTag = $tag;
	}
	
	public function getInner(){
		return $this->sInner;
	}
	public function setInner($inner){
		if(!$this->getClosed()){
			$this->sInner = $inner;
		}
	}
	
	public function getValue(){
		return $this->getInner();
	}
	public function setValue($val){
		$this->setInner($val);
	}
	
	public function getId(){
		return $this->getAttribute("id");
	}
	public function setId($id){
		$this->setAttribute("id",$id);
	}
	
	public function getTitle(){
		return $this->getAttribute("title");
	}
	public function setTitle($title){
		$this->setAttribute("title",$title);
	}
	
	public function getClass(){
		return $this->getAttribute("class");
	}
	public function setClass($class){
		$this->setAttribute("class",$class);
	}
	
	public function getClosed(){
		return $this->bClosed;
	}
	public function setClosed($b){
		$this->bClosed = $b;
	}
	
	public function setAttribute($key,$val=""){
		$this->aAttributes[$key] = $val;
	}
	public function getAttribute($key){
		if(isset($this->aAttributes[$key])){
			return $this->aAttributes[$key];
		}
	}
	public function delAttribute($key){
		unset($this->aAttributes[$key]);
	}
}
?>