<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-27
 */
class QwUserManager extends QwManager {
	
	public function execute(){
		$from = "";
		$this->where("user_id","=",$this->getId());
		$this->where("user_status","=",$this->getStatus());
		if(is_array($this->getProjectId()) OR $this->getProjectId() > 0){
			$from .= ",qw_user2project";
			$this->where("u2pr_proj_id","=",$this->getProjectId());
			$this->clause .= " AND u2pr_user_id=user_id";
		}
		$sql = QwSqlConnection::getInstance();
		$res = $sql->query("SELECT * FROM qw_user".$from." ".$this->clause." ORDER BY user_name");
		while($obj = $res->fetch_object()){
			$u = new QwUser();
			$u->setDataFromObject($obj);
			$this->setObject($u);
		}
	}
	
	public static function options(){
		$a = array();
		$um = new self();
		$um->setStatus(QwUser::STATUS_ACTIVE);
		$um->execute();
		$ua = $um->getObjects();
		foreach($ua AS $u){
			$a[$u->getId()] = $u->getName();
		}
		return $a;
	}
}
?>