<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-26
 */
final class QwSqlConnection {
	
	private $connection=null;
	private static $instance=null;
	
	// disable constructor
	private function __construct(){
		$this->connection = new mysqli(QW_SQL_HOST,QW_SQL_USER,QW_SQL_PASS,QW_SQL_BASE);
		if(mysqli_connect_errno()){
			die("Es konnte keine Verbindung zur Datenbank hergestellt werden :-(");
		}
		$this->connection->query("SET NAMES 'utf8'");
	}
	private function __clone(){}
	
	public static function getInstance(){
		if(!(self::$instance instanceof self)){
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public function query($query){
		return $this->connection->query($query);
	}
	
	public function value($query){
		$res = $this->connection->query($query);
		if($a = $res->fetch_array()){
			return $a[0];
		}
	}
	
	public function getLastInsertId(){
		return $this->connection->insert_id;
	}
}
?>