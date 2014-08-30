<!DOCTYPE html>
<html>
<head>

<title>Bavarian Wheels</title>
<link rel="stylesheet" type="text/css" href="style/content.css" />

<script type="text/javascript" src="http://img.bwhosting.eu/scripts/jquery.js"></script>

<script>
function event_background(){
	var bg = document.getElementById("background");
	bg.style.display = 'block';
	bg.removeAttribute("width");
	bg.removeAttribute("height");
	bg.height = $(window).innerHeight();
	var w = $(window).innerWidth();
	if(bg.offsetWidth < w){
		bg.removeAttribute("height");
		bg.width = w;
	}
	bg.style.margin = '-'+(bg.height/2)+'px 0px 0px -'+(bg.width/2)+'px';
	if(typeof window.onresize != 'function'){
		window.onresize = event_background;
	}
}
</script>

</head>
<body>

<img src="style/background.jpg" id="background" onload="event_background()" style="display:none" />


<div class="Wrapper">

<div class="Header">
	<a href="#" class="Logo">Bavarian Wheels</a>
</div>

<div class="Navigation">
	<a href="">Startseite</a>
	<a href="">&Uuml;ber uns</a>
	<a href="">Kontakt</a>
	<div class="Clear"></div>
	
	<form action="#">
		<input type="search" placeholder="Suche in Beitr&auml;gen" />
		<input type="submit" value="suchen" />
	</form>
</div>

<div class="Content">
<h1>Aktuelle Eintr&auml;ge</h1>

<div class="Pagenav">
	<b>1</b>
	<a href="#">2</a>
	<a href="#">3</a>
	<a href="#">4</a>
	<a href="#">5</a>
	<a href="#">6</a>
	<div class="Clear"></div>
</div>
<?php
foreach(array(
	array('Sa. 30.08.2014','<div style="text-align:center"><img src="style/foto_1_Gruppe.jpg" width=500 /></div>Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.'),
	array('Mo. 25.08.2014','<img src="style/foto_2_Anton1.jpg" style="float:left;margin:0px 10px 5px 0px" width=300 />Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.<br />Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.'),
	array('Sa. 23.08.2014','<img src="style/foto_3_Anton2.jpg" style="float:left;margin:0px 10px 5px 0px" width=300 />Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.'),
	array('Fr. 15.08.2014','<img src="style/foto_4_Matthias.jpg" style="float:right;margin:0px 0px 5px 10px" width=300 />Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis.<br />At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat. '),
	array('Do. 07.08.2014','<img src="style/foto_5_KFC.jpg" style="float:left;margin:0px 10px 5px 0px" width=170 />Consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.'),
	array('Fr. 01.08.2014','<img src="style/foto_6_Skifahren.jpg" style="float:right;margin:0px 0px 5px 10px" width=300 />Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.'),
	array('Mi. 30.07.2014','<div style="text-align:center"><img src="style/foto_7_Oxxenkracherl.jpg" width=500 /></div>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.'),
	array('Di. 22.07.2014','<img src="style/foto_8_Happymeal.jpg" style="float:left;margin:0px 10px 5px 0px" width=300 />Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.'),
	array('Di. 15.07.2014','<img src="style/foto_9_Matthias2.jpg" style="float:left;margin:0px 10px 5px 0px" width=300 />At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.')
) AS $a){
	echo '
	<div class="Entry">
		<div class="EntryHeadline">'.$a[0].' | 103 Klicks</div>
		<div class="EntryContent">'.$a[1].'<div class="Clear"></div></div>
		<div class="EntryFooter">teilen auf <img src="style/facebook_icon_12x12.png" style="margin:0px 0px -1px 5px" /></div>
	</div>';
}
?>
<div class="Pagenav">
	<b>1</b>
	<a href="#">2</a>
	<a href="#">3</a>
	<a href="#">4</a>
	<a href="#">5</a>
	<a href="#">6</a>
	<div class="Clear"></div>
</div>
</div>

<div class="Sidebar">
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
	
	<br /><br />
	
	<h1>Neuste Kommentare</h1>
	<ul>
		<li><small>vor wenigen Sekunden</small><br />Echt voll Krass - macht weiter so!<br /><a href="#">&raquo; zum Beitrag am Sa. 30.08.2014</a></li>
		<li><small>vor wenigen Sekunden</small><br />Hier k&ouml;nnte Ihre Werbung stehn ...<br /><a href="#">&raquo; zum Beitrag am Sa. 30.08.2014</a></li>
		<li><small>vor wenigen Sekunden</small><br />Ente Ente Ente Ente Ente Ente<br /><a href="#">&raquo; zum Beitrag am Sa. 30.08.2014</a></li>
	</ul>
	
	<br /><br />
	
	<h1>Aktuelle Bilder</h1>
	<div class="SidebarImages">
		<img src="style/thumb_1.jpg" />
		<img src="style/thumb_2.jpg" />
		<img src="style/thumb_3.jpg" />
		<img src="style/thumb_4.jpg" />
		<img src="style/thumb_5.jpg" />
		<img src="style/thumb_6.jpg" />
		<img src="style/thumb_7.jpg" />
		<img src="style/thumb_8.jpg" />
		<img src="style/thumb_9.jpg" />
	</div>
	
	<br /><br />
	
	<h1>Tag-Cloud</h1>
	<div class="Tagcloud">
<?php
foreach(array(
	"Anton" => 18,
	"BMX" => 20,
	"Elias" => 16,
	"Hannes" => 16,
	"KFC" => 8,
	"Korbinian" => 14,
	"McDonalds" => 8,
	"Oxxenkracherl" => 8,
	"&Ouml;sterreich" => 10,
	"Passau" => 12,
	"Sch&auml;rding" => 14,
	"Skateboard" => 10,
	"Tittling" => 12,
	"Tschosee" => 14,
	"Thurner" => 10,
	"Urlaub" => 8
) AS $v=>$size){
	echo '<a href="#" style="font-size:'.$size.'px">'.$v.'</a> ';
}
?>
	</div>
</div>

<div class="Clear"></div>

<div class="Footer">
	<div class="FooterCol">
		<h6>&copy; 2014 @ Bavarian Wheels</h6>
		<ul>
			<li><a href="#">Links &amp; Partnerseiten</a></li>
			<li><a href="#">Kontakt</a></li>
			<li><a href="#">Impressum</a></li>
		</ul>
	</div>
	<div class="FooterCol">
		<h6>Archiv</h6>
		<ul>
			<li><a href="#">2014</a></li>
			<li><a href="#">2013</a></li>
		</ul>
	</div>
	<div class="Clear"></div>
	<a href="#" class="Top">nach oben</a>
</div>

</div>
</body>
</html>