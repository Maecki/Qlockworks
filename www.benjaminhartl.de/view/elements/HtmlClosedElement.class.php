<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-04-07
 */
class HtmlClosedElement extends HtmlElement {
	
	public function __construct($tag){
		parent::__construct($tag);
		$this->setClosed(true);
	}
}
?>