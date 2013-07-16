<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-04-07
 */
class HtmlLink extends HtmlElement {
	
	public function __construct($inner,$link="#"){
		parent::__construct("a",$inner);
		
		if($link != ""){
			$this->setHref($link);
		}
	}
	
	public function getHref(){
		return $this->getAttribute("href");
	}
	public function setHref($link){
		$this->setAttribute("href",$link);
	}
}
?>