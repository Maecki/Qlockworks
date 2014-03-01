/**
 * Copyright 2013 @ Qlockworks
 * 
 * Author : Benjamin Hartl
 * Date : 2013-02-27
 */

var qw = {
	
	init : function(){
		
		var a = document.getElementsByTagName("a");
		for(var i=0;i<a.length;i++){
			if(a[i].getAttribute("data-mail")){
				a[i].innerHTML = a[i].getAttribute("data-mail")+"@"+a[i].getAttribute("data-host");
				a[i].href = "mailto:"+a[i].innerHTML;
			}
		}
	},
	
	share : function(url){
		var wnd = window.open(url, "qlockworks-share", "width=500,height=350,left=100,top=200");
		wnd.focus();
		return false;
	}
}