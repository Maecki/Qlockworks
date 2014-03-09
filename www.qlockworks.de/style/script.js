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
		
		var a = document.getElementsByTagName("pre");
		for(var i=0;i<a.length;i++){
			if(!a[i].getAttribute("data-code")){
				var rows = a[i].innerHTML.split("<br>");
				a[i].innerHTML = "";
				for(var j=0;j<rows.length;j++){
					a[i].innerHTML += '<span class="Num">'+(j+1)+'</span>'+rows[j]+"<br>";
				}
				a[i].setAttribute("data-code","true");
			}
		}
	},
	
	share : function(url){
		var wnd = window.open(url, "qlockworks-share", "width=500,height=350,left=100,top=200");
		wnd.focus();
		return false;
	}
}