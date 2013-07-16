<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-07
 */
class Sidebar extends SkeletonSection {
	
	protected $aItems=array();
	
	public function __construct(Skeleton $skeleton,User $user){
		parent::__construct($skeleton,$user);
		
		if($this->getUser()->isLoggedIn()){
			$logout = new HtmlLink("&raquo; Logout",PATH_WEB."/logout.php");
			$this->addItem("Verwaltung",'<p>&raquo; Version 0.0.1</p><p>'.$logout.'</p>');
		}
		$this->addItem("Soziales",'
		<table>
			<tr height=30>
				<td>
					<!-- Place this tag where you want the +1 button to render. -->
					<div class="g-plusone" data-size="medium" data-href="http://www.benjaminhartl.de"></div>
				</td>
				<td>
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.benjaminhartl.de" data-via="BenjaminHartl" data-lang="de">Twittern</a>
				</td>
			</tr>
			<tr>
				<td colspan=2>
					<div class="fb-like" data-href="http://www.benjaminhartl.de" data-send="true" data-layout="button_count" data-width="200" data-show-faces="true"></div>
				</td>
			</tr>
		</table>');
		
		$this->addItem('<a class="twitter-timeline" href="https://twitter.com/BenjaminHartl" data-widget-id="357208799687348225">Tweets von @BenjaminHartl</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>');
		
		$str = '<div class="Social">';
		$a = array(
			"email" => "mailto:info@benjaminhartl.de",
			"rss" => "http://bene-maecki.blogspot.com/feeds/posts/default",
			"blogger" => "http://bene-maecki.blogspot.com",
			"waidler" => "http://www.waidler.com/benjaminhartl",
			"youtube" => "http://www.youtube.com/DesireBene",
			"google" => "http://www.benjaminhartl.de/+",
			"facebook" => "http://www.facebook.com/BenjaminMaeckiHartl",
			"twitter" => "http://www.twitter.com/BenjaminHartl"
		);
		foreach($a AS $k=>$link){
			$str .= '<a href="'.$link.'" target="_blank"><img src="'.PATH_WEB.'/data/graphics/social/ic_'.$k.'.png" /></a>';
		}
		$str .= '<div class="Clear"></div></div>';
		
		$this->addItem("Im Web",$str);
		
		$str = "";
		$str .= '<p><a href="http://www.bsm.de/benjaminhartl" target="_blank"><img src="'.PATH_WEB.'/data/graphics/social/bsm.png" style="vertical-align:middle;margin-left:5px;" /></a></p>';
		$str .= '<p><a href="http://www.bsmparty.de/Benee" target="_blank"><img src="'.PATH_WEB.'/data/graphics/social/bsmparty.png" style="vertical-align:middle;margin-left:5px;" /></a></p>';
		$this->addItem("Regionales",$str);
		
	}
	
	public function __toString(){
		$str = "";
		foreach($this->aItems AS $a){
			$str .= ($a[1] != "" ? '<br /><h1>'.$a[0].'</h1>'.$a[1] : $a[0]).'<br />';
		}
		return $str;
	}
	
	public function addItem($name,$text=""){
		$i = count($this->aItems);
		$this->aItems[$i] = array($name,$text);
		return $i;
	}
	public function getItem($i){
		if(isset($this->aItems[$i])){
			return $this->aItems[$i];
		}
	}
}
?>