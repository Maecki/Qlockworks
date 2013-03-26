<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-27
 */
class QwProjectFileManager extends QwManager {
	
	public function execute(){
		$this->where("prfi_id","=",$this->getId());
		$this->where("prfi_proj_id","=",$this->getProjectId());
		$sql = QwSqlConnection::getInstance();
		$res = $sql->query("SELECT * FROM qw_project_file ".$this->clause." ORDER BY prfi_name");
		while($obj = $res->fetch_object()){
			$f = new QwProjectFile();
			$f->setDataFromObject($obj);
			$this->setObject($f);
		}
	}
}
?>