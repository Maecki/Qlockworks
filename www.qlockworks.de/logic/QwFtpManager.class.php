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
	
	public function delete($file){
		if(QwUtils::isLocal()){
			return @unlink("ftp/".$file);
		}else{
			return @ftp_delete($this->connect,$file);
		}
	}
	
	public function mkdir($file){
		if(QwUtils::isLocal()){
			return @mkdir("ftp/".$file);
		}else{
			return @ftp_mkdir($this->connect,$file);
		}
	}
	public function rmdir($path){
		$a = $this->dir($path);
		foreach($a AS $f){
			$this->delete($path."/".$f);
		}
		if(QwUtils::isLocal()){
			return @rmdir($path);
		}else{
			return @ftp_rmdir($this->connect,$path);
		}
	}
	public function dir($dir){
		$a = array();
		if(QwUtils::isLocal()){
			$h = opendir("ftp/".$dir);
			while($f = readdir($h)){
				if($f != "." AND $f != ".."){
					$a[] = $f;
				}
			}
			closedir($h);
		}else{
			$l = ftp_nlist($this->connect,$dir);
			foreach($l AS $f){
				if($f != "." AND $f != ".."){
					$a[] = $f;
				}
			}
		}
		return $a;
	}
}
?>