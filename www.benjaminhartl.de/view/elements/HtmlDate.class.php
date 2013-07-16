<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-04-07
 */
class HtmlDate extends HtmlInput {
	
	public function __construct($name,$value){
		parent::__construct($name,$value);
		$this->setAttribute("id",$name);
		$this->setAttribute("data-key","datepicker");
	}
}
?>