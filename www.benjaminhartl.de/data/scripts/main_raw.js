var ROOT = "";
var TITLE = "";

function init(data){
	
	ROOT = data.root;
	TITLE = data.title;
	
	$(".Page").hover(function(){
		$("img#header_co").fadeIn(5000);
	});
	
	initPlugins();
}


function show(obj){
	document.title = obj.innerHTML.replace("&amp;","&")+" | "+TITLE;
	var a = document.getElementsByTagName("li");
	for(i=0;i<a.length;i++){
		if(a[i].getAttribute("data-key")){
			a[i].className = a[i].getAttribute("data-key") == obj.getAttribute("data-key") ? "Select" : "";
		}
	}
	var nav = document.getElementById("nav");
	if(nav){
		document.getElementById("nav").style.backgroundImage = 'url('+ROOT+'/data/graphics/css/guitar_'+rand(1,nav.getAttribute("data-max"))+'.png)';
	}
	var c = document.getElementById("content");
	$(c).hide("drop",function(c){
		return function(){
			ajaxPost("page","get","key="+obj.getAttribute("data-key"),function(obj){
				return function(){
					if(this.readyState == 4 && this.status == 200){
						obj.innerHTML = this.responseText;
						initPlugins();
						$(obj).show("drop");
					}
				}
			}(c));
		}
	}(c));
	return false;
}

function gallery(obj){
	document.title = obj.getAttribute("data-name")+" | "+TITLE;
	var c = document.getElementById("content");
	$(c).hide("drop",function(c){
		return function(){
			ajaxPost("page","gallery","id="+obj.getAttribute("data-id"),function(obj){
				return function(){
					if(this.readyState == 4 && this.status == 200){
						obj.innerHTML = this.responseText;
						initPlugins();
						$(obj).show("drop");
					}
				}
			}(c));
		}
	}(c));
	return false;
}


function initPlugins(){
	initCorner();
	initMail();
	
	$("a[rel=imgbox] img, a[rel=vidbox] img").corner("5px");
	
	$("a[rel=imgbox]").fancybox({
		openEffect  : 'elastic',
		closeEffect : 'elastic',
		prevEffect : 'elastic',
		nextEffect : 'elastic',
		helpers : {
			title : {
				type : 'inside'
			},
			buttons	: {}
		},
		afterLoad : function() {
			this.title = 'Bild '+(this.index + 1) + ' von ' + this.group.length + (this.title ? ' - ' + this.title : '');
		}
	});
	
	$("a[rel=vidbox]").fancybox({
		openEffect  : 'elastic',
		closeEffect : 'elastic',
		helpers : {
			title : {
				type : 'inside'
			},
			media : {}
		},
	});
}

function initCorner(){
	$(".Corner").corner("5px");
	$(".Corner-Bottom").corner("bottom 5px");
	
	$("h1").corner("5px");
	
	$("input[type=text],input[type=password],textarea,select").corner("3px");
	$("input[type=submit]").corner("10px");
}

function initMail(){
	var a = document.getElementsByTagName("a");
	for(i=0;i<a.length;i++){
		if(a[i].getAttribute("data-mail")){
			var mail = a[i].getAttribute("data-mail")+"@"+a[i].getAttribute("data-host");
			a[i].href = "mailto:"+mail;
			a[i].innerHTML = mail;
		}
	}
}

function thread(callback){
	window.setTimeout(callback,1);
}
function rand(to,from){
	return Math.floor(Math.random()*(to-from+1)+from)*-1;
}

function imgdel(id){
	if(confirm("Wirklich l�schen?")){
		ajaxPost('gallery','imgdel','id='+id,'content');
	}
	return false;
}
function galdel(id){
	if(confirm("Wirklich l�schen?")){
		ajaxPost('gallery','galdel','id='+id,'content');
	}
	return false;
}

function ajaxWait(id){
	thread(function(){
		return function(){
			var obj = document.getElementById(id);
			if(obj){
				obj.innerHTML = '<center><img src="'+ROOT+'/data/graphics/css/process.gif" /></center>';
			}
		}
	}(id));
}

function ajaxPost(file,act,postData,callback){
	var req;
	try{
		req = window.XMLHttpRequest ? new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP"); 
	}catch(e){
		// browser does not have ajax support
	}
	req.onreadystatechange = typeof callback == 'function' ? callback : function(){
		if(req.readyState == 4 && req.status == 200){
			if(typeof callback == 'string'){
				callback = document.getElementById(callback);
			}
			if(callback){
				callback.innerHTML = req.responseText;
			}
			initPlugins();
		}
	};
	req.open('POST',ROOT+'/ajax/'+file+'.php?act='+act,true);
	req.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	req.send(postData);

	return false;
}

function iframeResp(id){
	ajaxWait(id);
	iframePost('content');
}
function iframePost(callback,iframe){
	if(!iframe){
		iframe = document.getElementById('iframe');
	}
	iframePostWait(iframe,"",callback)
	return true;
}

function iframePostWait(iframe,tmp,callback){
	html = iframe.contentWindow.document.body.innerHTML;
	if(tmp != html){
		iframe.contentWindow.document.body.innerHTML = '';
		if(typeof callback == 'function'){
			callback(html);
		}else{
			if(typeof callback == 'string'){
				callback = document.getElementById(callback);
			}
			if(callback){
				callback.innerHTML = html;
			}
			initPlugins();
		}
	}else{
		window.setTimeout(function(iframe,tmp,callback){
			return function(){
				iframePostWait(iframe,tmp,callback);
			}
		}(iframe,tmp,callback),1000);
	}
}


function sendMail(id,iframe){
	ajaxWait(id);
	iframePost(function(id){
		return function(html){
			if(html == "ok"){
				ajaxPost('mail','ok','','content');
			}else{
				document.getElementById(id).innerHTML = html;
			}
		}
	}(id),document.getElementById(iframe));
	return true;
}