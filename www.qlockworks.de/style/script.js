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
	}
}