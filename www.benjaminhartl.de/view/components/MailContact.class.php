<?php
/**
 * Copyright 2012 @ Maecki.com
 * 
 * Author : Benjamin Hartl
 * Date : 2012-09-02
 */
class MailContact {
	
	protected $user=null;
	
	public function __construct(User $user){
		$this->setUser($user);
	}
	
	public function __toString(){
		$form = new Formular(PATH_WEB."/ajax/mail.php");
		$form->setAttribute("target","mf");
		$form->setAttribute("onSubmit","return sendMail('mail-info','mf')");
		$form->getSubmit()->setValue("Senden");
		$form->setDescriptionWidth(300);
		
		$form->addRow("Vor- / Nachname*",new HtmlInput("name"));
		
		$form->addRow("E-Mail",new HtmlInput("mail"));
		
		$form->addRow("Text*",new HtmlTextarea("text"));
		
		$form->getTable()->addRow(array("",'<p class="Small">Mit * gekennzeichnete Felder sind Pflichtfelder!</p>'));
		return '<iframe name="mf" id="mf" style="display:none;"></iframe><br /><h1>Kontakt</h1><br /><br /><div id="mail-contact"><div id="mail-info"></div>'.$form.'</div>';
	}
	
	public function getUser(){
		return $this->user;
	}
	public function setUser(User $user){
		$this->user = $user;
	}
}
?>