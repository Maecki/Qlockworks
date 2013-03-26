<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-26
 */
class QwFtpManager {
	
	private $connect=null;
	
	public function __construct(){
		if(!QwUtils::isLocal()){
			$this->connect = ftp_connect(QW_FTP_HOST);
			if(!ftp_login($this->connect,QW_FTP_USER,QW_FTP_PASS)){
				die("Fehler beim Verbinden zum FTP-Server!");
			}
		}
	}
	
	public function __destruct(){
		if(!QwUtils::isLocal()){
			return @ftp_close($this->connect);
		}
	}
	
	public function get($from,$to){
		if(QwUtils::isLocal()){
			return @copy($from,"ftp/".$to);
		}else{
			return @ftp_get($this->connect,$to,$from,FTP_BINARY);
		}
	}
	
	public function put($from,$to){
		if(QwUtils::isLocal()){
			return @copy($from,"ftp/".$to);
		}else{
			return @ftp_put($this->connect,$to,$from,FTP_BINARY);
		}
	}
	
	public function delete($src){
		if(QwUtils::isLocal()){
			return @unlink("ftp/".$src);
		}else{
			if($this->isdir($src)){
				$a = $this->dir($src);
				foreach($a AS $f){
					$this->delete($src."/".$f);
				}
				return @ftp_rmdir($this->connect,$src);
			}else{
				return @ftp_delete($this->connect,$src);
			}
		}
	}
	
	public function mkdir($file){
		if(QwUtils::isLocal()){
			return @mkdir("ftp/".$file);
		}else{
			@ftp_mkdir($this->connect,$file);
		}
	}
	
	public function dir($dir){
		$a = array();
		$l = ftp_nlist($this->connect,$dir);
		foreach($l AS $f){
			if($f != "." AND $f != ".."){
				$a[] = $f;
			}
		}
		return $a;
	}
	public function isdir($dir){
		if(preg_match("/^(.*)\/([^\/]+)$/",$dir,$a)){
			$dir = $a[1];
			$file = $a[2];
			if($result = ftp_rawlist($this->connect,$dir)){
				foreach($result AS $row){
					while(preg_match("/  /",$row)){
						$row = str_replace("  "," ",$row);
					}
					$a = explode(" ",$row);
					if($a[8] == $file){
						return preg_match("/^d/",$row);
					}
				}
			}
		}
		return false;
	}
}
?>