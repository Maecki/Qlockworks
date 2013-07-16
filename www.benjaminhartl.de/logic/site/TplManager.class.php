<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-27
 */
class TplManager {
	
	protected $sKey="",$user=null,$sText="";
	
	public function __construct(User $user,$key){
		$this->setUser($user);
		$this->setKey($key);
	}
	
	public function __toString(){
		$str = "";
		if($this->getUser()->isLoggedIn()){
			$link = new HtmlLink("Bearbeiten");
			$link->setAttribute("onClick","return ajaxPost('page','editTpl','key=".$this->getKey()."','content')");
			$str .= (string)$link;
		}
		$str .= "<br />".Utils::mailEncode($this->getText());
		return $str;
	}
	
	public function getFormular(){
		$text = WYSWYG == "y" ? new HtmlEditor("html",$this->getText()) : new HtmlTextarea("html",$this->getText());
		$text->setAttribute("style","width:98%;height:400px;");
		
		$submit = new HtmlInput("","Speichern","submit");
		$link = new HtmlLink("Abbrechen");
		$link->setAttribute("onClick","return ajaxPost('page','cancelTpl','key=".$this->getKey()."','content')");
		
		$hid = new HtmlInput("key",$this->getKey(),"hidden");
		
		$form = new HtmlElement("form",$text.$hid."<p>".$submit." ".$link."</p>");
		$form->setAttribute("action",PATH_WEB."/ajax/page.php?act=safeTpl");
		$form->setAttribute("method","post");
		$form->setAttribute("target","iframe");
		$form->setAttribute("onSubmit","return iframeResp('tplResp')");
		
		$str = '<br /><div id="rplResp"></div>';
		$str .= (string)$form;
		
		return $str;
	}
	
	public function getUser(){
		return $this->user;
	}
	public function setUser(User $user){
		$this->user = $user;
	}
	
	public function getKey(){
		return $this->sKey;
	}
	public function setKey($key){
		$this->sKey = $key;
	}
	
	public function getFile(){
		return PATH_ROOT."/data/sites/".$this->getKey().".tpl";
	}
	
	public function delete(){
		@unlink($this->getFile());
	}
	
	public function getText(){
		if($this->sText == ""){
			$file = PATH_ROOT."/data/sites/404.tpl";
			if(file_exists($this->getFile())){
				$file = $this->getFile();
			}
			$this->sText = FileManager::getContent($file);
		}
		return $this->sText;
	}
	public function setText($text){
		$this->sText = $text;
		FileManager::setContent($this->getFile(),$text);
	}
}
?>