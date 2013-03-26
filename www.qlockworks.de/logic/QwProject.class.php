<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-26
 */
class QwProject extends QwCaller implements QwObject {
	
	private $categories=array(),$files=array(),$examples=array(),$user=array();
	
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
		$this->setName($obj->proj_name);
		$this->setDescription($obj->proj_description);
		$this->setStatus($obj->proj_status);
		$this->setStamp($obj->proj_stamp);
		$this->setStampLast($obj->proj_stamp_last);
	}
	
	public function safe(){
		$sql = QwSqlConnection::getInstance();
		$this->setStampLast(time());
		if($this->getId() == 0){
			$this->setStamp($this->getStampLast());
			$this->setUserId(QwLog::getInstance()->getUserId());
			$sql->query("INSERT INTO qw_project VALUES (
				null,
				'".$this->getUserId()."',
				'".$this->getName()."',
				'".$this->getDescription()."',
				'".$this->getStatus()."',
				'".$this->getStamp()."',
				'".$this->getStampLast()."'
			)");
			$this->setId($sql->getLastInsertId());
		}else{
			$sql->query("UPDATE qw_project SET
			WHERE proj_id='".$this->getId()."'");
		}
	}
	public function delete(){
		$sql = QwSqlConnection::getInstance();
		$sql->query("DELETE FROM qw_project WHERE proj_id='".$this->getId()."'");
		$sql->query("DELETE FROM qw_project2category WHERE pr2c_proj_id='".$this->getId()."'");
		$sql->query("DELETE FROM qw_user2project WHERE u2pr_proj_id='".$this->getId()."'");
		@unlink("data/html/pj".$this->getId().".tpl");
		foreach($this->examples AS $e){
			$e->delete();
		}
		foreach($this->files AS $f){
			$f->delete();
		}
	}
	
	public function getText(){
		$t = parent::getText();
		if($t == "" AND !$this->isLoadText()){
			$t = QwFileManager::getContent("data/html/pj".$this->getId().".tpl");
			$this->setText($t);
			$this->setLoadText(true);
		}
		return $t;
	}
	
	public function getCategories(){
		return $this->categories;
	}
	public function getCategory($id){
		if(isset($this->categories[$id])){
			return $this->categories[$id];
		}else{
			return null;
		}
	}
	public function setCategory(QwCategory $c){
		$this->categories[$c->getId()] = $c;
	}
	
	public function getFiles(){
		return $this->files;
	}
	public function getFile($id){
		if(isset($this->files[$id])){
			return $this->files[$id];
		}else{
			return null;
		}
	}
	public function setFile(QwProjectFile $file){
		$this->files[$file->getId()] = $file;
	}
	
	public function getExamples(){
		return $this->examples;
	}
	public function getExample($id){
		if(isset($this->examples[$id])){
			return $this->examples[$id];
		}else{
			return null;
		}
	}
	public function setExample(QwProjectExample $ex){
		$this->examples[$ex->getId()] = $ex;
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