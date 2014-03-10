<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="language" content="de" />
<meta name="publisher" content="www.qlockworks.de" />
<meta name="author" content="Qlockworks" />

<title>F0X-Minecraft | Qlockworks</title>
<meta name="description" content="Herzlich Willkommen auf dem Online-Minecraft Server von Qlockworks. Dieser private Server f&uuml;r das Kultspiel Minecraft wird bei 4npserver mit 6 Slots gehostet." />
<meta name="keywords" content="Qlockworks,Minecraft,Maecki.com,Benjamin Hartl,4nplayers,Online-Server,Spiele-Server" />
<meta itemprop="image" content="header.jpg" />
<meta property="og:image" content="header.jpg" />
<link rel="image_src" href="header.jpg" />
<meta name="revisit-afet" content="4 days" />
<meta name="robots" content="all">
<link href="http://www.qlockworks.de/favicon.ico" rel="Shortcut Icon">

<style>

html,body {
	font-size:13px;
	font-family:arial,sans-serif;
	color:white;
}

html,body,iframe,form,table,tr,td,ul,ol,li,h1,h2,h3,p,img {
	margin:0px;
	padding:0px;
	border:0px;
}
hr {
	margin:5px 0px;
	padding:0px;
	border:0px;
	border-top:1px solid #AAA;
}
a {
	color:#CCE;
	text-decoration:none;
	font-weight:bold;
}
h1 {
	margin:10px 0px 5px 0px;
	padding:3px 8px;
	background:url(cobblestone.jpg);
	color:#EEE;
	text-shadow:#111 2px 2px;
}
h2, h3 {
	padding-bottom:5px;
}
p {
	padding:3px 0px;
}
ul, ol {
	padding:2px 0px 2px 20px;
}
ul li, ol li {
	padding:3px 0px;
}
form table, .Box {
	width:100%;
	padding:5px;
	border:1px solid #CCC;
	background-color:rgba(255,255,255,0.2);
	cellspacing:0px;
}
form table tr {
	vertical-align:top;
}
form table tr td {
	padding:5px 0px;
}
form table tr td:first-child:not([colspan]) {
	padding-top:8px;
}
input[type=text],input[type=email],input[type=submit],textarea {
	margin:0px;
	padding:2px 10px;
	background-color:#EEE;
	border:1px solid #AAA;
	border-radius:2px;
	width:90%;
}
textarea {
	height:100px;
}
input[type=submit] {
	width:auto;
	padding:2px 22px;
	cursor:pointer;
}

a[href$="_lo.jpg"] {
	width:181px;
	height:181px;
	display:block;
	margin:10px;
	float:left;
}

a[href$="_lo.jpg"] img {
	width:180px;
	height:180px;
	border-radius:3px;
	border:1px solid #CCC;
}

.Box {
	width:auto;
}

#map {
	position:fixed;
	top:0px;
	left:0px;
	width:100%;
	height:100%;
	z-index:1;
}

.Navigation {
	position:fixed;
	top:250px;
	left:0px;
	width:120px;
	z-index:3;
}
.Navigation a {
	display:block;
	padding:5px 10px;
	border-right:5px solid transparent;
	text-align:right;
}
.Navigation a.Select {
	border-right-color:white;
}
.Mfg {
	position:fixed;
	bottom:50px;
	left:0px;
	width:120px;
	z-index:3;
	text-align:right;
	font-size:11px;
}
.Wrapper {
	position:relative;
	width:620px;
	margin:50px 0px 20px 130px;
	padding:15px;
	background-color:rgba(0,0,0,0.7);
	z-index:2;
}

.Partner {
	width:200px;
	height:200px;
	margin:5px 10px 5px 0px;
	float:left;
	display:block;
}
.Partner:nth-child(3n) {
	margin-right:0px;
}

.Qbox {
	position:fixed;
	top:0px;
	left:0px;
	width:100%;
	background-color:rgba(35,35,65,0.7);
	z-index:4;
}
.Qbox .QboxWindow {
	position:absolute;
	top:50%;
	left:50%;
	width:500px;
	padding:10px;
	background-color:white;
}
.Qbox .QboxWindow #qbox-close {
	position:absolute;
	top:2px;
	right:2px;
	padding:5px 8px;
	background-color:#EEE;
	color:black;
}
.Qbox .QboxWindow #qbox-close:hover {
	color:black;
	background-color:#DDD;
	text-decoration:none;
}
.Qbox .QboxWindow #qbox-image {
	display:block;
	border:0px;
}
.Qbox .QboxWindow #qbox-image-desc {
	position:absolute;
	bottom:10px;
	left:10px;
	padding:10px 30px;
	background-color:rgba(0,0,0,0.4);
	color:white;
}

