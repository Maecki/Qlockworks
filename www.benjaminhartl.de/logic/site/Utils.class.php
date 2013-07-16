<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-15
 */
final class Utils {
	
	public static function prefixZeros($expression, $quantity){
		return str_pad($expression, $quantity, '0', STR_PAD_LEFT);
	}
	
	
	public static function zend($path=""){
		if($dir	= openDir(PATH_ROOT."/extern/Zend/".$path)){
			while($filelist = readDir($dir)){
				if(!preg_match("/^\./",$filelist)){
					$p = PATH_ROOT."/extern/Zend/".$path."/".$filelist;
					if(is_dir($p)){
						self::zend($path."/".$filelist);
					}else if(preg_match("/\.php$/",$filelist)){
						FileManager::setContent($p,str_replace("'Zend/","PATH_ROOT.'/extern/Zend/",FileManager::getContent($p)));
					}
				}
			}
		}
		closedir($dir);
	}
	
	public static function urlEncode($str,$sub=0){
		
		$str = self::umlEncode($str);
		$str = html_entity_decode($str,ENT_QUOTES);
		$str = stripslashes($str);
		
		$a = array("\\"=>"",
					" "=>"-",
					"&"=>"und",
					"?"=>"",
					"!"=>"",
					'"'=>"",
					"'"=>"",
					"`"=>"",
					"´"=>"",
					"„"=>"",
					"“"=>"",
					"="=>"",
					"+"=>"",
					"*"=>"",
					"/"=>"",
					"("=>"",
					")"=>"",
					"["=>"",
					"]"=>"",
					"{"=>"",
					"}"=>"",
					"@"=>"",
					"€"=>"EURO",
					"%"=>"",
					"$"=>"",
					"§"=>"",
					"#"=>"",
					"®"=>"",
					"|"=>"",
					"<"=>"",
					">"=>"",
					"^"=>"",
					"²"=>"2",
					"³"=>"3",
					"ø"=>"",
					"~"=>"-",
					":"=>"",
					";"=>"",
					"="=>"",
					"á"=>"a",
					"à"=>"a",
					"â"=>"a",
					"é"=>"e",
					"ê"=>"e",
					"è"=>"e",
					"ë"=>"e",
					"ñ"=>"n",
					"ó"=>"o",
					"ò"=>"o",
					"ô"=>"o",
					"ú"=>"u",
					"ù"=>"u",
					"û"=>"u",
					"é"=>"");
		
		foreach($a AS $key=>$val){
			$str = str_replace($key,$val,$str);
		}
		
		$str = str_replace("---","-",$str);
		$str = str_replace("--","-",$str);
		
		if($sub > 0){
			$str = substr($str,0,$sub);
		}
		
		return $str;
	}
	
	public static function umlEncode($str){
		$str = str_replace("&Auml;","AE",$str);
		$str = str_replace("&auml;","ae",$str);
		$str = str_replace("&Ouml;","OE",$str);
		$str = str_replace("&ouml;","oe",$str);
		$str = str_replace("&Uuml;","UE",$str);
		$str = str_replace("&uuml;","ue",$str);
		$str = str_replace("&szlig;","ss",$str);
		return $str;
	}
	
	public static function pregEncode($str,$end="i"){
		$a1 = array("(",")","{","}","[","]","*","+","/","\\");
		$a2 = array("","","","","","","","","","");
		return "/".str_replace($a1,$a2,$str)."/".$end;
	}
	
	public static function mailEncode($str){
		return preg_replace("/([\d\w_\-\.]+)@(([\d\w\-\.]+)\.\w{2,4})/",'<a href="#" data-mail="\\1" data-host="\\2"></a>',$str);
	}
	
	public static function inaccurateTime($stamp){
		$seconds = time()-$stamp;
		$minutes = 0;
		$hours = 0;
		$days = 0;
		$weeks = 0;
		$months = 0;
		$years = 0;
		if ($seconds == 0) $seconds = 1;
		if ($seconds > 60) { $minutes =  $seconds/60; }
		else { return self::getInaccurateTime($seconds,'Sekunde'); }
		if ( $minutes >= 60 ) { $hours = $minutes/60; }
		else { return self::getInaccurateTime($minutes,'Minute'); }
		if ( $hours >= 24) { $days = $hours/24; }
		else { return self::getInaccurateTime($hours,'Stunde'); }
		if ( $days >= 7 ) { $weeks = $days/7; }
		else { return self::getInaccurateTime($days,'Tag'); }
		if ( $weeks >= 4 ) { $months = $weeks/4; }
		else { return self::getInaccurateTime($weeks,'Woche'); }
		if ( $months >= 12 ) { $years = $months/12; return self::getInaccurateTime($years,'Jahr'); }
		else { return self::getInaccurateTime($months,'Monat'); }
	}
	
	private static function getInaccurateTime($num,$word){
		$num = floor($num);
		$addon = "n";
		if($word=="Tag" || $word=="Monat") $addon = "en";
		if ($num == 1) return "Vor ".$num." ".$word;
		else return "Vor ".$num." ".$word.$addon;
	}
	
	public static function extLink($str){
		return preg_replace("/(http(s{0,1}):\/\/([\d\w\-\.]+\.\w{2,4}))/",'<a href="\\1" target="_blank">\\3</a>',$str);
	}
	
	public static function protect($key,$val){
		if(!preg_match("/html/",$key)){
			//$val = htmlspecialchars($val);
			$val = htmlentities($val,ENT_QUOTES,"UTF-8");
			$val = str_replace("'","&#039;",$val);
		}
		return stripslashes($val);
	}
	
	public static function classImplements($class,$parentClass){
		$reflection = new ReflectionClass($class);
		return $reflection->isSubclassOf($parentClass);
	}
	
	public static function classExists($name){
		global $classpaths;
		foreach($classpaths AS $class=>$path){
			if($class == $name){
				return true;
			}
		}
		return false;
	}
	
	public static function mail($from,$to,$title,$text){
		mail($to,$title,'<!DOCTYPE html><html><head><title>'.$title.'</title></head><body>'.$text.'</body></html>','MIME-Version: 1.0\r\nContent-type: text/html; charset=iso-8859-1\r\nFrom: '.MAIL_SENDER.'\r\nReply-To: '.$from.'\r\nX-Mailer: PHP '.phpversion());
	}
	
	public static function isLocal(){
		return (preg_match("/\.(dev|local)$/",$_SERVER["SERVER_NAME"]) OR $_SERVER["SERVER_NAME"] == "localhost");
	}
}