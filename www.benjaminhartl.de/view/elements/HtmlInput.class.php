<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-04-07
 */
class HtmlInput extends HtmlClosedElement {
	
	protected $sReference="",$sSuggestValue="";
	
	public function __construct($name,$value="",$typ="text"){
		parent::__construct("input");
		$this->setType($typ);
		$this->setName($name);
		$this->setValue($value);
	}
	
	public function render(){
		$str = "";
		if($this->getSuggest() != ""){
			
			$hid = new self($this->getName()."_id",$this->getSuggestValue(),"hidden");
			if($this->getSuggestResp() == ""){
				if($this->getId() != ""){
					$hid->setId($this->getId()."_id");
				}else{
					$hid->setId("hidden".$this->getName().rand(1,time()));
				}
				$this->setSuggestResp("document.getElementById('".$hid->getId()."').value='[ID]';");
			}
			$str .= $hid->render();
		}
		if($this->getReference() != ""){
			$id = $this->getName()."-".rand(1,time());
			$this->setAttribute("onKeyUp","inputReference(this.value,'".$id."','".$this->getReference()."');");
			$this->setAttribute("onChange",$this->getAttribute("onKeyUp"));
			$str .= '<label class="InputWithReference"><span id="'.$id.'">'.$this->getReference().'</span>'.parent::render().'</label>';
		}else{
			$str .= parent::render();
		}
		return $str;
	}
	
	public function getType(){
		return $this->getAttribute("type");
	}
	public function setType($type){
		return $this->setAttribute("type",$type);
	}
	
	public function getName(){
		return $this->getAttribute("name");
	}
	public function setName($name){
		return $this->setAttribute("name",$name);
	}
	
	public function getValue(){
		return $this->getAttribute("value");
	}
	public function setValue($value){
		return $this->setAttribute("value",$value);
	}
	
	public function getReference(){
		return $this->sReference;
	}
	public function setReference($str){
		$this->sReference = $str;
	}
	
	public function getSuggest(){
		return $this->getAttribute("data-suggest");
	}
	public function setSuggest($suggest,$resp="",$clear=false){
		$this->setAttribute("data-suggest",$suggest);
		if($resp != ""){
			$this->setSuggestResp($resp);
		}
		if($clear){
			$this->setSuggestClear(true);
		}
	}
	
	/**
	 * Suggest-Response
	 * Use [ID] for suggest-value-id
	 * Use [VALUE] for suggest-value
	 * Use [HTML] for suggest-html
	 */
	public function getSuggestResp(){
		return $this->getAttribute("data-suggestresp");
	}
	public function setSuggestResp($resp){
		$this->setAttribute("data-suggestresp",$resp);
	}
	
	public function getSuggestClear(){
		return $this->getAttribute("data-suggestclear") == "y";
	}
	public function setSuggestClear($bool){
		$this->setAttribute("data-suggestclear",$bool ? "y" : "n");
	}
	
	public function getSuggestValue(){
		return $this->sSuggestValue;
	}
	public function setSuggestValue($val){
		$this->sSuggestValue = $val;
	}
}
?>