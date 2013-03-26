<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-26
 */
class QwProejctCommentManager extends QwManager {
	
	public function execute(){
		$this->where("prco_id","=",$this->getId());
		$this->where("prco_proj_id","=",$this->getProjectId());
		$this->where("prco_user_id","=",$this->getUserId());
		$sql = QwSqlConnection::getInstance();
		$res = $sql->query("SELECT * FROM qw_project_comment ".$this->clause." ORDER BY prco_stamp DESC");
		while($obj = $res->fetch_object()){
			$c = new QwProjectComment();
			$c->setDataFromObject($obj);
			$this->setObject($c);
		}
	}
}
?>