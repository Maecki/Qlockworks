<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-04-07
 */
class HtmlTextarea extends HtmlInput {
	
	protected $iMaxChars;
	
	public function __construct($name, $text=""){
		parent::__construct($name);
		
		$this->bClosed		= false;
		$this->iMaxChars	= 0;
		
		$this->setTag("textarea");
		$this->delAttribute("type");
		$this->setAttribute("style","width:95%;height:70px;");
		$this->setInner($text);
	}
	
	public function getValue(){
		return $this->getInner();
	}
	public function setValue($val){
		$this->setInner($val);
	}
	
	public function getMaxChars(){
		return $this->iMaxChars;
	}
	public function setMaxChars($i){
		$this->iMaxChars = $i;
	}
	
	public function render(){
		$str = '';
		if($this->getMaxChars() > 0){
			$this->setAttribute("onKeyUp","checkMaxChars(this,".$this->getMaxChars().");");
			$this->setAttribute("onBlur","checkMaxChars(this,".$this->getMaxChars().");");
			$str = '<div class="small">Noch <span id="'.$this->getName().'maxChars">'.$this->getMaxChars().'</span> Zeichen</div>';
		}
		return parent::render().$str;
	}
}
?>