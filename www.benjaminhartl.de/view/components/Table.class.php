<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-04-07
 */
class Table extends HtmlElement {
	
	protected $aRow=array();
	
	public function __construct(){
		parent::__construct("table");
	}
	
	public function getRows(){
		return $this->aRow;
	}
	public function getRow($i){
		if(isset($this->aRow[$i])){
			return $this->aRow[$i];
		}
	}
	public function addRow($aElements=""){
		if(!is_array($aElements)){
			$aElements = array($aElements);
		}
		$i = count($this->aRow);
		$this->aRow[$i] = new TableRow();
		foreach($aElements AS $element){
			if(!($element instanceof HtmlElement AND $element->getTag() == "td")){
				$element = new HtmlElement("td",$element);
			}
			$this->aRow[$i]->addColumn($element);
		}
		return $i;
	}

	public function getInner(){
		$str = "";
		foreach($this->aRow AS $row){
			$str .= $row->render();
		}
		return $str;
	}
	public function setInner($str){}
}
?>