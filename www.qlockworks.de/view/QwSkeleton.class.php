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
		<title>'.$this->getTitle().($this->getTitle() != "" ? " | " : "").'Qlockworks Entwickler Team</title>
		<meta name="description" content="'.$this->getDescription().'" />
		<meta name="keywords" content="Qlockworks,Entwicker" />
		<link rel="stylesheet" href="style/style.css" />
		<link href="favicon.ico" rel="Shortcut Icon" />
		<script src="style/script.js"></script>
	</head>
	<body>
		<div id="fb-root"></div>
		<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/de_DE/all.js#xfbml=1&appId=172050012862714";
			fjs.parentNode.insertBefore(js, fjs);
		}(document,"script","facebook-jssdk"));
		</script>
		<div class="Shadow"></div>
		<div id="cws">
			<header class="Header">
				<img src="style/team.jpg" class="Logo" />
				<div class="Info">
					<p>
						<a href="'.QW_WEB.'">
							<img src="style/qlockworks.png" /><br />
							www.qlockworks.de
						</a>
					</p>
					<p>
						Qlockworks Entwickler Team - Fachinformatiker<br />
						im Bereich der Anwendungsentwicklung<br />
					</p>
					<p>
						HTML5, CSS, JavaScript, PHP, MySQL, Python, Perl, Windows 8, Chrome und Android
					</p>
					<table>
						<tr>
							<td>
								<div class="g-plusone" data-size="medium" data-href="http://www.qlockworks.de"></div>
							</td>
							<td>
								<div class="fb-like" data-href="http://www.qlockworks.de" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>
							</td>
						</tr>
					</table>
				</div>
			</header>
			<nav class="Navigation">';
		$s = "";
		$i = 0;
		$a = array(
			"index.php" => "Startseite",
			"project.php" => "Projekte",
			"team.php" => "Das Team",
			"contact.php" => "Kontakt",
			"imprint.php" => "Impressum"
		);
		foreach($a AS $link=>$name){
			if($i == $s AND $i > 0){
				$s = $name;
			}
			echo '<a href="'.QW_WEB.'/'.$link.'" class="Float'.($i == $this->getSelect() ? ' Select' : "").'">'.$name.'</a>';
			$i++;
		}
		echo '
				<div class="Clear"></div>
				<form action="project.php" method="get">
					<input type="text" name="text" />
					<input type="submit" value="suchen" />
				</form>
			</nav>
			<div class="Content">
				<section class="Float Main">';
	}
	
	public function end(){
		$log = QwLog::getInstance();
		echo '
					<br />
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
		}else{
			echo '
					<aside>
						<h1>Anmelden</h1>
						<form action="login.php" method="post">
							<p>
								<b>Benutzer / E-Mail</b><br />
								<input type="text" name="user" /><br />
							</p>
							<p>
								<b>Passwort</b>
								<input type="password" name="pass" /><br />
							</p>
							<p>
								<label><input type="checkbox" name="remind" value="y" /> merken</label>
							</p>
							<input type="submit" value="Anmelden" />
						</form>
					</aside>
					<aside>
						<h1>Probleme?</h1>
						<a href="passwd.php">&raquo; Passwort vergessen</a>
					</aside>';
		}
		echo '
				
				</section>
				<div class="Clear"></div>
			</div>
			<footer class="Footer">
				<div class="Float Social">
					<a href="http://www.facebook.com" target="_blank" class="Float Facebook"></a>
					<a href="http://www.twitter.com/qlockworks" target="_blank" class="Float Twitter"></a>
					<a href="http://www.google.com/qlockworks" target="_blank" class="Float Google"></a>
					<a href="http://www.google.com/qlockworks" target="_blank" class="Float Youtube"></a>
					<a href="'.QW_WEB.'/rss.php" target="_blank" class="Float Rss"></a>
					<div class="Clear"></div>
				</div>
				<ul class="Float">
					<li>&copy; '.date("Y").' <a href="'.QW_WEB.'">Qlockworks</a></li>
					<li><a href="'.QW_WEB.'/team.php">Das Team</a></li>
				</ul>
				<ul class="Float">
					<li><a href="http://www.benjaminhartl.de" target="_blank">Benjamin Hartl</a></li>
					<li><a href="http://www.matthiashartl.de" target="_blank">Matthias Hartl</a></li>
					<li><a href="http://tanja.kreilinger.de" target="_blank">Tanja Kreilinger</a></li>
				</ul>
				<ul class="Float">
					<li><a href="'.QW_WEB.'/project.php">Projekte</a></li>
					<li><a href="'.QW_WEB.'/categories.php">Kategorien</a></li>
				</ul>
				<ul class="Float">
					<li><a href="'.QW_WEB.'/projekte.php?key=hello">Hello World</a></li>
					<li><a href="'.QW_WEB.'/projekte.php?key=qbox">Qbox</a></li>
					<li><a href="'.QW_WEB.'/projekte.php?key=w8-taschenrechner">Taschenrechner</a></li>
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
				<div class="Clear"></div>
			</footer>
		</div>
		<script>
			qw.init();
		</script>
		<script type="text/javascript">
			window.___gcfg = {lang: "de"};
			(function(){
				var po = document.createElement("script"); po.type="text/javascript"; po.async = true;
				po.src = "https://apis.google.com/js/plusone.js";
				var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
			})();
		</script>
	</body>
</html>';
	}
}
?>