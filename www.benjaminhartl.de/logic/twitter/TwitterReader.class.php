<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-20
 */
class TwitterReader {
	
	protected $aStates=array();
	
	public function __construct($user,$limit=4){
		if($xml = @simplexml_load_file("https://api.twitter.com/1/statuses/user_timeline.xml?screen_name=".$user."&count=".$limit)){
			$i = 0;
			foreach($xml->status AS $s){
				$i++;
				$this->setState(new TwitterState($s));
				if($i >= $limit){
					break;
				}
			}
		}
	}
	
	public function __toString(){
		$str = "";
		foreach($this->aStates AS $e){
			$str .= (string)$e;
		}
		return $str;
	}
	
	public function getState($id){
		if(isset($this->aStates[$id])){
			return $this->aStates[$id];
		}
	}
	public function setState(TwitterState $entry){
		$this->aStates[$entry->getId()] = $entry;
	}
}
?>