<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-21
 */
class Gallery {
	
	protected $user=null,$iId=0,$sName="",$aImages=array(),$manager=null,$bDeleted=false,$bPublic=true;
	
	public function __construct(User $user,$xml=null){
		$this->setUser($user);
		if($xml != null){
			$this->setDataFromXml($xml);
		}
	}
	
	public function setDataFromXml($xml){
		$this->setId((int)$xml->attributes()->id);
		$this->setPublic((string)$xml->attributes()->public == "y");
		$this->setName((string)$xml);
	}
	
	public function __toString(){
		$str = '<h1>'.$this->getName().'</h1>';
		$back = new Gallery($this->getUser());
		$back->setName("Bilder");
		$link = $back->getLink();
		$link->setInner("&laquo; zur&uuml;ck zur &Uuml;bersicht");
		$str .= (string)$link."<br /><br />";
		if($this->getUser()->isLoggedIn()){
			$str .= $this->getFormular();
			
			$form = new Formular(PATH_WEB."/ajax/gallery.php?id=".$this->getId());
			$form->setAttribute("target","iframe");
			$form->setAttribute("onSubmit","return iframeResp('uploadResp')");
			$form->setSubmit(null);
			$form->setFileUpload(true);
			$i = $form->getTable()->addRow(array(new HtmlInput("img","","file"),new HtmlInput("","Hochladen","submit")));
			$form->getTable()->getRow($i)->getColumn(0)->setAttribute("width",250);
			$str .= '<br /><div id="uploadResp"></div><b>Neues Bild Hochladen</b>'.(string)$form;
		}
		$li = "";
		foreach($this->aImages AS $img){
			$link = $img->getLink();
			$link->setInner($img->render());
			$edit = "";
			if($this->getUser()->isLoggedIn()){
				$form = new Formular(PATH_WEB."/ajax/gallery.php?img_id=".$img->getId());
				$form->setAttribute("target","iframe");
				$form->setAttribute("onSubmit","return iframeResp('uploadResp')");
				$form->getSubmit()->setValue("Speichern");
				
				$name = new HtmlInput("name",$img->getName());
				$name->setAttribute("style","width:110px");
				$form->addRow("Name",$name);
				
				$sele = new HtmlSelect("gid");
				$sele->setOptions($this->getManager()->getOptions());
				$sele->setSelect($this->getId());
				$sele->setAttribute("style","width:110px");
				$form->addRow("Galerie",$sele);
				
				$edit .= (string)$form;
				
				$del = new HtmlLink("l&ouml;schen");
				$del->setAttribute("class","delete");
				$del->setAttribute("onClick","return imgdel('".$img->getId()."')");
				$edit .= (string)$del;
			}
			$li = '<li class="Float">'.$link.$edit.'</li>'.$li;
		}
		return $str.'<ul class="Gallery">'.$li.'<li class="Clear"></li></ul>';
	}
	
	public function delete(){
		foreach($this->aImages AS $img){
			$img->delete();
		}
		$this->setDeleted(true);
	}
	
	public function getPreview(){
		$img = "";
		foreach($this->aImages AS $image){
			$img = '<img src="'.$image->getFile("pr").'" alt="'.$this->getName().'" class="Corner" />';
		}
		if($img == ""){
			$img = '<img src="'.PATH_WEB.'/data/graphics/css/sorry.png" class="Corner" />';
		}
		$link = $this->getLink();
		$link->setAttribute("class","Corner");
		$link->setInner($img.'<b class="Corner-Bottom">'.$this->getName().'</b>');
		return $link;
	}
	
	public function getFormular(){
		$form = new Formular(PATH_WEB."/ajax/gallery.php?id=".$this->getId());
		$form->setAttribute("target","iframe");
		$form->setAttribute("onSubmit","return iframeResp('galleryResp')");
		$submit = new HtmlInput("",$this->getId() > 0 ? "&Auml;ndern" :"Erstellen","submit");
		$del = "";
		if($this->getId() > 0){
			$link = new HtmlLink("l&ouml;schen");
			$link->setAttribute("onClick","return galdel('".$this->getId()."')");
			$del .= ' oder '.$link;
		}
		$check = new HtmlCheckbox("public","&Ouml;ffentlich");
		$check->setChecked($this->isPublic());
		$i = $form->getTable()->addRow(array(new HtmlInput("name",$this->getName()),$check,$submit.$del));
		$form->getTable()->getRow($i)->getColumn(0)->setAttribute("width",250);
		$form->setSubmit(null);
		return '<div id="galleryResp"></div><b>'.($this->getId() > 0 ? 'Galerie bearbeiten' : 'Neue Galerie erstellen').'</b>'.(string)$form;
	}
	
	public function getUser(){
		return $this->user;
	}
	public function setUser(User $user){
		$this->user = $user;
	}
	
	public function getId(){
		return $this->iId;
	}
	public function setId($id){
		$this->iId = $id;
	}
	
	public function getName(){
		return $this->sName;
	}
	public function setName($name){
		$this->sName = $name;
	}
	
	public function getImages(){
		return $this->aImages;
	}
	public function getImage($id){
		if(isset($this->aImages[$id])){
			return $this->aImages[$id];
		}
	}
	public function setImage(GalleryImage $image){
		$this->aImages[$image->getId()] = $image;
	}
	public function delImage($id){
		if(isset($this->aImages[$id])){
			$this->aImages[$id]->delete();
			$this->getManager()->safeImages();
			unset($this->aImages[$id]);
		}
	}
	
	public function getManager(){
		return $this->manager;
	}
	public function setManager(GalleryManager $gm){
		$this->manager = $gm;
	}
	
	public function isDeleted(){
		return $this->bDeleted;
	}
	public function setDeleted($b){
		$this->bDeleted = $b;
	}
	
	public function isPublic(){
		return $this->bPublic;
	}
	public function setPublic($b){
		$this->bPublic = $b;
	}
	
	public function getLink(){
		$link = new HtmlLink($this->getName(),PATH_WEB."/gallery".(HTACCESS == "y" ? "/".$this->getId().".".Utils::urlEncode($this->getName()).".html" : ".php?id=".$this->getId()));
		$link->setAttribute("data-id",$this->getId());
		$link->setAttribute("data-name",$this->getName());
		$link->setAttribute("onClick","return gallery(this)");
		return $link;
	}
}
?>