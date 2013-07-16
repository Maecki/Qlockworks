<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-07
 */
class Header extends SkeletonSection {
	
	public function __toString(){
		$str = "";
		
		$str .= '<img src="'.PATH_WEB.'/data/graphics/header/header_sw.jpg" id="header_sw" /><img src="'.PATH_WEB.'/data/graphics/header/header_co.jpg" id="header_co" />';
		
		return $str;
	}
}
?>