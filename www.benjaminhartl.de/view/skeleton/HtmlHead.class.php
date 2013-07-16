<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-07
 */
class HtmlHead extends SkeletonSection {
	
	protected $sTitle="",$aStyles=array(),$aScripts=array();
	
	public function __toString(){
		$str = '
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<meta name="author" content="Benjamin Hartl" />
			<meta name="description" content="'.$this->getTitle().'. '.HEADER_DESCRIPTION.'" />
			<meta name="keywords" content="'.HEADER_KEYWORDS.'" />
			<meta name="revisit-after" content="4 days" />
			<meta name="robots" content="index, follow" />
			<meta name="language" content="Deutschland, de" />
			<meta http-equiv="content-language" content="Deutschland, de" />
			<link href="'.HEADER_FAVICON.'" rel="shortcut icon" type="image/png" />
			<title>'.$this->getTitle().'</title>';
		
		foreach($this->aStyles AS $style){
			$str .= '<link rel="stylesheet" href="'.$style.'" />';
		}
		foreach($this->aScripts AS $script){
			$str .= '<script type="text/javascript" src="'.$script.'"></script>';
		}
		
		$str .= '<!-- Place this tag in your head or just before your close body tag. -->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: "de"}
</script>';
		
		return $str;
	}
	
	public function addStyle($src){
		$this->aStyles[] = $src;
	}
	
	public function addScript($src){
		$this->aScripts[] = $src;
	}
	
	public function getTitle(){
		return $this->sTitle.($this->sTitle != "" ? " | " : "").HEADER_TITLE;
	}
	public function setTitle($title){
		$this->sTitle = $title;
	}
}
?>