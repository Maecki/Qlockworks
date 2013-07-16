<?php
/**
 * Copyright 2012 @  Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-07
 */
final class FileManager {
	
	public static function getContent($src){
		return @file_get_contents($src);
	}
	
	public static function setContent($file,$str){
	if($f = fopen($file,"w+")){
			fwrite($f,$str);
			fclose($f);
			return true;
		}else{
			return false;
		}
	}
	
	public static function getSize($file){
		return @filesize($file);
	}
	
	public static function uploadImage($source,$to,$width=0,$height=0){
		
		$img_src = PATH_ROOT."/data/tmp/img.dat";
		
		@copy($source,$img_src);
		
		list($src_width, $src_height, $data) = @getimagesize($img_src);
		
		// Create new Source
		switch($data){
			case 1:		$im=imagecreatefromgif($img_src);	break;
			case 2:		$im=imagecreatefromjpeg($img_src);	break;
			case 3:		$im=imagecreatefrompng($img_src);	break;
			default:	return false;
		}
		
		
		// Skalierung, Automatisch zuschneiden
		if($width != 0 OR $height != 0){
			
			// Breite verkleinern falls noetig
			if($width != 0 AND $height == 0 AND $src_width < $width){
				$width = $src_width;
			}
			
			$einzug_left = 0;
			$einzug_top  = 0;
			
			// Skalierung mit einzug (links/oben)
			if($width != 0 AND $height != 0 AND $width != -1 AND $height != -1){
				
				$create_image_width		= $width;
				$create_image_height	= $height;
				
				if($width == $height){
					if($src_width > $src_height){
						$new_image_width	= $src_width * $width / $src_height;
						$new_image_height	= $height;
							
						$einzug_left		= (($new_image_width / 2) - ($width / 2)) * -1;
						$einzug_top			= 0;
					}else{
						$new_image_width	= $width;
						$new_image_height	= $src_height * $height / $src_width;
							
						$einzug_left		= 0;
						$einzug_top			= (($new_image_height / 2) - ($height / 2)) * -1;
					}
				}else{
					if($width > $height){
						$img_pixel = $height;
					}else{
						$img_pixel = $width;
					}
					if($src_width < $src_height){
						$new_image_width	= $img_pixel;
						$new_image_height	= $src_height * $img_pixel / $src_width;
					}else{
						$new_image_width	= $src_width * $img_pixel / $src_height;
						$new_image_height	= $img_pixel;
					}
					$einzug_left	= (($new_image_width / 2) - ($width / 2)) * -1;
					$einzug_top		= (($new_image_height / 2) - ($height / 2)) * -1;
				}
				
			// Skalierung nach Breite
			}else if($height != 0 AND $height != -1){
				if($src_width > $src_height OR $width == -1){
					$new_image_width	= $src_width * $height / $src_height;
					$new_image_height	= $height;
				}else{
					$new_image_width	= $height;
					$new_image_height	= $src_height * $height / $src_width;
				}
				$create_image_width		= $new_image_width;
				$create_image_height	= $new_image_height;
				
			// Skalierung nach H�he
			}else{
				if($src_width > $src_height OR $height == -1){
					$new_image_width	= $width;
					$new_image_height	= $src_height * $width / $src_width;
				}else{
					$new_image_width	= $src_width * $width / $src_height;
					$new_image_height	= $width;
				}
				$create_image_width		= $new_image_width;
				$create_image_height	= $new_image_height;
			}
			
			
			$new_image	= imagecreatetruecolor($create_image_width, $create_image_height);
			$white		= imagecolorallocate($new_image,255,255,255);
			imagefill($new_image,0,0,$white);
			imagecopyresampled($new_image,$im,$einzug_left,$einzug_top,0,0,$new_image_width,$new_image_height,$src_width,$src_height);
			
			imagejpeg($new_image,$img_src,100);
		}
		
		return copy($img_src,$to);
	}
	
	public static function checkPerms($dir,$perms=755){
		if(Utils::isLocal()){
			$perms = 755;
		}
		if(!@file_exists($dir)){
			if(!@mkdir($dir)){
				return false;
			}
		}
		$p = Utils::PermsToInt(self::getPerms($dir));
		if($p != $perms){
			return @chmod($dir,$perms);
		}
		return true;
	}
	
	public static function getPerms($dir){
		$perms = fileperms($dir);
		$info = "";
		if(($perms & 0xC000) == 0xC000){
			$info = 's';
		}else if(($perms & 0xA000) == 0xA000){
			// Symbolischer Link
			$info = 'l';
		}else if(($perms & 0x8000) == 0x8000){
			// Regulär
			$info = '-';
		}elseif (($perms & 0x6000) == 0x6000){
			// Block special
			$info = 'b';
		}else if(($perms & 0x4000) == 0x4000){
			// Verzeichnis
			$info = 'd';
		}else if(($perms & 0x2000) == 0x2000){
			// Character special
			$info = 'c';
		}else if(($perms & 0x1000) == 0x1000){
			// FIFO pipe
			$info = 'p';
		}else{
			// Unknown
			$info = 'u';
		}
		// Besitzer
		$info .= (($perms & 0x0100) ? 'r' : '-');
		$info .= (($perms & 0x0080) ? 'w' : '-');
		$info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x' ) : (($perms & 0x0800) ? 'S' : '-'));
		// Gruppe
		$info .= (($perms & 0x0020) ? 'r' : '-');
		$info .= (($perms & 0x0010) ? 'w' : '-');
		$info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x' ) : (($perms & 0x0400) ? 'S' : '-'));
		// Andere
		$info .= (($perms & 0x0004) ? 'r' : '-');
		$info .= (($perms & 0x0002) ? 'w' : '-');
		$info .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x' ) : (($perms & 0x0200) ? 'T' : '-'));
		return $info;
	}
}
?>