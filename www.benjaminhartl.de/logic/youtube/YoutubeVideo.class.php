<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-19
 */
class YoutubeVideo {
	
	protected $sId="",$sName="",$sDescription="";
	
	public function __toString(){
		return (string)$this->render();
	}
	
	public function render($mod=""){
		switch($mod){
			case "video":
				return '<iframe width="560" height="315" src="http://www.youtube.com/embed/'.$this->getId().'" frameborder="0" allowfullscreen></iframe>';
			case "description":
				$l = $this->getLink();
				$l->setInner('<img src="'.$this->getImage().'" class="Corner" />');
				return '<table width=100%><tr valign=top><td width=325>'.$l.'</td><td><h3>'.$this->getLink().'</h3><p>'.$this->getDescription().'</p></td></tr></table>';
			case "link":
				return (string)$this->getLink();
		}
	}
	
	public function getLink(){
		$link = new HtmlLink($this->getName(),"http://www.youtube.com/watch?v=".$this->getId());
		$link->setAttribute("title",$this->getName());
		$link->setAttribute("rel","vidbox");
		return $link;
	}
	
	public function getImage(){
		return 'http://i3.ytimg.com/vi/'.$this->getId().'/mqdefault.jpg';
	}
	
	public function getId(){
		return $this->sId;
	}
	public function setId($id){
		$this->sId = $id;
	}
	
	public function getName(){
		return $this->sName;
	}
	public function setName($name){
		$this->sName = $name;
	}
	
	public function getDescription(){
		return $this->sDescription;
	}
	public function setDescription($str){
		$this->sDescription = $str;
	}
}
?>