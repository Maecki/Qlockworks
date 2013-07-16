<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-04-07
 */
class HtmlCheckbox extends HtmlInput {
	
	protected $checkbox;
	
	public function __construct($name,$info){
		$this->bClosed = false;
		
		$this->checkbox = new HTMLInput($name,"y","checkbox");
		
		$this->setInner($info);
		$this->setTag("label");
	}
	
	public function setChecked($b){
		if($b){
			$this->checkbox->setAttribute("CHECKED");
		}else{
			$this->checkbox->delAttribute("CHECKED");
		}
	}
	
	public function getCheckbox(){
		return $this->checkbox;
	}
	public function getInner(){
		return '<table><tr><td width=20>'.$this->checkbox->render().'</td><td>'.$this->sInner.'</td></tr></table>';
	}
}
?>