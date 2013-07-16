<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-04-07
 */
class TableRow extends HtmlElement {
	
	protected $aCols;
	
	public function __construct(){
		parent::__construct("tr");
	}
	
	public function addColumn(HtmlElement $htmlElement){
		$i = count($this->aCols);
		$this->aCols[$i] = $htmlElement;
		return $i;
	}
	public function getColumn($i){
		return $this->aCols[$i];
	}
	
	public function getInner(){
		$str = "";
		foreach($this->aCols AS $col){
			$str .= $col->render();
		}
		return $str;
		
	}
	public function setInner($str){}
}
?>