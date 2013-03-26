<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-24
 */
abstract class QwCaller {
	
	protected $a=array();
	
	public function __call($func,$param){
		if(preg_match("/^get([a-z0-9]+)$/i",$func,$a)){
			return $this->get($a[1]);
		}else if(preg_match("/^set([a-z0-9]+)$/i",$func,$a)){
			return $this->set($a[1],$param[0]);
		}
	}
	
	public function get($key){
		$key = strtolower($key);
		if(isset($this->a[$key])){
			return $this->a[$key];
		}else if(preg_match("/id$/",$key)){
			return 0;
		}else{
			return "";
		}
	}
	public function set($key,$val){
		$this->a[strtolower($key)] = $val;
	}
}
?>