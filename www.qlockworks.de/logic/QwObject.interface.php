<?php
/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-24
 */
interface QwObject {
	
	public function setDataFromId($id);
	
	public function setDataFromObject($obj);
	
	public function safe();
	
	public function delete();
}
?>