.Qbox .QboxWindow .QboxNext {
	position:absolute;
	top:10px;
	width:80px;
	text-decoration:none;
	color:#DDD;
}
.Qbox .QboxWindow .QboxNext:hover {
	background-color:rgba(0,0,0,0.1);
	color:white;
}
.Qbox .QboxWindow .QboxNext span {
	position:absolute;
	top:50%;
	left:50%;
	width:34px;
	height:28px;
	margin:-18px 0px 0px -18px;
	background-color:rgba(150,150,150,0.6);
	text-align:center;
	vertical-align:center;
	font-size:24px;
	font-family:arial;
}
.Qbox .QboxWindow #qox-image-pref {
	left:10px;
}
.Qbox .QboxWindow #qbox-image-pref span {
	padding:5px 2px 3px 0px;
}
.Qbox .QboxWindow #qbox-image-next {
	right:10px;
}
.Qbox .QboxWindow #qbox-image-next span {
	padding:5px 0px 3px 2px;
}

.Qbox .QboxWindow #qbox-iframe {
	width:100%;
	border:0px;
	padding:0px;
}
</style>

<script>
var qbox = {
	
	isopen : false,
	val : null,
	eventlistener : true,
	
	init : function(param){
		qbox.val = {
			pref : param.pref || "&lt;",
			next : param.next || "&gt;",
			close : param.close || "X",
			close_tip : param.close_tip || "Zum schlie&szlig;en die ESC-Taste dr&uuml;cken"
		};
		if(qbox.eventlistener){
			if(qbox.eventlistener){
				window.onkeyup = function(e){
					var e = !e ? window.event : e;
					var code = e.charCode ? e.charCode : (e.keyCode ? e.keyCode : (e.which ? e.which : 0));
					switch(code){
						case 27: return qbox.close();
						case 37: return qbox.pref();
						case 39: return qbox.next();
					}
				};
				window.onresize = function(e){
					qbox.resize();
				};
			}
		}
	},
	
	setfade : function(elem,i){
		elem.style.opacity = i/100;
		elem.style.filter = "alpha(opacity="+i+")";
	},
	fade_out : function(elem,step,callback){
		step -= 5;
		qbox.setfade(elem,step);
		if(step > 0){
			window.setTimeout(function(){
				qbox.fade_out(elem,step,callback);
			},1);
		}else if(typeof callback == 'function'){
			callback();
		}
	},
	fade_in : function(elem,step,callback){
		step += 5;
		qbox.setfade(elem,step);
		if(step < 100){
			window.setTimeout(function(){
				qbox.fade_in(elem,step,callback);
			},1);
		}else if(typeof callback == 'function'){
			callback();
		}
	},
	
	open : function(value,key){
		if(!qbox.val){
			qbox.init({});
		}
		var cb = null;
		var imgs = null;
		var ipos = 0;
		if(typeof value == 'string' && value.match(/\.(jpg|jpeg|png|gif)$/i)){
			value = {
				href : value,
				rel : "",
				title : ""
			}
		}
		if(typeof value == 'object'){
			if(key && key == 'ajax'){
				cb = function(link){
					return function(){
						var req = window.XMLHttpRequest ? new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
						req.onreadystatechange = function(){
							if(req.readyState == 4 && req.status == 200){
								var inner = document.getElementById("qbox-inner");
								if(inner){
									inner.innerHTML = req.responseText;
									qbox.resize();
								}
							}
						};
						req.open('GET',link,true);
						req.send(null);
					}
				}(value.href);
				value = "warte...";
				
			}else if(key && key == 'iframe'){
				value = '<iframe src="'+value.href+'" id="qbox-iframe"></iframe>';
				
			}else if(value.href.match(/\.(jpg|jpeg|png|gif)$/i)){
				var title = "";
				var rel = "";
				imgs = new Array();
				if(value.rel && value.rel != ""){
					qbox.img_pref = null;
					qbox.img_next = null;
					var n = 0;
					var m = 0;
					var a = document.getElementsByTagName("a");
					for(var i=0;i<a.length;i++){
						if(a[i].rel == value.rel){
							m++;
							imgs.push(a[i]);
							if(a[i].href == value.href){
								n = m;
								ipos = n-1;
							}else if(qbox.img_next == null){
								if(n > 0){
									qbox.img_next = a[i];
								}else{
									qbox.img_pref = a[i];
								}
							}
						}
					}
					if(qbox.img_pref){
						rel += '<a href="'+qbox.img_pref.href+'" class="QboxNext" id="qbox-image-pref"><span>'+qbox.val.pref+'</span></a>';
					}
					if(qbox.img_next){
						rel += '<a href="'+qbox.img_next.href+'" class="QboxNext" id="qbox-image-next"><span>'+qbox.val.next+'</span></a>';
					}
					title = 'Bild '+n+' von '+m;
				}
				if(value.title != ""){
					if(title != ""){
						title += " | ";
					}
					title += value.title;
				}
				value = '<img src="'+value.href+'" id="qbox-image" style="display:none" /><div id="qbox-image-wait" style="padding:50px 0px;text-align:center;color:black">warte ...</div>'+((title != "") ? '<div id="qbox-image-desc">'+title+'</div>' : "")+rel;
				cb = function(){
					document.getElementById("qbox-image").onload = qbox.imageinit;
				}
			}
		}
		
		var obj = document.getElementById("qbox");
		if(!obj){
			document.body.innerHTML += '<div id="qbox" class="Qbox"></div>';
			obj = document.getElementById("qbox");
		}
		obj.innerHTML = '<div class="QboxWindow" id="qbox-window"><div id="qbox-inner"></div><a href="#" id="qbox-close" title="'+qbox.val.close_tip+'">'+qbox.val.close+'</a></div>';
		var h = window.innerHeight;
		obj.style.height = h+'px';
		obj.style.display = 'block';
		document.body.style.overflow = 'hidden';
		document.body.style.height = h+"px";
		document.getElementById("qbox-inner").innerHTML = value;
		document.getElementById("qbox-close").onclick = function(){
			return qbox.close();
		}
		var img_pref = document.getElementById("qbox-image-pref");
		if(img_pref){
			img_pref.onclick = function(){
				return qbox.pref();
			}
		}
		var img_next = document.getElementById("qbox-image-next");
		if(img_next){
			img_next.onclick = function(){
				return qbox.next();
			}
		}
		if(!qbox.isopen){
			qbox.fade_in(obj,0);
		}else{
			qbox.fade_in(document.getElementById("qbox-inner"),0);
		}
		qbox.resize();
		qbox.isopen = true;
		if(typeof cb == 'function'){
			cb();
		}
		return false;
	},
	resize : function(){
		var h = window.innerHeight;
		var iframe = document.getElementById("qbox-iframe");
		if(iframe){
			iframe.style.height = (h-60)+"px";
		}
		var box = document.getElementById("qbox-window");
		if(box.offsetHeight > h-40){
			box.style.height = (h-40)+"px";
			box.style.overflowY = 'auto';
		}
		box.style.top = (h/2-box.offsetHeight/2)+"px";
		box.style.left = (window.innerWidth/2-box.offsetWidth/2)+"px";
	},
	
	img_pref : null,
	img_next : null,
	
	pref : function(){
		if(qbox.isopen && qbox.img_pref){
			qbox.open(qbox.img_pref);
		}
		return false;
	},
	next : function(){
		if(qbox.isopen && qbox.img_next){
			qbox.open(qbox.img_next);
		}
		return false;
	},
	imageinit : function(){
		document.getElementById("qbox-image-wait").style.display = "none";
		var img = document.getElementById("qbox-image");
		img.style.display = "block";
		var mw = window.innerWidth-60;
		var mh = window.innerHeight-60;
		var iw = img.offsetWidth;
		var ih = img.offsetHeight;
		if(iw > mw){
			ih = mw / iw * ih;
			iw = mw;
			img.width = iw;
		}
		if(ih > mh){
			iw = mh / ih * iw;
			ih = mh;
			img.width = iw;
			img.height = mh;
		}
		var box = document.getElementById("qbox-window");
		box.style.width = iw+"px";
		box.style.height = ih+"px";
		box.style.overflow = 'hidden';
		var desc = document.getElementById("qbox-image-desc");
		if(desc){
			desc.style.width = (iw-60)+"px";
		}
		var pref = document.getElementById("qbox-image-pref");
		if(pref){
			pref.style.height = ih-20+"px";
		}
		var next = document.getElementById("qbox-image-next");
		if(next){
			next.style.height = ih+"px";
		}
		qbox.resize();
	},
	close : function(){
		qbox.isopen = false;
		document.body.style.height = "auto";
		document.body.style.overflow = 'auto';
		var obj = document.getElementById("qbox");
		if(obj){
			qbox.fade_out(obj,100,function(){
				obj.innerHTML = '';
				obj.style.display='none';
			});
		}
		return false;
	}
}


