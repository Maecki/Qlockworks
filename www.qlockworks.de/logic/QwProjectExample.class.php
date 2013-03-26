<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-27
 */
class QwProjectExampe extends QwCaller implements QwObject {
	
	public function __construct($id=0){
		if($id > 0){
			$this->setDataFromId($id);
		}
	}
	
	public function setDataFromId($id){
		$sql = QwSqlConnection::getInstance();
		$res = $sql->query("SELECT * FROM qw_project_example WHERE prex_id='".$id."' LIMIT 1");
		if($obj = $res->fetch_object()){
			$this->setDataFromObject($obj);
		}
	}
	public function setDataFromObject($obj){
		$this->setId($obj->prex_id);
		$this->setProjectId($obj->prex_proj_id);
		$this->setName($obj->prex_name);
		$this->setDescription($obj->prex_description);
		$this->setUserId($obj->prex_user_id);
		$this->setStamp($obj->prex_stamp);
	}
	
	public function safe(){
		$sql = QwSqlConnection::getInstance();
		if($this->getId() == 0){
			$sql->query("INSERT INTO qw_project_example VALUES (
				null,
				'".$this->getProjectId()."',
				'".$this->getName()."',
				'".$this->getDescription()."',
				'".$this->getUserId()."',
				'".$this->getStamp()."'
			)");
			$this->setId($sql->getLastInsertId());
		}else{
			$sql->query("UPDATE qw_project_example SET
				prex_proj_id='".$this->getProjectId()."',
				prex_name='".$this->getName()."',
				prex_description='".$this->getDescription()."',
				prex_user_id='".$this->getUserId()."',
				prex_stamp='".$this->getStamp()."'
			WHERE prex_id='".$this->getId()."'");
		}
	}
	public function delete(){
		$sql = QwSqlConnection::getInstance();
		$sql->query("DELETE FROM qw_project_example WHERE prex_id='".$this->getId()."'");
	}
}
?>