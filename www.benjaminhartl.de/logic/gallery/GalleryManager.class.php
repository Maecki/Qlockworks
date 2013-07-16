<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-21
 */
class GalleryManager {
	
	protected $iId=0,$aGalleries=array(),$aImages=array(),$user=null;
	
	public function __construct(User $user){
		$this->setUser($user);
		if($xml = @simplexml_load_file(PATH_ROOT."/data/galleries.xml")){
			foreach($xml->gallery AS $obj){
				$g = new Gallery($this->getUser(),$obj);
				$g->setManager($this);
				$this->setGallery($g);
			}
			
			if($xml = @simplexml_load_file(PATH_ROOT."/data/images.xml")){
				foreach($xml->image AS $obj){
					$g = $this->getGallery((int)$obj->attributes()->gallery);
					if($g instanceof Gallery){
						$i = new GalleryImage($g,$obj);
						$this->setImage($i);
						$g->setImage($i);
					}
				}
			}
		}
	}
	
	public function __toString(){
		$str = '<br /><h1>Bilder</h1>';
		if($this->getUser()->isLoggedIn()){
			$g = new Gallery($this->getUser());
			$str .= '<br />'.$g->getFormular();
		}
		$li = "";
		foreach($this->aGalleries AS $g){
			if($g->isPublic() OR $this->getUser()->isLoggedIn()){
				$li = '<li class="Float">'.$g->getPreview().'</li>'.$li;
			}
		}
		return $str.'<ul class=Gallery>'.$li.'<li class="Clear"></li></ul>';
	}
	
	public function safe(){
		$str = '<?xml version="1.0" encoding="UTF-8"?><data>';
		foreach($this->aGalleries AS $g){
			if(!$g->isDeleted()){
				$str .= '<gallery id="'.$g->getId().'" public="'.($g->isPublic() ? "y" : "n").'"><![CDATA['.$g->getName().']]></gallery>';
			}
		}
		$str .= '</data>';
		FileManager::setContent(PATH_ROOT."/data/galleries.xml",$str);
	}
	
	public function safeImages(){
		$str = '<?xml version="1.0" encoding="UTF-8"?><data>';
		foreach($this->aImages AS $img){
			if(!$img->isDeleted() AND !$img->getGallery()->isDeleted()){
				$str .= '<image id="'.$img->getId().'" gallery="'.$img->getGallery()->getId().'" file="'.$img->getFile().'"><![CDATA['.$img->getName().']]></image>';
			}
		}
		$str .= '</data>';
		FileManager::setContent(PATH_ROOT."/data/images.xml",$str);
	}
	
	public function delGallery($id){
		if(isset($this->aGalleries[$id])){
			$this->aGalleries[$id]->delete();
			unset($this->aGalleries[$id]);
		}
	}
	
	public function getOptions(){
		$a = array();
		foreach($this->aGalleries AS $g){
			$a[$g->getId()] = $g->getName();
		}
		return $a;
	}
	
	public function getUser(){
		return $this->user;
	}
	public function setUser(User $user){
		$this->user = $user;
	}
	
	public function getGalleries(){
		return $this->aGalleries;
	}
	public function getGallery($id){
		if(isset($this->aGalleries[$id])){
			return $this->aGalleries[$id];
		}
	}
	public function setGallery(Gallery $g){
		if($g->getId() == 0){
			$id = 1;
			foreach($this->aGalleries AS $gi){
				if($id <= $gi->getId()){
					$id = $gi->getId()+1;
				}
			}
			$g->setId($id);
		}
		$this->aGalleries[$g->getId()] = $g;
	}
	
	public function getImages(){
		return $this->aImages;
	}
	public function getImage($id){
		if(isset($this->aImages[$id])){
			return $this->aImages[$id];
		}
	}
	public function setImage(GalleryImage $img){
		if($img->getId() == 0){
			$id = 1;
			foreach($this->aImages AS $i){
				if($id <= $i->getId()){
					$id = $i->getId()+1;
				}
			}
			$img->setId($id);
		}
		$this->aImages[$img->getId()] = $img;
		return $img->getId();
	}
}
?>