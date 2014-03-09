<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-24
 */
class QwSkeleton extends QwCaller {
	
	public function __construct($title=""){
		$this->setTitle($title);
		$this->setDescription("Qlockworks Entwickler-Club. Der Online-Blog mit Tutorials und Beispielen f&uuml;r Entwicklung und Programmierung mit verschiedenen Technicken. Verschiedene Dokumentationen f&uuml;r Projekte, Objektorientierung, Datenbankstrukturen und vieles mehr.");
		$this->setImage(QW_WEB."/style/small.png");
		$this->setLink($_SERVER["REQUEST_URI"]);
	}
	
	public function begin(){
		echo '<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="language" content="de" />
		<meta name="publisher" content="www.qlockworks.de" />
		<meta name="author" content="Qlockworks" />
		<title>'.$this->getTitle().($this->getTitle() != "" ? " | " : "").'Qlockworks | Blog, Tutorials und Beispiele f&uuml;r Entwicklung und Programmierung</title>
		<meta name="description" content="'.$this->getDescription().'" />
		<meta name="keywords" content="Qlockworks,Entwicker,Programmierung,Blog,'.($this->getKeywords() != "" ? $this->getKeywords() : "HTML,CSS,JavaScript,PHP,Python,Perl,C/C++,Java").'" />
		<meta itemprop="image" content="'.$this->getImage().'" />
		<meta property="og:image" content="'.$this->getImage().'" />
		<link rel="image_src" href="'.$this->getImage().'" />
		<meta name="revisit-afet" content="4 days" />
		<meta name="robots" content="all">
		<link href="http://www.maecki.com/data/icons/icon.png" rel="shortcut icon" type="image/png" />
		<link rel="coanonical" href="'.$this->getLink().'" />
		<link rel="stylesheet" href="'.QW_WEB.'/style/content.css" />
		<link rel="stylesheet" href="'.QW_WEB.'/style/style.css" />
		<link href="'.QW_WEB.'/favicon.ico" rel="Shortcut Icon" />
		<script src="'.QW_WEB.'/style/script.js"></script>';
		if($this->getTinymce()){
			echo '
		<script src="'.QW_WEB.'/tinymce/tinymce.min.js"></script>';
		}
		echo '
	</head>
	<body>
		<div class="Shadow"></div>
		<div id="cws">
			<header class="Header">
				<a href="'.QW_WEB.'" class="Logo"></a>
				<form action="'.QW_WEB.'/index.php" method="get">
					<input type="text" name="search" />
					<input type="submit" value="suchen" />
				</form>
				<nav class="Navigation">
					<a href="'.QW_WEB.'">Blog</a>
					<a href="'.QW_WEB.'/philosophie.php">Philosophie</a>
					<a href="'.QW_WEB.'/contact.php">Kontakt</a>
					<div class="Clear"></div>
				</nav>
			</header>
			<div class="Content">
				<section class="Float Main">';
	}
	
