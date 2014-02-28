<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-26
 */
class QwProjectManager extends QwManager {
	
	public function __construct(){
		$this->setSort("proj_stamp_last DESC");
	}
	
	public function execute(){
		$from = "qw_project";
		$this->where("proj_id","=",$this->getId());
		if($this->isPublic()){
			$this->where("proj_public","=","y");
		}
		if($this->getSearch() != ""){
			if($this->clause != ""){
				$this->clause .= " AND ";
			}
			$this->clause .= "(
				proj_name LIKE '".$this->getSearch()."' OR
				proj_description LIKE '".$this->getSearch()."' OR
				proj_id IN (SELECT prta_proj_id FROM qw_project_tags WHERE prta_tag LIKE '".$this->getSearch()."')
			)";
		}else if($this->getTag() != ""){
			$thiw->where("proj_id","IN","SELECT prta_proj_id FROM qw_project_tags WHERE prta_tag LIKE '".$this->getTag()."'");
		}
		$this->where("proj_stamp",">=",$this->getStampFrom());
		$this->where("proj_stamp_last","<=",$this->getStampTo());
		if(is_array($this->getUserId()) OR $this->getUserId() > 0){
			$from .= ",qw_user2project";
			$this->where("u2pr_user_id","=",$this->getUserId());
			$this->clause .= " AND u2pr_proj_id=proj_id";
		}
		$ids = array();
		$sql = QwSqlConnection::getInstance();
		$anz = $sql->value("SELECT COUNT(*) FROM ".$from.$this->clause);
		$res = $sql->query("SELECT * FROM ".$from.$this->clause." ORDER BY ".$this->getSort().($this->getLimit() != "" ? " LIMIT ".$this->getLimit() : ""));
		while($obj = $res->fetch_object()){
			$p = new QwProject();
			$p->setDataFromObject($obj);
			$this->setObject($p);
		}
		return $anz;
	}
	
	public static function tagcloud(){
		$tags = array();
		$vals = array();
		$sql = QwSqlConnection::getInstance();
		$res = $sql->query("SELECT prta_tag FROM qw_project_tags ORDER BY prta_tag");
		while($obj = $res->fetch_object()){
			$key = strtolower(str_replace(array(" ","-","_"),"",trim($obj->prta_tag)));
			if(!isset($vals[$key])){
				$vals[$key] = array($obj->prta_tag,0);
			}
			$vals[$key][1]++;
		}
		foreach($vals AS $a){
			$tags[$a[0]] = $a[1];
		}
		return $tags;
	}
}
?>