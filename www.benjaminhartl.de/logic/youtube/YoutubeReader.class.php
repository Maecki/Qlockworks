<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-19
 */
class YoutubeReader {
	
	protected $aVideos = array();
	
	public function __construct($user){
		$url = 'http://gdata.youtube.com/feeds/api/users/'.$user.'/uploads';
		$xml = simplexml_load_file($url);
		
		foreach($xml->entry AS $e){
			if(preg_match("/\/([^\/]+)$/",(string)$e->id,$a)){
				$v = new YoutubeVideo();
				$v->setId($a[1]);
				$v->setName((string)$e->title);
				$v->setDescription((string)$e->content);
				$this->setVideo($v);
			}
		}
	}
	
	public function __toString(){
		$str = "";
		foreach($this->aVideos AS $vid){
			$str .= "<br />".$vid->render("description");
		}
		return $str;
	}
	
	public function getVideos($limit=0){
		if($limit > 0){
			$a = array();
			$i = 0;
			foreach($this->aVideos AS $vid){
				$a[$vid->getId()] = $vid;
				if($i >= $limit){
					return $a;
				}
				$i++;
			}
			return $a;
		}else{
			return $this->aVideos;
		}
	}
	
	public function getVideo($id){
		if(isset($this->aVideos[$id])){
			return $this->aVideos[$id];
		}
	}
	public function setVideo(YoutubeVideo $vid){
		$this->aVideos[$vid->getId()] = $vid;
	}
}
?>