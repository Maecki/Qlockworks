<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-04-06
 */
class HtmlEditor extends HtmlTextarea {
	
	public function __construct($name,$value=""){
		parent::__construct($name,$value);
		$this->setAttribute("data-key","htmleditor");
		$this->setAttribute("style","width:100%");
		$this->setId($this->getName());
	}
}
?>