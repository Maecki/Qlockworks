<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-26
 */
abstract class QwManager extends QwCaller {
	
	protected $objects=array(),$clause="";
	
	abstract public function execute();
	
	protected function where($name,$is,$val){
		if(!is_array($name)){
			$name = array($name);
		}
		if(!is_array($val)){
			if($val != ""){
				$val = array($val);
			}else{
				return;
			}
		}
		if(count($val) > 0){
			if($this->clause != ""){
				$this->clause .= " AND ";
			}else{
				$this->clause .= " WHERE ";
			}
			$this->clause .= "(";
			$i = 0;
			foreach($val AS $v){
				if(!is_array($v)){
					if($i > 0){
						$this->clause .= " OR ";
					}
					$w = "";
					foreach($name AS $n){
						if($w != ""){
							$w .= " OR ";
						}
						$w .= $n." ".$is." ".($is == "IN" ? "(".$v.")" : "'".$v."'");
					}
					$this->clause .= $w;
					$i++;
				}
			}
			$this->clause .= ")";
		}
	}
	
	public function getObjects(){
		return $this->objects;
	}
	public function getObject($id){
		if(isset($this->objects[$id])){
			return $this->objects[$id];
		}else{
			return null;
		}
	}
	public function setObject(QwObject $obj){
		$this->objects[$obj->getId()] = $obj;
	}
}
?>