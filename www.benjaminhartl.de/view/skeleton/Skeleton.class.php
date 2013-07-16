<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-07
 */
class Skeleton {
	
	protected $user,$htmlHead,$header,$navigation,$sidebar,$footer,$aBodyEvent=array();
	
	public function __construct(User $user){
		
		$this->setUser($user);
		$this->setHtmlHead(new HtmlHead($this,$user));
		$this->setHeader(new Header($this,$user));
		$this->setNavigation(new Navigation($this,$user));
		$this->setSidebar(new Sidebar($this,$user));
		$this->setFooter(new Footer($this,$user));
		
		$this->setBodyEvent("onLoad","init({web:'".PATH_WEB."',root:'".PATH_JS."',title:'".HEADER_TITLE."'})");
		
		if(Utils::isLocal()){
			$this->getHtmlHead()->addStyle(PATH_WEB."/data/styles/main_raw.css?t=".time());
			$this->getHtmlHead()->addScript(PATH_WEB."/data/scripts/main_raw.js?t=".time());
		}else{
			$this->getHtmlHead()->addStyle(PATH_WEB."/data/styles/main_1.1.css");
			$this->getHtmlHead()->addScript(PATH_WEB."/data/scripts/main_1.1.js");
		}
		$this->getHtmlHead()->addScript(PATH_WEB."/data/scripts/jquery.js");
		$this->getHtmlHead()->addScript("http://platform.twitter.com/widgets.js");
	}
	
	public function begin(){
		
		echo '<!DOCTYPE html><html><head>';
		
		echo $this->getHtmlHead();
		
		echo '</head><body';
		foreach($this->aBodyEvent AS $event=>$function){
			echo ' '.$event.'="'.$function.'"';
		}
		echo '>';
		
		echo '<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/de_DE/all.js#xfbml=1&appId=333869743310952";
  fjs.parentNode.insertBefore(js, fjs);
}(document,"script","facebook-jssdk"));</script>';
		
		if($this->getUser()->isLoggedIn()){
			echo '<iframe name="iframe" id="iframe" style="display:none"></iframe>';
		}
		$max = 14;
		echo '<div class="Navigation" id="nav" style="background-image:url(data/graphics/css/guitar_'.rand(1,$max).'.png)" data-max="'.$max.'">';
		
		echo $this->getNavigation();
		
		echo '</div>';
		
		echo '<div class="Page">';
		
		echo '<div class="Header">';
		
		echo $this->getHeader();
		
		echo '</div>';
		
		echo '<div class="Content">';
		
		echo '<div class="ContentLeft"><div id="content">';
	}
	
	public function end(){
		
		echo '</div></div>';
		
		echo '<div class="Sidebar">';
		
		echo $this->getSidebar();
		
		echo '</div>';
		
		echo '<div class="Clear"></div>';
		
		echo '</div>';
		
		echo '<div class="Footer">';
		
		echo $this->getFooter();
		
		echo '</div>';
		
		echo '</div>';
		
		echo '<div id="popup"></div>';
		
		if($this->getUser()->isLoggedIn()){
			echo '<script type="text/javascript">
			$("#navigation").sortable({
				distance: 15,
				items: ".NavigationElement",
				cancel: ".ui-state-disabled",
				stop: function(event, ui){
					ajaxPost("page","setSortNavigation","sort="+getSort(document.getElementById("navigation")));
				}
			});
			</script>';
		}
		echo '
		<script type="text/javascript">
  (function() {
    var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
    po.src = "https://apis.google.com/js/plusone.js";
    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
  })();
</script>';
		
		echo '</body></html>';
	}
	
	public function getUser(){
		return $this->user;
	}
	public function setUser(User $user){
		$this->user = $user;
	}
	
	public function getHtmlHead(){
		return $this->htmlHead;
	}
	public function setHtmlHead(HtmlHead $htmlHead){
		$this->htmlHead = $htmlHead;
	}
	
	public function getHeader(){
		return $this->header;
	}
	public function setHeader(Header $header){
		$this->header = $header;
	}
	
	public function getNavigation(){
		return $this->navigation;
	}
	public function setNavigation(Navigation $navigation){
		$this->navigation = $navigation;
	}
	
	public function getSidebar(){
		return $this->sidebar;
	}
	public function setSidebar(Sidebar $sidebar){
		$this->sidebar = $sidebar;
	}
	
	public function getFooter(){
		return $this->footer;
	}
	public function setFooter(Footer $footer){
		$this->footer = $footer;
	}
	
	public function getBodyEvent($event){
		if(isset($this->aBodyEvent[$event])){
			return $this->aBodyEvent[$event];
		}
	}
	public function setBodyEvent($event,$function){
		$this->aBodyEvent[$event] = $function;
	}
	
	public static function getContent($item){
		if($item instanceof NavigationElement){
			$c = new Content($item->getUser(),$item);
			return (string)$c;
		}else{
			return FileManager::getContent(PATH_ROOT."/data/404.tpl");
		}
	}
}
?>