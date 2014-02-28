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
	
	public static function getLink($url,$blank=true){
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
			return self::prefixZeros($a[3],2).".".self::prefixZeros($a[2],2).".".self::prefixZeros($a[1],4);
		}else if(is_numeric($date)){
			return date("d.m.Y",$date);
		}
		return $date;
	}
	public static function toSqlDate($date){
		if(preg_match("/(\d+)\.(\d+)\.(\d+)/",$date,$a)){
			return self::prefixZeros($a[3],4)."-".self::prefixZeros($a[2],2)."-".self::prefixZeros($a[1],2);
		}else if(is_numeric($date)){
			return date("Y-m-d",$date);
		}
		return $date;
	}
	
	public static function generatePassword($length=5){
		$pass = "";
		$map = array("1","2","3","4","5","6","7","8","9","A","B","C","E","F","G","H","K","m","n","p","q","r","t","x","y","z");
		$max = count($map)-1;
		for($i=1;$i<$length;$i++){
			$pass .= $map[rand(0,$max)];
		}
		$map = array("!","-","+","=","_",".",",");
		$pass .= $map[rand(0,count($map)-1)];
		return $pass;
	}
	
	
	public static function urlEncode($str){
		$str = self::umlEncode($str);
		$str = stripslashes(trim($str));
		$str = strtolower($str);
		$a = array(
			"	"=>"-",
			" "=>"-",
			"'"=>"",
			'"'=>"",
			"`"=>"",
			"'"=>"",
			"&"=>"und",
			"?"=>"",
			"!"=>"",
			"^"=>"",
			"°"=>"",
			"="=>"",
			"@"=>"",
			"€"=>"euro",
			"%"=>"",
			"$"=>"",
			"#"=>"",
			"|"=>"",
			"<"=>"",
			">"=>"",
			"~"=>"",
			":"=>"",
			"."=>"",
			";"=>"",
			","=>"",
			";"=>"",
			","=>"",
			"+"=>"",
			"*"=>"",
			"/"=>"",
			"\\"=>"",
			"("=>"",
			")"=>"",
			"["=>"",
			"]"=>"",
			"{"=>"",
			"}"=>""
		);
		foreach($a AS $k=>$v){
			$str = str_replace($k,$v,$str);
		}
		for($i=8;$i<=16;$i++){
			$k = $i;
			switch($i){
				case 10: $k="A"; break;
				case 11: $k="B"; break;
				case 12: $k="C"; break;
				case 13: $k="D"; break;
				case 14: $k="E"; break;
				case 15: $k="F"; break;
			}
			for($j=0;$j<=16;$j++){
				$l = $j;
				switch($j){
					case 10: $l="A"; break;
					case 11: $l="B"; break;
					case 12: $l="C"; break;
					case 13: $l="D"; break;
					case 14: $l="E"; break;
					case 15: $l="F"; break;
				}
				$str = str_replace("%".$k.$l,"",$str);
			}
		}
		$str = str_replace("---","-",$str);
		$str = str_replace("--","-",$str);
		return $str;
	}
	public static function umlEncode($str){
		$a = array(
			"&Auml"=>"AE",
			"&auml;"=>"ae",
			"&Ouml;"=>"OE",
			"&ouml;"=>"oe",
			"&Uuml;"=>"UE",
			"&uuml;"=>"ue",
			"&szlig;"=>"ss"
		);
		foreach($a AS $k=>$v){
			$str = str_replace($k,$v,$str);
		}
		return $str;
	}
	public static function commentEncode($str){
		$str = preg_replace("/((http(s{0,1}):\/\/([a-z0-9\-\.]+))\/([\d\w\-\.\/_]+)\.(?:jpg|jpeg|png|gif))/",'<a href="\\2" target="_blank"><img src="\\1" /></a>',$str);
		$str = preg_replace("/[^\"](http(s{0,1}):\/\/([\d\w\-\.\/_]+))/",'<a href="\\1" target="_blank">\\3</a>',$str);
		return nl2br($str);
	}
	
	public static function mail($to,$title,$html){
		$html .= '<br /><br />---<br />mit freundlichen Gr&uuml;&szlig;en<br /><b>Qlockworks</b><br /><br /><a href="http://www.qlockworks.de" target="_blank">www.qlockworks.de</a> | <a href="http://www.qlockworks.de/kontact.php" target="_blank">Kontakt</a> | <a href="http://www.qlockworks.de/imprint.php" target="_blank">Impressum</a>';
		$exp = md5(uniqid(time()));
		$head = "MIME-Version: 1.0\n";
		$head .= "Content-type: multipart/alternative; boundary=".$exp."\n";
		$head .= "From: Qlockworks <info@qlockworks.de>\n";
		$head .= "Reply-To: Qlockworks <info@qlockworks.de>\n";
		$head .= "X-Mailer: PHP ".phpversion()."\n";
		$body = "";
		$html = str_replace(array("\\r\\n"=>"","\\r"=>"","\\n"=>""),"",$html);
		$text = html_entity_decode(str_replace(array("<br>","<br/>","<br />"),"\n",$html),ENT_QUOTES,"utf-8");
		$a = array(
			"\<br([^\>*])\>"=>" \n",
			"\<hr([^\>*])\>"=>"----------\n",
			"\<p([^\>*])\>"=>"",
			"\<\/p\>"=>"\n",
			"\<h1([^\>*])\>"=>"**** ",
			"\<\/h1\>"=>" ****\n",
			"\<h2([^\>*])\>"=>"*** \n",
			"\<\/h2\>"=>" ***\n",
			"\<h3([^\>*])\>"=>"=== \n",
			"\<\/h3\>"=>" ===\n",
			"\<h4([^\>*])\>"=>"== \n",
			"\<\/h4\>"=>" ==\n",
			"\<h5([^\>*])\>"=>" --\n",
			"\<\/h5\>"=>" --\n"
		);
		foreach($a AS $k=>$v){
			$text = preg_replace("/".$k."/i",$v,$text);
		}
		$text = strip_tags($text);
		$body .= "--".$exp."\n";
		$body .= "Content-Disposition: inline\n";
		$body .= "Content-Transfer-Encoding: quoted-printable\n";
		$body .= "Content-Type: text/plain; charset=utf-8\n";
		$body .= "\n";
		$body .= $text."\n";
		$body .= "\n\n";
		$body .= "--".$exp."\n";
		$body .= "Content-Disposition: inline\n";
		$body .= "Content-Transfer-Encoding: quoted-printable\n";
		$body .= "Content-Type: text/html; charset=utf-8\n";
		$body .= "\n";
		$body .= '<html><head><meta http-equiv="content-type" content="text/html; charset=utf-8"><title>'.$title.'</title></head><body>'.$html.'</body></html>'."\n";
		$body .= "\n\n";
		$body .= "--".$exp."--";
		if(self::isLocal()){
			return QwFileManager::setContent("data/local/mail_".date("Y-m-d_H-i-s").".tpl",$head."To: ".$to."\n\n".$body);
		}
		return mail($to,html_entity_decode($title,ENT_QUOTES,"utf-8"),$body,$head);
	}
	
	
	public static function share($link,$name,$desc,$image){
		return "teilen auf ";
	}
}
?>