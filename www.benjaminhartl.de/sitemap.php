<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-27
 */

include("include/core.inc.php");

header("Content-Type: application/xml; charset=UTF-8");

echo '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.sitemaps.org/schemas/sitemap-image/1.1">';

$a = $_SESSION["user"]->getNavigationElements();
foreach($a AS $e){
	echo '
	<url><loc>'.PATH_WEB.'/index.php?key='.$e->getKey().'</loc></url>';
	if($e->getKey() == "images"){
		$im = new GalleryManager($_SESSION["user"]);
		$a = $im->getGalleries();
		foreach($a AS $g){
			echo '
			<url><loc>'.PATH_WEB.'/gallery.php?id='.$g->getId().'</loc>';
			$b = $g->getImages();
			foreach($b AS $img){
				echo '
				<image:image><image:loc>'.$img->getFile("lo").'</image:loc><image:title><![CDATA['.$img->getName().']]></image:title></image:image>';
			}
			echo '
			</url>';
		}
	}
}
echo '
</urlset>';
?>