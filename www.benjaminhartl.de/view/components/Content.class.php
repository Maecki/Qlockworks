<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-07
 */
class Content {
	
	protected $user,$item;
	
	public function __construct(User $user,NavigationElement $item){
		$this->setUser($user);
		$this->setNavigationElement($item);
	}
	
	public function __toString(){
		switch($this->getNavigationElement()->getType()){
			case "blog":
				$bc = new Cache("blogger");
				if($bc->check(60)){
					$bg = new BloggerReader($this->getUser());
					$bc->setContent((string)$bg);
				}
				return "<br /><h1>Bene-Maecki @ Blogspot</h1>".$bc->getContent();
			case "gallery":
				$gm = new GalleryManager($this->getUser());
				return (string)$gm;
			case "youtube":
				$yc = new Cache("youtube");
				if($yc->check(60)){
					$yt = new YoutubeReader("DesireBene");
					$yc->setContent((string)$yt);
				}
				return '<br /><h1>Videos</h1>'.$yc->getContent().'<p align=right><a href="http://www.youtube.com/user/DesireBene" target="_blank"><img src="'.PATH_WEB.'/data/graphics/social/youtube.png" /></a></p>';
			case "contact":
				$c = new MailContact($this->getUser());
				return (string)$c;
			default:
				$tpl = new TplManager($this->getUser(),$this->getNavigationElement()->getKey());
				return (string)$tpl;
		}
	}
	
	public function getUser(){
		return $this->user;
	}
	public function setUser(User $user){
		$this->user = $user;
	}
	
	public function getNavigationElement(){
		return $this->item;
	}
	public function setNavigationElement($item){
		$this->item = $item;
	}
	
	public static function getArray(){
		return array("site"=>"Seite","blog"=>"Blogger","gallery"=>"Galerie","youtube"=>"Youtube","contact"=>"Kontakt");
	}
}
?>