var scroller = {

	sites: {},
	init: function(){
		var a = document.getElementsByTagName("a");
		for(var i=0;i<a.length;i++){
			if(a[i].name != ""){
				scroller.sites[a[i].name] = a[i];
			}else if(a[i].href.match(/#/)){
				var s = a[i].href.split("#");
				a[i].id = "nav-scrollto-"+s[1];
				a[i].onclick = function(k){
					return function(){
						return scroller.scrollto(k);
					}
				}(s[1]);
			}
		}
		window.onscroll = scroller.onscroll;
	},
	onscroll: function(){
		var y = document.body.scrollTop || window.pageYOffset;
		var s = "";
		for(k in scroller.sites){
			var top = scroller.sites[k].offsetTop-100;
			if(s == "" || top <= y){
				s = k;
			}
		}
		if(s != ""){
			var a = document.getElementById("nav").getElementsByTagName("a");
			for(var i=0;i<a.length;i++){
				a[i].className = "";
			}
			document.getElementById("nav-scrollto-"+s).className = "Select";
		}
	},
	scrollto: function(k){
		var top = k == "start" ? 0 : (scroller.sites[k].offsetTop+80);
		window.scrollTo(0,top);
		return false;
	}
}
</script>

</head>
<body>

<iframe src="http://www.minecraft-viewer.de/overviews/195.4.19.226/354710/#/-343/64/930/-6/0/0" id="map"></iframe>
<div class="Navigation" id="nav">
<a href="#start" class="Select">Start</a>
<a href="#server">Server</a>
<a href="#bilder">Bilder</a>
<a href="#regeln">Regeln</a>
<a href="#kontakt">Kontakt</a>
<a href="#links">Links</a>
<a href="#impressum">Impressum</a>
</div>
<div class="Mfg">
Mit freudlichen Gr&uuml;&szlig;en<br />
<a href="http://www.benjaminhartl.de" target="_blank">Benjamin Hartl</a>
</div>
<div class="Wrapper">
<a name="start"></a>
<img src="header.jpg">
<h1>Herzlich Willkommen</h1>
<p>Minecraft, ein vom schwedischen Programmierer Markus Persson alias "Notch" entwickeltes Computerspiel z&auml;hlt zu der Kategorie Open-World-Spiel, in dem man in der Ego-Perspektive
in einer zufallsgenerierten 3D-Landschaften bauen, jagen oder craften kann. Diese Welt besteht fast vollst&auml;ndig aus W&uuml;rfeln, die sich auf unterschiedliche Weise bearbeiten lassen.
So kann man seine Umwelt nach belieben ver&auml;ndern, H&auml;user und ganze D&ouml;rfer bauen und weil das mit mehreren Mitspielern noch mehr Spa&szlig; bietet, bietet Minecraft die M&ouml;glichkeit
im Lokalen Netzwerk oder &uuml;ber das Internet mit mehreren Mitspielern zu spielen. Hier haben wir einen Server auf dem bis zu 6 Spieler gleichzeitig in unserer Welt
online sein k&ouml;nnen.

<a name="server"></a><br /><br /><br />
<h1>Unser Server</h1>

<p>
	<a href="http://www.4players.de" target="_blank"><img src="4players.png" style="float:right;margin:0px 10px" /></a>
	Zur Verf&uuml;gung steht uns ein einfacher Spieleserver, bereitgestellt von 4Player <a href="http://www.4players.de" target="_blank">www.4players.de</a> mit 6 Slots.
</p>
<p>Die Adresse ist:</p>
<br /><br />
<h3 style="text-align:center">f0x.4npserver.de:25565</h3>
<br /><br />
<div class="Box">
	<h3>Achtung!</h3>
	F0X-Minecraft ist ein Privater Server und ist nur f&uuml;r eingetragene Mitglieder auf der Whitelist des Servers zug&auml;nglich. Gerne k&ouml;nnen Sie im folgenden Anfrageformular einen Zugang beantragen.
</div>

<a name="bilder"></a><br /><br /><br />
<h1>Bilder</h1>
<p>Folgend einige Bilder von den Bauwerken und Landschaften auf unserem Server:</p>
<hr />
<?php
$dir = openDir("images");
while($file = readDir($dir)){
	if(preg_match("/_pr\.jpg/",$file)){
		echo '<a href="images/'.str_replace("_pr","_lo",$file).'" rel="gallery" onclick="return qbox.open(this)"><img src="images/'.$file.'" /></a>';
	}
}
closeDir($dir);
?>
<div style="clear:both"></div>
<hr />


<a name="regeln"></a><br /><br /><br />
<h1>Regeln</h1>
<p>Um Konflikte mit anderen Spielern zu vermeiden und eine harmonievolle Spielungebung zu gew&auml;hren ist es notwendig, folgende Regeln zu beachten:</p>
<ol>
	<li>Jegliche Provokationen, Beleidigungen und rassistische &Auml;u&szlig;erungen sind nicht erw&uuml;nscht.</li>
	<li>Anweisungen des Teams (Moderatoren, Admins, B&uuml;rgermeister) ist folge zu leisten.</li>
	<li>Das Einsperren, Einmauern oder &Auml;hnliches ist verboten.</li>
	<li>Das Griefen ist bei uns g&auml;nzlich unerw&uuml;nscht.</li>
	<li>Die Tiere von anderen Mitspielern d&uuml;rfen ohne Erlaubnis des Besitzers weder geschoren, gemolken noch get&ouml;tet werden.</li>
	<li>Skins mit Rechtsextremistischen oder Pornografischen aussehen sind verboten und sind nach Aufforderung durch ein Teammitglied zu wechseln.</li>
	<li>H&ouml;here Teammitglieder haben das Recht, euch auch ohne besonderen Grund aus dem Spielgeschehen auszuschlie&szlig;en.</li>
	<li>Es ist verboten, Bauwerke von anderen Mitspielern ohne deren ausdr&uuml;ckliche einwilligung zu ver&auml;ndern oder gar zu zerst&ouml;ren.</li>
	<li>Es ist verboten Fallen f&uuml;r andere Mitspieler zu stellen. Mobfallen sind erlaubt, solange sie ersichtlich sind oder durch einen Hinweis davor gewarnt wird.</li>
	<li>Das Bauen von Rechtsradikalen Zeichen ist bei uns strengstens verboten.</li>
	<li>Lebensgef&auml;hrliche Bauten m&uuml;ssen ausreichend abgesichert sein. Dazu z&auml;hlen auch L&ouml;cher im Boden.</li>
	<li><strong>Seid nett zueinander</strong><br />
		Bitte, Danke, Geduld mit Neulingen. Vorw&uuml;rfe und Beleidigungen haben hier gar nichts zu suchen.
		&Auml;rgert euch mal etwas, geht leicht dar&uuml;ber hinweg, denn meist ist es nur ein Missverst&auml;ndnis.
	</li>
</ol>
<p>Bei einem Versto&szlig; werden je nach schwere der Tat Mahnungen vergeilt und bei Wiederholung der Spieler von der Whitelist des Servers verbannt.</p>
<p>In besonders schwerwiegenden F&auml;llen k&ouml;nnen auch strafrechtliche Schritte eingeleitet werden.</p> 

<a name="kontakt"></a><br /><br /><br />
<h1>Kontaktanfrage</h1>
<p>Bitte f&uuml;llen Sie alle Felder des folgenden Formulars vollst&auml;ndig aus, um Ihre Kontaktanfrage zu versenden.</p>
<br />
<div class="Box">
<iframe src="http://www.maecki.com/mailform.php?mail-info=Minecraft&color=white" style="width:100%;height:480px"></iframe>
</div>


<a name="links"></a><br /><br /><br />
<h1>Links &amp; Partnerseiten</h1>
<a href="http://gameserver.4players.de" target="_blank" class="Partner"><img src="partner/4players.jpg" /></a>
<a href="http://www.minecraft.net" target="_blank" class="Partner"><img src="partner/minecraft.jpg" /></a>
<a href="http://minecraft-de.gamepedia.com" target="_blank" class="Partner"><img src="partner/minecraft-wiki.jpg" /></a>
<a href="http://www.qlockworks.de" target="_blank" class="Partner"><img src="partner/qlockworks.jpg" /></a>
<a href="http://www.benjaminhartl.de" target="_blank" class="Partner"><img src="partner/benjaminhartl.jpg" /></a>
<div style="clear:both"></div>


<a name="impressum"></a><br /><br /><br />
<h1>Impressum</h1>

<p>&nbsp;</p>
<h3>Anbieter</h3>
<p>Benjamin Hartl<br> Am Schulberg 10<br />E-Mail: <a data-mail="info" data-host="qlockworks.de"></a></p>
<p>&nbsp;</p>
<h3>Verantwortlich nach &sect; 6 Abs.2 MDStV</h3>
<p><a href="http://www.benjaminhartl.de/" target="_blank">Benjamin Hartl</a><br>am Schulberg 10<br> 94163 Saldenburg</p>
<p>&nbsp;</p>
<h3>Haftungsausschluss</h3>
<p><strong>Haftung f&uuml;r Inhalte</strong><br />
Die Inhalte unserer Seiten wurden mit gr&ouml;&szlig;ter Sorgfalt erstellt. F&uuml;r die Richtigkeit, Vollst&auml;ndigkeit und Aktualit&auml;t der Inhalte k&ouml;nnen wir jedoch keine Gew&auml;hr &uuml;bernehmen.<br />
Als Dienstanbieter sind wir gem&auml;&szlig; &sect; 7 Abs.1 TMG f&uuml;r eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach &sect;&sect; 8 bis 10 TMG sind wir als Dienstanbieter jedoch nicht verpflichtet, &uuml;bermittelte oder gespeicherte fremde Informationen zu &uuml;berwachen oder nach Umst&auml;nden zu forschen, die auf eine rechtswidrige T&auml;tigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unber&uuml;hrt. Eine diesbez&uuml;gliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung m&ouml;glich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.
</p>
<p><strong>Haftung f&uuml;r Links</strong><br />
Unser Angebot enth&auml;lt Links zu externen Webseiten Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb k&ouml;nnen wir f&uuml;r diese fremden Inhalte auch keine Gew&auml;hr &uuml;bernehmen.<br />
F&uuml;r die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf m&ouml;gliche Rechtsverst&ouml;&szlig;e &uuml;berpr&uuml;ft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Links umgehend entfernen.
</p>
<p><strong>Urheberrecht</strong><br />
Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht.<br />
Die Vervielf&auml;ltigung, Bearbeitung, Verbreitung und jede Art der Verwertung au&szlig;erhalb der Grenzen des Urheberrechtes bed&uuml;rfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur f&uuml;r den privaten, nicht kommerziellen Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.
</p>
<p><strong>Datenschutz</strong><br />
Die Nutzung unserer Webseite ist in der Regel ohne Angabe personenbezogener Daten m&ouml;glich. Soweit auf unseren Seiten personenbezogene Daten (beispielsweise Name, Anschrift oder E-Mail-Adressen) erhoben werden, erfolgt dies, soweit m&ouml;glich, stets auf freiwilliger Basis. Diese Daten werden ohne Ihre ausdr&uuml;ckliche Zustimmung nicht an Dritte weitergegeben.<br />
Wir weisen darauf hin, dass die Daten&uuml;bertragung im Internet (z.B. bei der Kommunikation per E-Mail) Sicherheitsl&uuml;cken aufweisen kann. Ein l&uuml;ckenloser Schutz der Daten vor dem Zugriff durch Dritte ist nicht m&ouml;glich.<br />
Der Nutzung von im Rahmen der Impressumspflicht ver&ouml;ffentlichten Kontaktdaten durch Dritte zur &Uuml;bersendung von nicht ausdr&uuml;cklich angeforderter Werbung und Informationsmaterialien wird hiermit ausdr&uuml;cklich widersprochen. Die Betreiber der Seiten behalten sich ausdr&uuml;cklich rechtliche Schritte im Falle der unverlangten Zusendung von Werbeinformationen, etwa durch Spam-Mails, vor.
</p>

</div>
<div id="qbox" class="Qbox" style="display:none"></div>

<script>
scroller.init();

var a = document.getElementsByTagName("a");
for(var i=0;i<a.length;i++){
	if(a[i].getAttribute("data-mail")){
		var mail = a[i].getAttribute("data-mail")+"@"+a[i].getAttribute("data-host");
		a[i].href = "mailto:"+mail;
		a[i].innerHTML = mail;
		a[i].removeAttribute("data-mail");
		a[i].removeAttribute("data-host");
	}
}
</script>
</body>
</html>