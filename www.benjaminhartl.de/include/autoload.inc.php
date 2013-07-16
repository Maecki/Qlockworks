<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-04-13
 */

global $classpaths;

$classpaths = array(
	
	// logic
	// logic blogger
	"BloggerEntry" => PATH_ROOT."/logic/blogger/BloggerEntry.class.php",
	"BloggerReader" => PATH_ROOT."/logic/blogger/BloggerReader.class.php",
	
	// logic comments
	"Comments" => PATH_ROOT."/logic/comments/Comments.class.php",
	
	// logic file
	"FileManager" => PATH_ROOT."/logic/file/FileManager.class.php",
	"XmlManager" => PATH_ROOT."/logic/file/XmlManager.class.php",
	
	// logic gallery
	"Gallery" => PATH_ROOT."/logic/gallery/Gallery.class.php",
	"GalleryImage" => PATH_ROOT."/logic/gallery/GalleryImage.class.php",
	"GalleryManager" => PATH_ROOT."/logic/gallery/GalleryManager.class.php",
	
	// logic site
	"Cache" => PATH_ROOT."/logic/site/Cache.class.php",
	"TplManager" => PATH_ROOT."/logic/site/TplManager.class.php",
	"Utils" => PATH_ROOT."/logic/site/Utils.class.php",
	
	// logic twitter
	"TwitterReader" => PATH_ROOT."/logic/twitter/TwitterReader.class.php",
	"TwitterState" => PATH_ROOT."/logic/twitter/TwitterState.class.php",
	
	// logic user
	"User" => PATH_ROOT."/logic/user/User.class.php",
	
	// logic youtube
	"YoutubeReader" => PATH_ROOT."/logic/youtube/YoutubeReader.class.php",
	"YoutubeVideo" => PATH_ROOT."/logic/youtube/YoutubeVideo.class.php",
	
	// view
	// view components
	"Content" => PATH_ROOT."/view/components/Content.class.php",
	"Formular" => PATH_ROOT."/view/components/Formular.class.php",
	"MailContact" => PATH_ROOT."/view/components/MailContact.class.php",
	"NavigationElement" => PATH_ROOT."/view/components/NavigationElement.class.php",
	"Table" => PATH_ROOT."/view/components/Table.class.php",
	"TableRow" => PATH_ROOT."/view/components/TableRow.class.php",
	
	// view elements
	"HtmlCheckbox" => PATH_ROOT."/view/elements/HtmlCheckbox.class.php",
	"HtmlClosedElement" => PATH_ROOT."/view/elements/HtmlClosedElement.class.php",
	"HtmlDate" => PATH_ROOT."/view/elements/HtmlDate.class.php",
	"HtmlEditor" => PATH_ROOT."/view/elements/HtmlEditor.class.php",
	"HtmlElement" => PATH_ROOT."/view/elements/HtmlElement.class.php",
	"HtmlInput" => PATH_ROOT."/view/elements/HtmlInput.class.php",
	"HtmlLink" => PATH_ROOT."/view/elements/HtmlLink.class.php",
	"HtmlSelect" => PATH_ROOT."/view/elements/HtmlSelect.class.php",
	"HtmlTextarea" => PATH_ROOT."/view/elements/HtmlTextarea.class.php",
	
	// view skeleton
	"Ajax" => PATH_ROOT."/view/skeleton/Ajax.class.php",
	"Footer" => PATH_ROOT."/view/skeleton/Footer.class.php",
	"Header" => PATH_ROOT."/view/skeleton/Header.class.php",
	"HtmlHead" => PATH_ROOT."/view/skeleton/HtmlHead.class.php",
	"Navigation" => PATH_ROOT."/view/skeleton/Navigation.class.php",
	"Sidebar" => PATH_ROOT."/view/skeleton/Sidebar.class.php",
	"Skeleton" => PATH_ROOT."/view/skeleton/Skeleton.class.php",
	"SkeletonSection" => PATH_ROOT."/view/skeleton/SkeletonSection.class.php",
	"Toolbar" => PATH_ROOT."/view/skeleton/Toolbar.class.php",
);


/**
 * Loads the required file where the class is defined
 * @param $class name of the class
 */
function __autoload($class){
	global $classpaths;
	if(isset($classpaths[$class])){
		if(file_exists($classpaths[$class])){
			require_once($classpaths[$class]);
		}else{
			//die('Fehler beim Laden der Klasse "'.$class.'"! Die Datei "'.$classpaths[$class].'" wurde nicht gefunden.');
		}
	}else{
		//die('Fehler beim Laden der Klasse "'.$class.'"! Klasse nicht gefunden.');
	}
}
?>