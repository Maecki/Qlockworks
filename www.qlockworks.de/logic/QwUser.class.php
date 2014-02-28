<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-27
 */
class QwUser extends QwCaller implements QwObject {
	
	const STATUS_INACTIVE = "n";
	const STATUS_ACTIVE = "y";
	
	const TYPE_ADMIN = "a";
	const TYPE_EDITOR = "e";
	
	public function __construct($id=0){
		if($id > 0){
			$this->setDataFromId($id);
		}
	}
	public function setDataFromId($id){
		$sql = QwSqlConnection::getInstance();
		$res = $sql->query("SELECT * FROM qw_user WHERE user_id='".$id."' LIMIT 1");
		if($obj = $res->fetch_object()){
			$this->setDataFromObject($obj);
		}
	}
	public function setDataFromObject($obj){
		$this->setId($obj->user_id);
		$this->setName($obj->user_name);
		$this->setPassword($obj->user_password);
		$this->setEmail($obj->user_email);
		$this->setWebsite($obj->user_web);
		$this->setDescription($obj->user_description);
		$this->setImage($obj->user_image);
		$this->setType($obj->user_type);
		$this->setStatus($obj->user_status);
		$this->setToken($obj->user_token);
		$this->setStamp($obj->user_stamp);
		$this->setStampLast($obj->user_stamp_last);
	}
	
	public function safe(){
		$sql = QwSqlConnection::getInstance();
		if($this->getId() == 0){
			$this->setStamp(time());
			$this->setToken("u".md5($this->getId()."O".$this->getPassword()));
			$sql->query("INSERT INTO qw_user VALUES (
				null,
				'".$this->getName()."',
				'".$this->getPassword()."',
				'".$this->getEmail()."',
				'".$this->getWebsite()."',
				'".$this->getDescription()."',
				'".$this->getImage()."',
				'".$this->getType()."',
				'".$this->getStatus()."',
				'".$this->getToken()."',
				'".$this->getStamp()."',
				'".$this->getStampLast()."'
			)");
			$this->setId($sql->getLastInsertId());
		}else{
			$sql->query("UPDATE qw_user SET
				user_name='".$this->getName()."',
				user_password='".$this->getPassword()."',
				user_email='".$this->getEmail()."',
				user_web='".$this->getWebsite()."',
				user_description='".$this->getDescription()."',
				user_image='".$this->getImage()."',
				user_type='".$this->getType()."',
				user_status='".$this->getStatus()."',
				user_token='".$this->getToken()."',
				user_stamp='".$this->getStamp()."',
				user_stamp_last='".$this->getStampLast()."'
			WHERE user_id='".$this->getId()."'");
		}
	}
	public function delete(){
		$sql = QwSqlConnection::getInstance();
		$sql->query("DELETE FROM qw_user WHERE user_id='".$this->getId()."'");
		$sql->query("DELETE FROM qw_user2project WHERE u2pr_user_id='".$this->getId()."'");
		$this->deleteImage();
	}
	
	public function deleteImage(){
		if($this->getImage() != ""){
			$ftp = new QwFtpManager();
			$ftp->delete("user/".$this->getImage()."_kl.jpg");
			$ftp->delete("user/".$this->getImage()."_th.jpg");
			$ftp->delete("user/".$this->getImage()."_lo.jpg");
			$this->setImage("");
		}
	}
	public function uploadImage($src){
		$ftp = new QwFtpManager();
		$img = new QwImageManager($ftp);
		if($img->setSource($src)){
			$tmp = $this->getImage();
			$this->setImage(substr(QwUtils::prefixZeros($this->getId(),5)."O".rand(100,999)."_".QwUtils::urlEncode($this->getName()),0,200));
			if($img->render("user/".$this->getImage()."_kl.jpg",array(
				"width" => 50,
				"height" => 50
			))){
				$img->render("user/".$this->getImage()."_th.jpg",array(
					"width" => 220,
					"height" => 180
				));
				$img->render("user/".$this->getImage()."_lo.jpg",array(
					"max" => 800
				));
				$this->safe();
				if($tmp != ""){
					$ftp->delete("user/".$tmp."_kl.jpg");
					$ftp->delete("user/".$tmp."_th.jpg");
					$ftp->delete("user/".$tmp."_lo.jpg");
				}
				return true;
			}
		}
		return false;
	}
	
	public function getImage($end=""){
		$img = parent::getImage();
		if($end != ""){
			if($img != ""){
				return QW_FTP."/user/".$img."_".$end.".jpg";
			}else{
				return QW_WEB."/style/std_".($end == "lo" ? "th" : $end).".jpg";
			}
		}
		return $img;
	}
	
	
	public function getCard(){
		$out = '<div class="Card"><img src="'.$this->getImage("th").'" /><h3>'.$this->getName().'</h3>';
		if($this->getWebsite() != ""){
			$out .= '<p>'.QwUtils::getLink($this->getWebsite()).'</p>';
		}
		$out .= QwUtils::commentEncode($this->getDescription());
		$out .= '</div>';
		return $out;
	}
}
?>