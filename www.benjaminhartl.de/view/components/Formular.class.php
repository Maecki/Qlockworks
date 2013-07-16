<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-04-07
 */
class Formular extends HtmlElement {
	
	private $bSuggest, $bUpload, $bSubmit, $table, $submit, $iDescriptionWidth=0;
	
	
	public function __construct($action,$method="post"){
		
		parent::__construct("form");
		
		$this->setAction($action);
		$this->setMethod($method);
		
		$this->submit = new HtmlInput("submit","OK","submit");
		$this->table = new Table();
		$this->table->setAttribute("class","FormTable");
	}
	
	
	public function addRow($description, HtmlElement $htmlElement){
		if($htmlElement instanceof HtmlInput AND $htmlElement->getType() == "file"){
			$this->bUpload = true;
		}
		$i = $this->table->addRow(array($description,$htmlElement));
		$this->table->getRow($i)->getColumn(0)->setAttribute("align","right");
		return $i;
	}
	
	
	public function render(){
		if($this->bUpload){
			$this->setAttribute("enctype","multipart/form-data");
		}
		if($this->bSuggest){
			$this->setAttribute("onSubmit","return formSubmitSuggest();");
		}
		if($this->submit instanceof HtmlElement){
			$i = $this->addRow("",$this->submit);
			if($this->iDescriptionWidth > 0){
				$this->getTable()->getRow($i)->setAttribute("width",$this->getDescriptionWidth());
			}
		}
		return $this->getStartTag().$this->table->render().$this->getEndTag();
	}
	
	public function setFileUpload($bool){
		$this->bUpload = $bool;
	}
	
	public function getTable(){
		return $this->table;
	}
	public function setTable(Table $table){
		$this->table = $table;
	}
	
	public function getSubmit(){
		return $this->submit;
	}
	public function setSubmit($submit){
		$this->submit = $submit;
	}
	
	public function getDescriptionWidth(){
		return $this->iDescriptionWidth;
	}
	public function setDescriptionWidth($width){
		$this->iDescriptionWidth = $width;
	}
	
	public function getAction(){
		return $this->getAttribute("action");
	}
	public function setAction($action){
		$this->setAttribute("action",$action);
	}
	
	public function getMethod(){
		return $this->getAttribute("method");
	}
	public function setMethod($method){
		$this->setAttribute("method",$method);
	}
}
?>