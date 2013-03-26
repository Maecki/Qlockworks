<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-27
 */
class QwUserManager extends QwManager {
	
	public function execute(){
		$this->where("user_id","=",$this->getId());
		$this->where("CONCAT(user_firstname,' ',user_lastname)","LIKE",$this->getName());
		$this->where("user_status","=",$this->getStatus());
		$sql = QwSqlConnection::getInstance();
		$res = $sql->query("SELECT * FROM qw_user ".$this->clause." ORDER BY user_firstname, user_lastname");
		while($obj = $res->fetch_object()){
			$u = new QwUser();
			$u->setDataFromObject($obj);
			$this->setObject($u);
		}
	}
}
?>