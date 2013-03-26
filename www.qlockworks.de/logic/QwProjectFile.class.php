<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-27
 */
class QwProjectFile extends QwCaller implements QwObject {
	
	public function __construct($id=0){
		if($id > 0){
			$this->setDataFromId($id);
		}
	}
	
	public function setDataFromId($id){
		$sql = QwSqlConnection::getInstance();
		$res = $sql->query("SELECT * FROM qw_project_file WHERE prfi_id='".$id."' LIMIT 1");
		if($obj = $res->fetch_object()){
			$this->setDataFromObject($obj);
		}
	}
	public function setDataFromObject($obj){
		$this->setId($obj->prfi_id);
		$this->setProjectId($obj->prfi_proj_id);
		$this->setUserId($obj->prfi_user_id);
		$this->setName($obj->prfi_name);
		$this->setFile($obj->prfi_file);
		$this->setType($obj->pfri_type);
		$this->setSize($obj->prfi_size);
		$this->setStamp($obj->pfri_stamp);
	}
	public function safe(){
		$sql = QwSqlConnection::getInstance();
		if($this->getId() == 0){
			$sql->query("INSERT INTO qw_project_file VALUES (
				null,
				'".$this->getProjectId()."',
				'".$this->getUserId()."',
				'".$this->getName()."',
				'".$this->getFile()."',
				'".$this->getType()."',
				'".$this->getSize()."',
				'".$this->getStamp()."'
			");
			$this->setId($sql->getLastInsertId());
		}else{
			$sql->query("UPDATE qw_project_file SET
				prfi_proj_id='".$this->getProjectId()."',
				prfi_user_id='".$this->getUserId()."',
				prfi_name='".$this->getName()."',
				prfi_file='".$this->getFile()."',
				prfi_type='".$this->getType()."',
				prfi_size='".$this->getSize()."',
				prfi_stamp='".$this->getStamp()."'
			WHERE prfi_id='".$this->getId()."'");
		}
	}
	public function delete(){
		$sql = QwSqlConnection::getInstance();
		$sql->query("DELETE FROM qw_project_file WHERE prfi_id='".$this->getId()."'");
		$ftp = new QwFtpManager();
		if($this->isPdf()){
			$ftp->delete("project/".$this->getFile().".pdf");
		}else if($this->isImage()){
			$ftp->delete("project/".$this->getFile()."_th.jpg");
			$ftp->delete("project/".$this->getFile()."_lo.jpg");
		}else{
			$ftp->delete("project/".$this->getFile().".dat");
		}
	}
	public function upload($src){
		if($this->getId() == 0){
			$this->safe();
		}
		$this->setSize(filesize($src));
		$this->setFile(QwUtils::prefixZeros($this->getId(),5));
		$ftp = new QwFtpManager();
		$b = false;
		if($this->isImage()){
			$img = new QwImageManager($ftp);
			if($img->setSource($src)){
				if($img->render("project/".$this->getFile()."_th.jpg",array(
					"width" => 100,
					"height" => 90
				))){
					$img->render("project/".$this->getFile()."_lo.jpg",array(
						"max" => 800
					));
					$this->setSize($img->getSize());
					$b = true;
				}
			}
		}else{
			$b = $ftp->put($src,"project/".$this->getFile().".".($this->isPdf() ? "pdf" : "dat"));
		}
		if($b){
			$this->safe();
			return true;
		}
		$this->delete();
		return false;
	}
	
	public function __toString(){
		return '
		<div class="QwFile" style="background-image:url('.$this->getThumb().')">
			<strong>
				'.$this->getName().'
				<small>'.round($this->getSize()/1024,2).' kb</small>
			</strong>
		</div>';
	}
	
	public function getThumb(){
		if($this->isImage()){
			return QW_FTP."/project/".$this->getFile()."_th.jpg";
		}
		switch($this->getType()){
			case "pdf": return QW_WEB."/style/thumb/pdf.jpg";
			case "php": return QW_WEB."/style/thumb/php.jpg";
			case "sql": return QW_WEB."/style/thumb/sql.jpg";
			case "zip": return QW_WEB."/style/thumb/zip.jpg";
			default:	return QW_WEB."/style/thumb/file.jpg";
		}
	}
	
	public function isImage(){
		switch($this->getType()){
			case "jpg":
			case "png":
			case "gif":
				return true;
		}
		return false;
	}
	public function isPdf(){
		return $this->getType() == "pdf";
	}
	public function isDir(){
		return $this->getType() == "dir";
	}
}
?>