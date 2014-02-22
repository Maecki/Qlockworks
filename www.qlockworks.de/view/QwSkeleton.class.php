<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-24
 */
class QwSkeleton extends QwCaller {
	
	const NONE = -1;
	const HOME = 0;
	const PROJECTS = 1;
	const TEAM = 2;
	const CONTACT = 3;
	const IMPRINT = 4;
	
	public function __construct($title=""){
		$this->setTitle($title);
		$this->setDescription("Das Qlockworks-Entwicklerteam.");
		$this->setSelect(self::NONE);
	}
	
	public function begin(){
		echo '<!DOCTYPE html>
<html>
	<head>
		<title>'.$this->getTitle().($this->getTitle() != "" ? " | " : "").'Qlockworks | Informatiker-Club Entwicklungs-Blog</title>
		<meta name="description" content="'.$this->getDescription().'" />
		<meta name="keywords" content="Qlockworks,Entwicker" />
		<link rel="stylesheet" href="style/style.css" />
		<link href="favicon.ico" rel="Shortcut Icon" />
		<script src="style/script.js"></script>
	</head>
	<body>
		<div id="fb-root"></div>
		<div class="Shadow"></div>
		<div id="cws">
			<header class="Header">
				<a href="#" class="Logo"></a>
				<form action="project.php" method="get">
					<input type="text" name="text" />
					<input type="submit" value="suchen" />
				</form>
				<nav class="Navigation">
					<a href="#">Start</a>
					<a href="#">Philosophie</a>
					<a href="#">Kontakt</a>
					<div class="Clear"></div>
				</nav>
			</header>
			<div class="Content">
				<section class="Float Main">
					<p><a href="">Qlockworks</a> &raquo; <a href="">Archiv</a></p>
					<br />';
	}
	
	public function end(){
		$log = QwLog::getInstance();
		echo '<br />
				</section>
				<section class="Float Sidebar">';
		if($log->isLoggedIn()){
			echo '
					<aside>
						<h1>Hallo '.$log->getUser()->getFirstname().'</h1>
						<a href="'.QW_WEB.'/user.php">Mein Profil</a>
						|
						<a href="'.QW_WEB.'/user_setup.php">Einstellungen</a>
						|
						<a href="'.QW_WEB.'/logout.php">Logout</a>
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
						<h1>Aktuelles</h1>
						<a href="#" class="Row">
							<img src="style/small.png" width=50 /><strong>Neus Projekt zum neuen Jahr 2014</strong><br />
							Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut.
							... mehr
						</a>
						<hr />
						<a href="#" class="Row">
							<img src="style/small.png" width=50 /><strong>Tic Tac Toe</strong><br />
							Eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
							... mehr
						</a>
					</aside>
					<aside>
						<h1>Tag-Cloud</h1>
						<div class="Tagcloud">
						<a href="" style="font-size:14px">Android</a>
						<a href="" style="font-size:10px">C/C++</a>
						<a href="" style="font-size:10px">C#</a>
						<a href="" style="font-size:13px">Chrome</a>
						<a href="" style="font-size:13px">Cloud</a>
						<a href="" style="font-size:15px">CSS</a>
						<a href="" style="font-size:12px">Firefox</a>
						<a href="" style="font-size:16px">HTML</a>
						<a href="" style="font-size:11px">Java</a>
						<a href="" style="font-size:16px">JavaScript</a>
						<a href="" style="font-size:15px">MySQL</a>
						<a href="" style="font-size:8px">MsSQL</a>
						<a href="" style="font-size:18px">PHP</a>
						<a href="" style="font-size:12px">Python</a>
						<a href="" style="font-size:12px">Perl</a>
						<a href="" style="font-size:8px">Visual Basic</a>
						<a href="" style="font-size:11px">Windows 8</a>
						<a href="" style="font-size:10px">Windows Phone</a>
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
					<li><a href="'.QW_WEB.'/categories.php">Philosophie</a></li>
					<li><a href="'.QW_WEB.'/project.php">Links &amp; Partnerseiten</a></li>
				</ul>
				<ul class="Float">
					<li><a href="'.QW_WEB.'/projekte.php?status=y">Archiv</a></li>';
		for($i=date("Y");$i>=2013;$i--){
			echo '
					<li><a href="'.QW_WEB.'/projekte.php?status=y&year='.$i.'">'.$i.'</a></li>';
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
			qw.init();
		</script>
	</body>
</html>';
	}
}
?>