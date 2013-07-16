<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-20
 */
class TwitterState {
	
	protected $iId=0,$sText="",$iUserId=0,$sUserName="",$sUserImage="",$iStamp=0;
	
	public function __construct($xml=null){
		if($xml != null){
			$this->setDataFromXml($xml);
		}
	}
	
	public function setDataFromXml($xml){
		$this->setId((string)$xml->id);
		$this->setText((string)$xml->text);
		$this->setUserId((string)$xml->user->id);
		$this->setUserName((string)$xml->user->screen_name);
		$this->setUserImage((string)$xml->user->profile_image_url);
		$this->setStamp(strtotime((string)$xml->created_at));
	}
	
	public function __toString(){
		$link = $this->getUserLink();
		$link->setInner(Utils::inaccurateTime($this->getStamp()));
		$img = $this->getUserLink();
		$img->setInner('<img src="'.$this->getUserImage().'" class="Corner" />');
		return '<table width=100% cellspacing=0 cellpadding=0><tr valign=top><td width=53>'.$img.'</td><td>'.$link.'<p>'.$this->getText(true).'</td></tr></table>';
	}
	
	public function getId(){
		return $this->iId;
	}
	public function setId($id){
		$this->iId = $id;
	}
	
	public function getText($reg=false){
		if($reg){
			$str = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#","\\1<a href=\"\\2\" target=\"_blank\">\\2</a>",$this->sText);
			$str = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#","\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>",$str);
			$str = preg_replace("/@(\w+)/","<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>",$str);
			return preg_replace("/#(\w+)/","<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>",$str);
		}else{
			return $this->sText;
		}
	}
	public function setText($text){
		$this->sText = $text;
	}
	
	public function getUserId(){
		return $this->iUserId;
	}
	public function setUserId($id){
		$this->iUserId = $id;
	}
	
	public function getUserName(){
		return $this->sUserName;
	}
	public function setUserName($user){
		$this->sUserName = $user;
	}
	
	public function getUserImage(){
		return $this->sUserImage;
	}
	public function setUserImage($str){
		$this->sUserImage = $str;
	}
	
	public function getUserLink(){
		$link = new HtmlLink($this->getUserName(),"http://www.twitter.com/".$this->getUserName());
		$link->setAttribute("target","_blank");
		return $link;
	}
	
	public function getStamp(){
		return $this->iStamp;
	}
	public function setStamp($i){
		$this->iStamp = $i;
	}
	
	
	public static function send($status){
		if(TWITTER_USER AND TWITTER_PASS){
			$curl = curl_init("http://www.twitter.com/statuses/update.xml");
			curl_setopt_array($curl,array(
				CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => "status=".urlencode($status),
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_SSL_VERIFYHOST => false,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_USERPWD => TWITTER_USER.":".TWITTER_PASS
			));
			$output = curl_exec($curl);
			$header = curl_getinfo($curl);
			curl_close($curl);
			echo $output."<br />";
			if($header["http_code"] == 200){
				return true;
			}
		}
		return false;
	}
}
?>