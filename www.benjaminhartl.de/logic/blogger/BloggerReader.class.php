<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-09-16
 */
class BloggerReader {
	
	protected $aEntries=array();
	
	public function __construct(){
		if($xml = @simplexml_load_file("http://bene-maecki.blogspot.com/feeds/posts/default")){
			$i = 0;
			foreach($xml->entry AS $x){
				$this->aEntries[] = new BloggerEntry($x);
				$i++;
				if($i > 5){
					break;
				}
			}
		}
	}
	
	public function __toString(){
		$str = "";
		foreach($this->aEntries AS $e){
			if($str != ""){
				$str .= "<br /><br />";
			}
			$str .= (string)$e;
		}
		$more = new HtmlLink('&raquo; Mehr Eintr&auml;ge anzeigen',"http://bene-maecki.blogspot.com");
		$more->setAttribute("target","_blank");
		$str .= "<br /><br />".$more;
		return $str;
	}
}
?>