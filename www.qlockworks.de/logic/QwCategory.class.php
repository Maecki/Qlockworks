<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-26
 */
class QwCategory extends QwCaller implements QwObject {
	
	private $projects=array();
	
	public function __construct($id=0){
		if($id > 0){
			$this->setDataFromId($id);
		}
	}
	
	public function setDataFromId($id){
		$sql = QwSqlConnection::getInstance();
		$res = $sql->query("SELECT * FROM qw_category WHERE cate_id='".$id."' LIMIT 1");
		if($obj = $res->fetch_object()){
			$this->setDataFromObject($obj);
		}
	}
	public function setDataFromObject($obj){
		$this->setId($obj->cate_id);
		$this->setName($obj->cate_name);
		$this->setDescription($obj->cate_description);
	}
	
	public function safe(){
		$sql = QwSqlConnection::getInstance();
		if($this->getId() == 0){
			$sql->query("INSERT INTO qw_category VALUES (
				null,
				'".$this->getName()."',
				'".$this->getDescription()."'
			)");
			$this->setId($sql->getLastInsertId());
		}else{
			$sql->query("UPDATE qw_category SET
				cate_name='".$this->getName()."',
				cate_description='".$this->getDescription()."'
			WHERE cate_id='".$this->getId()."'");
		}
	}
	public function delete(){
		$sql = QwSqlConnection::getInstance();
		$sql->query("DELETE FROM qw_category SET cate_id='".$this->getId()."'");
		$sql->query("DELETE FROM qw_project2category WHERE pr2c_cate_id='".$this->getId()."'");
	}
	
	public function getProjects(){
		return $this->projects;
	}
	public function getProject($id){
		if(isset($this->projects[$id])){
			return $this->projects[$id];
		}else{
			return null;
		}
	}
	public function setProject(QwProject $p){
		$this->projects[$p->getId()] = $p;
	}
}
?>