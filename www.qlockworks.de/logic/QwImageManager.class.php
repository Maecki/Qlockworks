<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-26
 */
class QwImageManager extends QwCaller {
	
	const AUTO = "auto";
	
	public function __construct($ftp=null){
		if($ftp instanceof QwFtpManager){
			$this->setFtp($ftp);
		}
		$this->setWidth(self::AUTO);
		$this->setHeight(self::AUTO);
		$this->setIndent(self::AUTO,self::AUTO);
		$this->setEnlarge(false);
	}
	
	public function setIndent($top,$left){
		$this->setIndentTop($top);
		$this->setIndentLeft($left);
	}
	
	public function setWidth($w){
		if($w != self::AUTO AND $w > $this->getSourceWidth() AND !$this->getEnlarge()){
			$w = $this->getSourceWidth();
		}
		parent::setWidth($w);
	}
	
	public function setMax($max){
		$this->setWidth(self::AUTO);
		$this->setHeight(self::AUTO);
		if($this->getSourceHeight() > $this->getSourceWidth()){
			$this->setHeight($max);
		}else{
			$this->setWidth($max);
		}
	}
	
	public function render($to,$param=null){
		$end = "";
		if(preg_match("/\.(\w+)$/",$to,$a)){
			switch(strtolower($a[1])){
				case "jpeg":
					$a[1] = "jpg";
				case "jpg":
				case "png":
				case "gif":
					$end = strtolower($a[1]);
					break;
				default:
					return false;
			}
			$img_src = "data/tmp/image.".$this->getType();
		}else{
			return false;
		}
		if(!copy($this->getSource(),$img_src)){
			return false;
		}
		$im = $this->getSource(true,$img_src);
		if(is_array($param)){
			foreach($param AS $key=>$val){
				switch($key){
					case "width":	$this->setWidth($val);	break;
					case "max":		$this->setMax($val);	break;
					default:		$this->set($key,$val);	break;
				}
			}
		}
		$in_top = $this->getIndentTop();
		$in_left = $this->getIndentLeft();
		$new_width = $width = $this->getWidth();
		$new_height = $height = $this->getHeight();
		$src_width = $this->getSourceWidth();
		$src_height = $this->getSourceHeight();
		if($width != self::AUTO AND $height != self::AUTO){
			$rwidth = false;
			$height = round($src_height * (100 / $src_width * $width) / 100);
			if($height < $this->getHeight()){
				$height = $this->getHeight();
				$rwidth = true;
			}
			if($width > $height OR $rwidth){
				$width = round($src_width * (100 / $src_height * $height) / 100);
			}
			if($in_top == self::AUTO){
				$in_top = round(($height-$this->getHeight()) / 2)*-1;
			}else{
				$in_top = $in_top*-1;
			}
			if($in_left == self::AUTO){
				$in_left = round(($width-$this->getWidth()) / 2)*-1;
			}else{
				$in_left = $in_left*-1;
			}
		}else{
			if($width == self::AUTO){
				$w = $src_width;
				if($this->getHeight() != self::AUTO){
					$w = round($src_width * (100 / $src_height * $height) / 100);
				}
				$new_width = $w;
				$width = $w;
			}
			if($height == self::AUTO){
				$h = $src_height;
				if($this->getWidth() != self::AUTO){
					$h = round($src_height * (100 / $src_width * $width) / 100);
				}
				$new_height = $h;
				$height = $h;
			}
		}
		if($in_top == self::AUTO) $in_top = 0;
		if($in_left == self::AUTO) $in_left = 0;
		$new_image = imagecreatetruecolor($new_width,$new_height);
		imagefill($new_image,0,0,imagecolorallocate($new_image,255,255,255));
		imagecopyresampled($new_image,$im,$in_left,$in_top,0,0,$width,$height,$this->getSourceWidth(),$this->getSourceHeight());
		if(!($this->getFtp() instanceof QwFtpManager)){
			$img_src = $to;
		}
		$create = false;
		switch($end){
			case "jpg": $create = imagejpeg($new_image,$img_src,100); break;
			case "png": $create = imagepng($new_image,$img_src); break;
			case "gif": $create = imagegif($new_image,$img_src); break;
		}
		if($create){
			$this->setSize(filesize($img_src));
			if($this->getFtp() instanceof QwFtpManager){
				return $this->getFtp()->put($img_src,$to);
			}else{
				return true;
			}
		}else{
			return false;
		}
	}
	
	public function setSource($src){
		$a = getimagesize($src);
		if(count($a) > 0){
			if(preg_match("/^image\/(\w+)$/",$a["mime"],$mime)){
				if($mime[1] == "jpeg"){
					$mime[1] = "jpg";
				}
				parent::setSource($src);
				$this->setSourceWidth($a[0]);
				$this->setSourceHeight($a[1]);
				$this->setSize(filesize($this->getSource()));
				$this->setType($mime[1]);
				return true;
			}
		}
		return false;
	}
	
	public function getSource($src=false,$file="",$typ=""){
		if($src){
			if($file == ""){
				$file = $this->getSource();
			}
			if($typ == ""){
				$typ = $this->getType();
			}
			switch($typ){
				case "gif": return imagecreatefromgif($file);
				case "jpg": return imagecreatefromjpeg($file);
				case "png": return imagecreatefrompng($file);
				default: return false;
			}
		}else{
			return parent::getSource();
		}
	}
}
?>