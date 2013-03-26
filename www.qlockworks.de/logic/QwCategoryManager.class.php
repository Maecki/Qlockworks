<?php
/**
 * Copyright 2013 @ Qlockwroks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-26
 */
class QwCategoryManager extends QwManager {
	
	public function execute($loadProjects){
		$this->where("cate_id","=",$this->getId());
		$this->where(array("cate_name","cate_description"),"LIKE",$this->getName());
		$ids = array();
		$sql = QwSqlConnection::getInstance();
		$res = $sql->query("SELECT * FROM qw_category ".$this->clause." ORDER BY cate_name");
		while($obj = $res->fetch_object()){
			$c = new QwCategory();
			$c->setDataFromObject($obj);
			$this->setObject($c);
			$ids[] = $c->getId();
		}
		if($loadProjects AND count($ids) > 0){
			$pm = new QwProjectManager();
			$pm->setCategoryId($ids);
			$pm->execute();
			$pa = $pm->getObjects();
			foreach($pa AS $p){
				$ids = $p->getCategoryIds();
				foreach($ids AS $id){
					$c = $this->getObject($id);
					if($c instanceof QwCategory){
						$c->setProject($p);
						$p->setCategory($c);
					}
				}
			}
		}
	}
}
?>