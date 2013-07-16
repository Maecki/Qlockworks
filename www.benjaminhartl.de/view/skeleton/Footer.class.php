<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-07
 */
class Footer extends SkeletonSection {
	
	public function __toString(){
		$str = '
		<ul class="Float">
			<li>&copy; 2012 <a href="http://www.maecki.com" target="_blank">Maecki.com</a></li>
		</ul>
		<ul class="Float">
			<li><a href="http://www.diaryofben.de" target="_blank">Diary Of Ben</a></li>
			<li><a href="http://www.forestsounds.de.vu" target="_blank">Forestsounds Sandbox</a></li>
			<li><a href="http://www.clockworks-revolution.de" target="_blank">Clockworks-Revolution</a></li>
		</ul>
		<ul class="Float">
			<li><a href="http://www.youtube.com/user/DesireBene" target="_blank">Youtube</a></li>
			<li><a href="http://bene-maecki.blogspot.com" target="_blank">Blogger</a></li>
			<li><a href="https://www.xing.com/profile/Benjamin_Hartl4" target="_blank">Xing</a></li>
			<li><a href="http://www.maecki.com/rss" target="_blank">RSS-Feeds</a></li>
		</ul>
		<ul class="Float">
			<li><a href="https://plus.google.com/105809821494408500914" target="_blank">Google+</a></li>
			<li><a href="http://www.facebook.com/BenjaminMaeckiHartl" target="_blank">Facebook</a></li>
			<li><a href="http://twitter.com/BenjaminHartl" target="_blank">Twitter</a></li>
		</ul>
		<ul class="Float">';
//			<li><a href="" target="_blank">bsm.de</a></li>
		$str .= '
			<li><a href="http://www.bsmparty.de/Benee" target="_blank">bsmparty.de</a></li>
			<li><a href="http://www.waidler.com/profil/1693.benjamin-hartl" target="_blank">waidler.com</a></li>
		</ul>
		<ul class="Float">
			<li><a href="http://www.bwmedien.biz" target="_blank">BWmedien GmbH</a></li>
			<li><a href="http://www.bwcms.eu" target="_blank">BWcms</a></li>
			<li><a href="http://blog.bwmedien.biz" target="_blank">Entwickler-Blog</a></li>
			<li><a href="http://www.bwmedien.biz/team" target="_blank">Kollegen</a></li>
		</ul>
		<div class="Clear"></div>';
		return $str;
	}
}
?>