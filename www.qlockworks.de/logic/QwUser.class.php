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
	const STATUS_CLOSED = "x";
	
	const GENDER_FEMALE = "f";
	const GENDER_MALE = "m";
	
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
		$this->setFirstname($obj->user_firstname);
		$this->setLastname($obj->user_lastname);
		$this->setPassword($obj->user_password);
		$this->setGender($obj->user_gender);
		$this->setBirthdate($obj->user_birthdate);
		$this->setEmail($obj->user_email);
		$this->setWebsite($obj->user_web);
		$this->setDescription($obj->user_description);
		$this->setImage($obj->user_image);
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
				'".$this->getFirstname()."',
				'".$this->getLastname()."',
				'".$this->getPassword()."',
				'".$this->getGender()."',
				'".$this->getBirthdate()."',
				'".$this->getEmail()."',
				'".$this->getWebsite()."',
				'".$this->getDescription()."',
				'".$this->getImage()."',
				'".$this->getStatus()."',
				'".$this->getToken()."',
				'".$this->getStamp()."',
				'".$this->getStampLast()."'
			)");
			$this->setId($sql->getLastInsertId());
		}else{
			$sql->query("UPDATE qw_user SET
				user_firstname='".$this->getFirstname()."',
				user_lastname='".$this->getLastname()."',
				user_password='".$this->getPassword()."',
				user_gender='".$this->getGender()."',
				user_birthdate='".$this->getBirthdate()."',
				user_email='".$this->getEmail()."',
				user_web='".$this->getWebsite()."',
				user_description='".$this->getDescription()."',
				user_image='".$this->getImage()."',
				user_status='".$this->getStatus()."',
				user_token='".$this->getToken()."',
				user_stamp='".$this->getStamp()."',
				user_stamp_last='".$this->getStampLast()."'
			WHERE user_id='".$this->getId()."'");
		}
	}
	public function delete(){
		$this->setStatus(self::STATUS_CLOSED);
		$this->safe();
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
			$this->setImage(QwUtils::prefixZeros($this->getId(),5)."O".rand(100,999));
			if($img->render("user/".$this->getImage()."_kl.jpg",array(
				"width" => 50,
				"height" => 50
			))){
				$img->render("user/".$this->getImage()."_th.jpg",array(
					"width" => 180,
					"height" => 220
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
	
	public function getAge(){
		return QwUtils::getAge($this->getBirthdate());
	}
	
	public function getGender($full=false){
		$g = parent::getGender();
		if($full){
			$g = $g = self::GENDER_FEMALE ? "m&auml;nnlich" : "weiblich";
		}
		return $g;
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
}
?>