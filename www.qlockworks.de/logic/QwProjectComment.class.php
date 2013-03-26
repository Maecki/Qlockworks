<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-26
 */
class QwProjectComment extends QwCaller implements QwObject {
	
	public function __construct($id=0){
		if($id > 0){
			$this->setDataFromId($id);
		}
	}
	public function setDataFromId($id){
		$sql = QwSqlConnection::getInstance();
		$res = $sql->query("SELECT * FROM qw_project_comment WHERE prco_id='".$id."' LIMIT 1");
		if($obj = $res->fetch_object()){
			$this->setDataFromObject($obj);
		}
	}
	public function setDataFromObject($obj){
		$this->setId($obj->prco_id);
		$this->setProjectId($obj->prco_proj_id);
		$this->setUserId($obj->prco_user_id);
		$this->setStamp($obj->prco_stamp);
	}
	
	public function safe(){
		$sql = QwSqlConnection::getInstance();
		if($this->getId() == 0){
			$sql->query("INSERT INTO qw_project_comment VALUES (
				null,
				'".$this->getProjectId()."',
				'".$this->getUserId()."',
				'".$this->getStamp()."'
			)");
			$this->setId($sql->getLastInsertId());
		}else{
			$sql->query("UPDATE qw_project_comment SET
				prco_proj_id='".$this->getProjectId()."',
				prco_user_id='".$this->getUserId()."',
				prco_stamp='".$this->getStamp()."'
			WHERE prco_id='".$this->getId()."'");
		}
		QwFileManager::setContent("data/html/prco".$this->getId().".tpl",$this->getText());
	}
	public function delete(){
		$sql = QwSqlConnection::getInstance();
		$sql->query("DELETE FROM qw_project_comment WHERE prco_id='".$this->getId()."'");
		@unlink("data/html/prco".$this->getId().".tpl");
	}
	
	public function getText(){
		$t = parent::getText();
		if($t != "" AND !$this->isLoadText()){
			$t = QwFileManager::getContent("data/html/prco".$this->getId().".tpl");
			$this->setText($t);
			$this->setLoadText(true);
		}
		return $t;
	}
}
?>