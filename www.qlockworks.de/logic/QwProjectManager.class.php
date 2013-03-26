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
	
	public function execute($loadData=false){
		$from = "qw_project";
		$this->where("proj_id","=",$this->getId());
		$this->where("proj_status","=",$this->getStatus());
		$this->where(array("proj_name","proj_description"),"LIKE",$this->getName());
		$this->where("proj_stamp",">=",$this->getStampFrom());
		$this->where("proj_stamp_last","<=",$this->getStampTo());
		if(is_array($this->getUserId()) OR $this->getUserId() > 0){
			$from .= ",qw_user2project";
			$this->where("u2pr_user_id","=",$this->getUserId());
			$this->clause .= " AND u2pr_proj_id=proj_id";
		}
		if(is_array($this->getCategoryId()) OR $this->getCategoryId() > 0){
			$form .= ",qw_project2category";
			$this->where("pr2c_cate_id","=",$this->getCategoryId());
			$this->clause .= " AND pr2c_proj_id=proj_id";
		}
		$ids = array();
		$sql = QwSqlConnection::getInstance();
		$res = $sql->query("SELECT * FROM ".$from.$this->clause." ORDER BY ".$this->getSort());
		while($obj = $res->fetch_object()){
			$p = $this->getObject($obj->proj_id);
			if(!($p instanceof QwProject)){
				$p = new QwProject();
				$p->setDataFromObject($obj);
				$p->setObject($p);
				$ids[] = $p->getId();
			}
			if(isset($obj->pr2c_cate_id)){
				$a = $p->getCategoryIds();
				if(!is_array($a)){
					$a = array();
				}
				$a[] = $obj->pr2c_cate_id;
				$p->setCategoryIds($a);
			}
		}
		if(count($ids) > 0 AND $loadData){
			$cm = new QwCategoryManager();
			$cm->setProjectId($ids);
			$cm->execute();
			$ca = $cm->getObjects();
			foreach($ca AS $c){
				$a = $c->getProjectIds();
				foreach($a AS $id){
					$p = $this->getObject($id);
					if($p instanceof QwProject){
						$p->setCategory($c);
						$c->setProject($p);
					}
				}
			}
			$fm = new QwProjectFileManager();
			$fm->setProjectId($ids);
			$fm->execute();
			$fa = $fm->getObjects();
			foreach($fa AS $f){
				$p = $this->getObject($f->getProjectId());
				if($p instanceof QwProject){
					$p->setFile($f);
					$f->setProject($p);
				}
			}
			$em = new QwProjectExampleManager();
			$em->setProjectId($ids);
			$em->execute();
			$ea = $em->getObjects();
			foreach($ea AS $e){
				$p = $this->getObject($e->getProjectId());
				if($p instanceof QwProject){
					$p->setExample($e);
					$e->setProject($p);
				}
			}
			$um = new QwUserManager();
			$um->setProjectId($ids);
			$um->execute();
			$ua = $um->getObjects();
			foreach($ua AS $u){
				$a = $u->getProjectIds();
				foreach($a AS $id){
					$p = $this->getProject($id);
					if($p instanceof QwProject){
						$p->setUser($u);
						$u->setProject($p);
					}
				}
			}
		}
	}
}
?>