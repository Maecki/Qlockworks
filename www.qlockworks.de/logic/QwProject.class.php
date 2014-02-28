<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-26
 */
class QwProject extends QwCaller implements QwObject {
	
	private $tags=array(),$files=array(),$user=array();
	
	public function __construct($id=0){
		if($id > 0){
			$this->setDataFromId($id);
		}
	}
	
	public function setDataFromId($id){
		$sql = QwSqlConnection::getInstance();
		$res = $sql->query("SELECT * FROM qw_project WHERE proj_id='".$id."' LIMIT 1");
		if($obj = $res->fetch_object()){
			$this->setDataFromObject($obj);
		}
	}
	public function setDataFromObject($obj){
		$this->setId($obj->proj_id);
		$this->setUserId($obj->proj_user_id);
		$this->setImage($obj->proj_image);
		$this->setName($obj->proj_name);
		$this->setDescription($obj->proj_description);
		$this->setPublic($obj->proj_public == "y");
		$this->setClicks($obj->proj_clicks);
		$this->setStamp($obj->proj_stamp);
		$this->setStampLast($obj->proj_stamp_last);
	}
	
	public function safe(){
		$sql = QwSqlConnection::getInstance();
		$this->setStampLast(time());
		$public = $this->getPublic() ? "y" : "n";
		if($this->getId() == 0){
			$this->setStamp($this->getStampLast());
			$this->setUserId(QwLog::getInstance()->getUserId());
			$sql->query("INSERT INTO qw_project VALUES (
				null,
				'".$this->getUserId()."',
				'".$this->getImage()."',
				'".$this->getName()."',
				'".$this->getDescription()."',
				'".$public."',
				'".$this->getClicks()."',
				'".$this->getStamp()."',
				'".$this->getStampLast()."'
			)");
			$this->setId($sql->getLastInsertId());
			$ftp = new QwFtpManager();
			$ftp->mkdir($this->getFtpPath());
		}else{
			$sql->query("UPDATE qw_project SET
				proj_user_id='".$this->getUserId()."',
				proj_image='".$this->getImage()."',
				proj_name='".$this->getName()."',
				proj_description='".$this->getDescription()."',
				proj_public='".$public."',
				proj_clicks='".$this->getClicks()."',
				proj_stamp='".$this->getStamp()."',
				proj_stamp_last='".$this->getStampLast()."'
			WHERE proj_id='".$this->getId()."'");
		}
		QwFileManager::setContent("data/src/".substr($this->getId(),-1,1)."/".$this->getId().".tpl",$this->getText());
	}
	public function delete(){
		$sql = QwSqlConnection::getInstance();
		$sql->query("DELETE FROM qw_project WHERE proj_id='".$this->getId()."'");
		$sql->query("DELETE FROM qw_project_tags WHERE prta_proj_id='".$this->getId()."'");
		$sql->query("DELETE FROM qw_user2project WHERE u2pr_proj_id='".$this->getId()."'");
		@unlink("data/src/".substr($this->getId(),-1,1)."/".$this->getId().".tpl");
		$this->deleteImage();
		$ftp = new QwFtpManager();
		$path = $this->getFtpPath();
		$this->loadFiles();
		foreach($this->files AS $file){
			$ftp->delete($path."/".$file);
		}
		$ftp->rmdir($path);
	}
	
	public function click(){
		$i = (int)$this->getClicks();
		$i++;
		$this->setClicks($i);
		$sql = QwSqlConnection::getInstance();
		$sql->query("UPDATE qw_project SET proj_clicks='".$i."' WHERE proj_id='".$this->getId()."'");
	}
	
	public function addUser($uid){
		$sql = QwSqlConnection::getInstance();
		$sql->query("INSERT INTO qw_user2project VALUES('".$uid."','".$this->getId()."')");
	}
	public function rmUser($uid){
		$sql = QwSqlConnection::getInstance();
		$sql->query("DELETE FROM qw_user2project WHERE u2pr_proj_id='".$this->getId()."' AND u2pr_user_id='".$uid."'");
	}
	
	public function checkPermission(){
		$log = QwLog::getInstance();
		if($log->isLoggedIn()){
			if($this->getId() == 0 OR $log->getUser()->getType() == QwUser::TYPE_ADMIN){
				return true;
			}
			$sql = QwSqlConnection::getInstance();
			if($sql->value("SELECT COUNT(*) FROM qw_user2project WHERE u2pr_proj_id='".$this->getId()."' AND u2pr_user_id='".$log->getUserId()."' LIMIT 1") > 0){
				return true;
			}
		}
		return false;
	}
	
	
	public function getFtpPath(){
		return substr(QwUtils::prefixZeros($this->getId(),2),-2,2)."/".QwUtils::prefixZeros($this->getId(),5);
	}
	
	public function getLink(){
		return QW_WEB."/index.php/".$this->getId().".".QwUtils::urlEncode($this->getName()).".html";
	}
	
	public function getImage($end=""){
		$img = parent::getImage();
		if($end != ""){
			if($img != ""){
				$img = QW_WEB."/data/src/".substr($this->getId(),-1,1)."/".$img."_".$end.".jpg";
			}else{
				if($end == "lo"){
					$end = "th";
				}
				$img = QW_WEB."/style/std_".$end.".jpg";
			}
		}
		return $img;
	}
	public function uploadImage($src){
		$path = "data/src/".substr($this->getId(),-1,1)."/";
		$img = new QwImageManager();
		if($img->setSource($src)){
			$old = $this->getImage();
			$this->setImage(substr(QwUtils::prefixZeros($this->getId(),5)."O".rand(100,999)."_".QwUtils::urlEncode($this->getName()),0,200));
			if($img->render($path.$this->getImage()."_kl.jpg",array("width"=>50,"height"=>50))){
				$img->render($path.$this->getImage()."_th.jpg",array("width"=>220,"height"=>180));
				$img->render($path.$this->getImage()."_lo.jpg",array("max"=>500));
				if($old != ""){
					@unlink($path.$old."_kl.jpg");
					@unlink($path.$old."_th.jpg");
					@unlink($path.$old."_lo.jpg");
				}
				$this->safe();
				return true;
			}
			$this->setImage($old);
		}
		return false;
	}
	public function deleteImage(){
		$img = $this->getImage();
		if($img != ""){
			$path = "data/src/".substr($this->getId(),-1,1)."/".$img;
			foreach(array("kl","th","lo") AS $end){
				@unlink($path."_".$end.".jpg");
			}
			$this->setImage("");
		}
	}
	
	public function getText(){
		$t = parent::getText();
		if($t == "" AND !$this->isLoadText() AND $this->getId() > 0){
			$t = QwFileManager::getContent("data/src/".substr($this->getId(),-1,1)."/".$this->getId().".tpl");
			$this->setText($t);
			$this->setLoadText(true);
		}
		return $t;
	}
	
	public function getTags(){
		return $this->tags;
	}
	public function safeTags($tags){
		$sql = QwSqlConnection::getInstance();
		$sql->query("DELETE FROM qw_project_tags WHERE prta_proj_id='".$this->getId()."' ORDER BY prta_tag");
		if(is_array($tags)){
			$this->tags = array();
			foreach($tags AS $tag){
				$key = strtolower(str_replace(array(" ","-","_"),"",trim($tag)));
				if($key != ""){
					$this->tags[$key] = $tag;
				}
			}
			$val = "";
			foreach($this->tags AS $tag){
				if($val != ""){
					$val .= ",";
				}
				$val .= "('".$this->getId()."','".$tag."')";
			}
			if($val != ""){
				$sql->query("INSERT INTO qw_project_tags VALUES ".$val);
			}
		}
	}
	public function loadTags(){
		$this->tags = array();
		$sql = QwSqlConnection::getInstance();
		$res = $sql->query("SELECT prta_tag FROM qw_project_tags WHERE prta_proj_id='".$this->getId()."'");
		while($obj = $res->fetch_object()){
			$this->tags[] = $obj->prta_tag;
		}
	}
	
	public function getFiles(){
		return $this->files;
	}
	public function loadFiles(){
		$ftp = new QwFtpManager();
		$this->files = $ftp->dir($this->getFtpPath());
	}
	public function uploadFile($src,$name){
		$ftp = new QwFtpManager();
		return $ftp->put($src,$this->getFtpPath()."/".$name);
	}
	public function deleteFile($name){
		$ftp = new QwFtpManager();
		return $ftp->delete($this->getFtpPath()."/".$name);
	}
	
	public function getUser($id=0){
		if($id > 0){
			if(isset($this->user[$id])){
				return $this->user[$id];
			}else{
				return null;
			}
		}else{
			return $this->user;
		}
	}
	public function setUser(QwUser $u){
		$this->user[$u->getId()] = $u;
	}
}
?>