	public function end(){
		$log = QwLog::getInstance();
		echo '<br />
				</section>
				<section class="Float Sidebar">';
		if($log->isLoggedIn()){
			echo '
					<aside>
						<h1>Hallo '.$log->getUser()->getName().'</h1>
						<ul>
							<li><a href="'.QW_WEB.'/user.php">Profil / Einstellungen</a></li>
							<li><a href="'.QW_WEB.'/edit.php">Neuen Eintrag erstellen</a></li>
							<li><a href="'.QW_WEB.'/logout.php">Abmelden</a></li>
					</aside>';
		}
		echo '
					<aside>
						<h1>Soziales</h1>
						<table style="width:100%">
							<tr>
								<td>
									<iframe frameborder="0" hspace="0" marginheight="0" marginwidth="0" scrolling="no" style="position: static; top: 0px; width: 90px; margin: 0px; border-style: none; left: 0px; visibility: visible; height: 20px;" tabindex="0" vspace="0" width="100%" id="I0_1393076382176" name="I0_1393076382176" src="https://apis.google.com/u/0/_/+1/fastbutton?usegapi=1&amp;bsv=o&amp;size=medium&amp;hl=de&amp;origin=http%3A%2F%2Flocalhost&amp;url=http%3A%2F%2Fwww.qlockworks.de%2F&amp;gsrc=3p&amp;ic=1&amp;jsh=m%3B%2F_%2Fscs%2Fapps-static%2F_%2Fjs%2Fk%3Doz.gapi.de.eE2kU8gbEXU.O%2Fm%3D__features__%2Fam%3DIQ%2Frt%3Dj%2Fd%3D1%2Ft%3Dzcms%2Frs%3DAItRSTMi82VLy9ofG_5HdWhkmzm2R4u7Hw#_methods=onPlusOne%2C_ready%2C_close%2C_open%2C_resizeMe%2C_renderstart%2Concircled%2Cdrefresh%2Cerefresh%2Conload&amp;id=I0_1393076382176&amp;parent=http%3A%2F%2Flocalhost&amp;pfname=&amp;rpctoken=11163049" data-gapiattached="true" title="+1"></iframe>
								</td>
								<td>
									<iframe name="f34662bd68" width="450px" height="1000px" frameborder="0" allowtransparency="true" scrolling="no" title="fb:like Facebook Social Plugin" src="http://www.facebook.com/plugins/like.php?app_id=172050012862714&amp;channel=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D40%23cb%3Df16591c0d%26domain%3Dlocalhost%26origin%3Dhttp%253A%252F%252Flocalhost%252Ff25b9101fc%26relation%3Dparent.parent&amp;href=http%3A%2F%2Fwww.qlockworks.de%2F&amp;layout=button_count&amp;locale=de_DE&amp;sdk=joey&amp;send=false&amp;show_faces=true&amp;width=450" class="" style="border: none; visibility: visible; width: 111px; height: 20px;"></iframe>
								</td>
							</tr>
						</table>
					</aside>
					<aside>
						<h1>Aktuelles</h1>';
		$i = 0;
		$pm = new QwProjectManager();
		$pm->setLimit(2);
		$pm->execute();
		$pa = $pm->getObjects();
		foreach($pa AS $p){
			$i++;
			if($i == 2){
				echo '<hr />';
			}
			echo '<a href="'.$p->getLink().'" class="Row"><img src="'.$p->getImage("kl").'" width=50 /><strong>'.$p->getName().'</strong><br />'.$p->getDescription().' <em>... mehr</em></a>';
		}
		echo '
					</aside>
					<aside>
						<h1>Tag-Cloud</h1>
						<div class="Tagcloud">';
		$a = QwProjectManager::tagcloud();
		$i = 0;
		foreach($a AS $tag=>$anz){
			$i++;
			if($i > 1){
				echo " ";
			}
			$size = 8;
			foreach(array(3,5,8,12,17,22,22,28,35,42,50,60) AS $min){
				if($anz > $min){
					$size++;
				}
			}
			echo '<a href="'.QW_WEB.'/index.php?tag='.$tag.'" style="font-size:'.$size.'px">'.$tag.'</a>';
		}
		echo '
						</div>
					</aside>
					<aside class="Twitter">
						<a class="twitter-timeline"  href="https://twitter.com/t_Qlockworks"  data-widget-id="437238274533228545">Tweets von @t_Qlockworks</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</aside>
				</section>
				<div class="Clear"></div>
			</div>
			<footer class="Footer">
				<div class="Float Social">
					<a href="https://www.facebook.com/qlockworks" target="_blank" class="Float Facebook"></a>
					<a href="https://twitter.com/t_Qlockworks" target="_blank" class="Float Twitter"></a>
					<a href="https://plus.google.com/110722432864167818451" target="_blank" class="Float Google"></a>
					<a href="'.QW_WEB.'/rss.php" target="_blank" class="Float Rss"></a>
					<div class="Clear"></div>
				</div>
				<ul class="Float">
					<li>&copy; '.date("Y").' <a href="'.QW_WEB.'">Qlockworks</a></li>
				</ul>
				<ul class="Float">
					<li><a href="'.QW_WEB.'/philosophie.php">Philosophie</a></li>
					<li><a href="'.QW_WEB.'/partner.php">Links &amp; Partnerseiten</a></li>
				</ul>
				<ul class="Float">';
		$y = date("Y");
		echo '<li><a href="'.QW_WEB.'/index.php?year='.$y.'">Archiv</a></li>';
		for($i=$y;$i>=2013;$i--){
			echo '<li><a href="'.QW_WEB.'/index.php?year='.$i.'">'.$i.'</a></li>';
		}
		echo '
				</ul>
				<ul class="Float">
					<li><a href="'.QW_WEB.'/contact.php">Kontakt</a></li>
					<li><a href="'.QW_WEB.'/imprint.php">Impressum</a></li>
				</ul>
				<ul class="Float">
					<li><a href="'.QW_WEB.'/login.php">INTERN</a></li>
				</ul>
				<div class="Clear"></div>
			</footer>
		</div>
		<script>
			qw.init();';
		if($this->getTinymce()){
			echo '
			tinymce.init({
				selector: ".Html",
				relative_urls: false,
				remove_script_host: false,
				paste_as_text: true,
				content_css : "'.QW_WEB.'/style/content.css",
				plugins: [
					"advlist autolink lists link image charmap print preview anchor",
					"searchreplace visualblocks code fullscreen",
					"insertdatetime media table contextmenu paste"
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image"
			});';
		}
		echo '
		</script>
	</body>
</html>';
	}
	
	public static function nav($link,$anz,$limit,$select){
		$str = '<div class="Navigation">';
		$j = 0;
		for($i=0;$i<=$anz;$i+=$limit){
			$j++;
			if($i == $select){
				$str .= '<a href="'.$link.$i.'">'.$j.'</a>';
			}
		}
		$str .= '</div>';
		return $str;
	}
	
	public static function getBox($str){
		return '<div class="Box">'.$str.'</div>';
	}
	public static function getBoxOk($str){
		return '<div class="Box BoxOk">'.$str.'</div>';
	}
	public static function getBoxError($str){
		return '<div class="Box BoxError">'.$str.'</div>';
	}
}
?>