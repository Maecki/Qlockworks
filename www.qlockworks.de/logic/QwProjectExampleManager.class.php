<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-27
 */
class QwProjectExampleManager extends QwManager {
	
	public function execute(){
		$this->where("prex_id","=",$this->getId());
		$this->where("prex_proj_id","=",$this->getProjectId());
		$sql = QwSqlConnection::getInstance();
		$res = $sql->query("SELECT * FROM qw_project_example ".$this->clause." ORDER BY prex_name");
		while($obj = $res->fetch_object()){
			$ex = new QwProjectExample();
			$ex->setDataFromObject($obj);
			$this->setObject($ex);
		}
	}
}
?>