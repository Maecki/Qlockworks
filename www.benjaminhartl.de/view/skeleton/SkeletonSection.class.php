<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-08-07
 */
class SkeletonSection {
	
	protected $skeleton,$user;
	
	public function __construct(Skeleton $skeleton,User $user){
		$this->setSkeleton($skeleton);
		$this->setUser($user);
	}
	
	public function getSkeleton(){
		return $this->skeleton;
	}
	public function setSkeleton(Skeleton $skeleton){
		$this->skeleton = $skeleton;
	}
	
	public function getUser(){
		return $this->user;
	}
	public function setUser(User $user){
		$this->user = $user;
	}
}
?>