<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-07
 */
class Navigation extends SkeletonSection {
	
	protected $sSelect="";
	
	public function __construct(Skeleton $skeleton,User $user){
		parent::__construct($skeleton,$user);
		$a = $this->getUser()->getNavigationElements();
		foreach($a AS $item){
			$this->setSelect($item->getKey());
			break;
		}
	}
	
	public function __toString(){
		$str = '<ul id="navigation">';
		$a = $this->getUser()->getNavigationElements();
		foreach($a AS $item){
			if($item->isPublic() OR $this->getUser()->isLoggedIn()){
				$edit = "";
				if($this->getUser()->isLoggedIn()){
					$e = new HtmlLink('<img src="'.PATH_DESIGN.'/graphics/icons/edit.png" width=12 />');
					$e->setAttribute("onClick","return siteEdit(this.parentNode.parentNode)");
					$x = new HtmlLink('<img src="'.PATH_DESIGN.'/graphics/icons/cancel.png" width=12 />');
					$x->setAttribute("onClick","return siteDel(this.parentNode.parentNode)");
					$edit = '<div class="Edit">'.$e.' '.$x.'</div>';
				}
				$str .= '<li class="NavigationElement'.($item->getKey() == $this->getSelect() ? ' Select' : '').'" data-key="'.$item->getKey().'">'.$item->getLink().$edit.'</li>';
			}
		}
		if($this->getUser()->isLoggedIn()){
			$e = new HtmlLink('Neue Seite');
			$e->setAttribute("onClick","return siteEdit(this.parentNode)");
			$str .= '<li>'.$e.'</li>';
		}
		$str .= '</ul>';
		return $str;
	}
	
	public function getSelectedItem(){
		return $this->getUser()->getNavigationElement($this->getSelect());
	}
	
	public function getSelect(){
		return $this->sSelect;
	}
	public function setSelect($key){
		$this->sSelect = $key;
	}
}
?>