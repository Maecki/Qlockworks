<?php
/**
 * Copyright 2013 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-24
 */
final class QwUtils {
	
	public static function protect($key,$val){
		if(preg_match("/html/",$key)){
			$val = str_replace("'","&#039;",$val);
		}else{
			$val = htmlentities($val,ENT_QUOTES);
		}
		return $val;
	}
	
	public static function isLocal(){
		return preg_match("/local/",$_SERVER["SERVER_NAME"]);
	}
	
	public static function checkEmail($mail){
		return preg_match("/^[_a-z0-9\-]+(\.[_a-z0-9\-]+)*@([a-z0-9\-]+(\.[a-z0-9\-]+)*)(\.[a-z]{2,4})$/i",$mail);
	}
	
	public static function link($url,$blank=true){
		$name = str_replace(array("http://","https://","www."),"",$url);
		if(preg_match("/^([^\.]+)\.([\w+]{2,4})$/i",$url)){
			$url = "www.".$url;
		}
		if(!preg_match("/:\/\//",$url)){
			$url = "http://".$url;
		}
		return '<a href="'.$url.'"'.($blank ? ' target="_blank"' : '').'>'.$name.'</a>';
	}
	
	public static function prefixZeros($id,$length){
		return str_pad($id,$length,'0',STR_PAD_LEFT);
	}
	
	public static function toGermanDate($date){
		if(preg_match("/(\d+)\-(\d+)\-(\d+)/",$date,$a)){
			return $a[3].".".$a[2].".".$a[1];
		}else if(is_numeric($date)){
			return date("d.m.Y",$date);
		}
	}
	public static function toSqlDate($date){
		if(preg_match("/(\d+)\.(\d+)\.(\d+)/",$date,$a)){
			return $a[3]."-".$a[2]."-".$a[1];
		}else if(is_numeric($date)){
			return date("Y-m-d",$date);
		}else{
			return $date;
		}
	}
	public static function getAge($date){
		list($akt_jahr,$akt_monat,$act_tag) = explode("-",date("Y-m-d"));
		list($geb_jahr,$geb_monat,$geb_tag) = explode("-",$date);
		if($akt_jahr > $geb_jahr){
			$alter = $akt_jahr - $geb_jahr;
			$v = $akt_monat - $geb_monat;
			if($v < 0){
				$alter = $alter - 1;
			}else if($v == 0){
				$d = $akt_tag - $geb_tag;
				if($d < 0){
					$alter = $alter - 1;
				}
			}
		}else{
			$alter = 0;
		}
		return $alter;
	}
}
?>