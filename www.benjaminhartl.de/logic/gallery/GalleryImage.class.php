<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-21
 */
class GalleryImage {
	
	protected $gallery=null,$iId=0,$sName="",$sFile="",$bDelete=false;
	
	public function __construct(Gallery $gallery,$xml=null){
		$this->setGallery($gallery);
		if($xml != null){
			$this->setDataFromXml($xml);
		}
	}
	
	public function setDataFromXml($xml){
		$this->setId((string)$xml->attributes()->id);
		$this->setFile((string)$xml->attributes()->file);
		$this->setName((string)$xml);
	}
	
	public function __toString(){
		return (string)$this->render();
	}
	
	public function render(){
		$img = new HtmlClosedElement("img");
		$img->setAttribute("src",$this->getFile("pr"));
		$img->setAttribute("alt",$this->getName());
		return $img;
	}
	
	public function upload($src){
		$this->setFile(Utils::prefixZeros($this->getId(),6));
		$to = PATH_ROOT."/data/graphics/images/".$this->getFile();
		if(FileManager::uploadImage($src,$to."_pr.jpg",180,180)){
			FileManager::uploadImage($src,$to."_lo.jpg",800);
			return true;
		}else{
			return false;
		}
	}
	public function delete(){
		@unlink(PATH_ROOT."/data/graphics/images/".$this->getFile()."_pr.jpg");
		@unlink(PATH_ROOT."/data/graphics/images/".$this->getFile()."_lo.jpg");
		$this->setDeleted(true);
	}
	
	public function getGallery(){
		return $this->gallery;
	}
	public function setGallery(Gallery $gallery){
		$this->gallery = $gallery;
	}
	
	public function getId(){
		return $this->iId;
	}
	public function setId($id){
		$this->iId = $id;
	}
	
	public function getName(){
		return $this->name;
	}
	public function setName($name){
		$this->name = $name;
	}
	
	public function getFile($end=""){
		if($end != ""){
			return PATH_WEB."/data/graphics/images/".$this->sFile."_".$end.".jpg";
		}else{
			return $this->sFile;
		}
	}
	public function setFile($file){
		$this->sFile = $file;
	}
	
	public function isDeleted(){
		return $this->bDelete;
	}
	public function setDeleted($b){
		$this->bDelete = $b;
	}
	
	public function getLink(){
		$a = new HtmlLink($this->getName(),$this->getFile("lo"));
		$a->setAttribute("title",$this->getName());
		$a->setAttribute("rel","imgbox");
		return $a;
	}
}
?>