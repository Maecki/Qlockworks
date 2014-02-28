<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-24
 */
class QwLog extends QwCaller {
	
	private static $instance=null;
	
	private function __construct(){
		$this->setStamp(time());
	}
	private function __clone(){}
	
	public static function start(){
		return self::getInstance();
	}
	public static function init(QwLog $log){
		self::$instance = $log;
	}
	public static function getInstance(){
		if(!(self::$instance instanceof self)){
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public function isLoggedIn(){
		return $this->getUserId() > 0;
	}
	public function login($user,$pass){
		if(is_numeric($user)){
			$u = "user_id='".$user."'";
		}else if(QwUtils::checkEmail($user)){
			$u = "LOWER(user_email)='".strtolower($user)."'";
		}else{
			$u = "LOWER(CONCAT(user_firstname,' ',user_lastname))='".strtolower($user)."'";
		}
		$sql = QwSqlConnection::getInstance();
		$res = $sql->query("SELECT * FROM qw_user WHERE user_password='".md5($pass)."' AND ".$u." AND user_status='".QwUser::STATUS_ACTIVE."' LIMIT 1");
		if($obj = $res->fetch_object()){
			$u = new QwUser();
			$u->setDataFromObject($obj);
			$u->setStampLast(time());
			$u->safe();
			$this->setUser($u);
			$this->setUserId($u->getId());
		}
		return $this->isLoggedIn();
	}
	public function logout(){
		$this->setUser(null);
		$this->setUserId(0);
	}
}
?>