var qbox = {
	
	isopen : false,
	val : null,
	eventlistener : true,
	
	init : function(param){
		qbox.val = {
			pref : param.pref || "&lt;",
			next : param.next || "&gt;",
			close : param.close || "X",
			close_tip : param.close_tip || "Zum schlie&szlig;en die ESC-Taste dr&uuml;cken"
		};
		if(param.eventlistener){
			qbox.eventlistener = param.eventlistener;
		}
	},
	
	setfade : function(elem,i){
		elem.style.opacity = i/100;
		elem.style.filter = "alpha(opacity="+i+")";
	},
	fade_out : function(elem,step,callback){
		step -= 5;
		qbox.setfade(elem,step);
		if(step > 0){
			window.setTimeout(function(){
				qbox.fade_out(elem,step,callback);
			},1);
		}else if(typeof callback == 'function'){
			callback();
		}
	},
	fade_in : function(elem,step,callback){
		step += 5;
		qbox.setfade(elem,step);
		if(step < 100){
			window.setTimeout(function(){
				qbox.fade_in(elem,step,callback);
			},1);
		}else if(typeof callback == 'function'){
			callback();
		}
	},
	
	open : function(value,key){
		if(!qbox.val){
			qbox.init({});
		}
		var cb = null;
		var imgs = null;
		var ipos = 0;
		if(typeof value == 'string' && value.match(/\.(jpg|jpeg|png|gif)$/i)){
			value = {
				href : value,
				rel : "",
				title : ""
			}
		}
		if(typeof value == 'object'){
			if(key && key == 'ajax'){
				cb = function(link){
					return function(){
						var req = window.XMLHttpRequest ? new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");
						req.onreadystatechange = function(){
							if(req.readyState == 4 && req.status == 200){
								var inner = document.getElementById("qbox-inner");
								if(inner){
									inner.innerHTML = req.responseText;
									qbox.resize();
								}
							}
						};
						req.open('GET',link,true);
						req.send(null);
					}
				}(value.href);
				value = "warte...";
				
			}else if(key && key == 'iframe'){
				value = '<iframe src="'+value.href+'" id="qbox-iframe"></iframe>';
				
			}else if(value.href.match(/\.(jpg|jpeg|png|gif)$/i)){
				var title = "";
				var rel = "";
				imgs = new Array();
				if(value.rel && value.rel != ""){
					qbox.img_pref = null;
					qbox.img_next = null;
					var n = 0;
					var m = 0;
					var a = document.getElementsByTagName("a");
					for(var i=0;i<a.length;i++){
						if(a[i].rel == value.rel){
							m++;
							imgs.push(a[i]);
							if(a[i].href == value.href){
								n = m;
								ipos = n-1;
							}else if(qbox.img_next == null){
								if(n > 0){
									qbox.img_next = a[i];
								}else{
									qbox.img_pref = a[i];
								}
							}
						}
					}
					if(qbox.img_pref){
						rel += '<a href="'+qbox.img_pref.href+'" class="QboxNext" id="qbox-image-pref"><span>'+qbox.val.pref+'</span></a>';
					}
					if(qbox.img_next){
						rel += '<a href="'+qbox.img_next.href+'" class="QboxNext" id="qbox-image-next"><span>'+qbox.val.next+'</span></a>';
					}
					title = 'Bild '+n+' von '+m;
				}
				if(value.title != ""){
					if(title != ""){
						title += " | ";
					}
					title += value.title;
				}
				value = '<img src="'+value.href+'" id="qbox-image" />'+((title != "") ? '<div id="qbox-image-desc">'+title+'</div>' : "")+rel;
				cb = function(){
					document.getElementById("qbox-image").onload = qbox.imageinit;
				}
			}
		}
		
		var obj = document.getElementById("qbox");
		if(!obj){
			document.body.innerHTML += '<div id="qbox" class="Qbox"></div>';
			obj = document.getElementById("qbox");
			if(qbox.eventlistener){
				window.onkeyup = function(e){
					var e = !e ? window.event : e;
					var code = e.charCode ? e.charCode : (e.keyCode ? e.keyCode : (e.which ? e.which : 0));
					switch(code){
						case 27: return qbox.close();
						case 37: return qbox.pref();
						case 39: return qbox.next();
					}
				};
				window.onresize = function(e){
					qbox.resize();
				};
			}
		}
		obj.innerHTML = '<div class="QboxWindow" id="qbox-window"><div id="qbox-inner"></div><a href="#" id="qbox-close" title="'+qbox.val.close_tip+'">'+qbox.val.close+'</a></div>';
		var h = window.innerHeight;
		obj.style.height = h+'px';
		obj.style.display = 'block';
		document.body.style.overflow = 'hidden';
		document.body.style.height = h+"px";
		document.getElementById("qbox-inner").innerHTML = value;
		document.getElementById("qbox-close").onclick = function(){
			return qbox.close();
		}
		var img_pref = document.getElementById("qbox-image-pref");
		if(img_pref){
			img_pref.onclick = function(){
				return qbox.pref();
			}
		}
		var img_next = document.getElementById("qbox-image-next");
		if(img_next){
			img_next.onclick = function(){
				return qbox.next();
			}
		}
		if(!qbox.isopen){
			qbox.fade_in(obj,0);
		}else{
			qbox.fade_in(document.getElementById("qbox-inner"),0);
		}
		qbox.resize();
		qbox.isopen = true;
		if(typeof cb == 'function'){
			cb();
		}
		return false;
	},
	resize : function(){
		var h = window.innerHeight;
		var iframe = document.getElementById("qbox-iframe");
		if(iframe){
			iframe.style.height = (h-60)+"px";
		}
		var box = document.getElementById("qbox-window");
		if(box.offsetHeight > h-40){
			box.style.height = (h-40)+"px";
			box.style.overflowY = 'auto';
		}
		box.style.top = (h/2-box.offsetHeight/2)+"px";
		box.style.left = (window.innerWidth/2-box.offsetWidth/2)+"px";
	},
	
	img_pref : null,
	img_next : null,
	
	pref : function(){
		if(qbox.img_pref){
			qbox.open(qbox.img_pref);
		}
		return false;
	},
	next : function(){
		if(qbox.img_next){
			qbox.open(qbox.img_next);
		}
		return false;
	},
	imageinit : function(){
		var img = document.getElementById("qbox-image");
		var mw = window.innerWidth-60;
		var mh = window.innerHeight-60;
		var iw = img.offsetWidth;
		var ih = img.offsetHeight;
		
		if(iw > mw){
			ih = mw / iw * ih;
			iw = mw;
			img.width = iw;
		}
		if(ih > mh){
			iw = mh / ih * iw;
			ih = mh;
			img.width = iw;
			img.height = mh;
		}
		var box = document.getElementById("qbox-window");
		box.style.width = iw+"px";
		box.style.height = ih+"px";
		box.style.overflow = 'hidden';
		var desc = document.getElementById("qbox-image-desc");
		if(desc){
			desc.style.width = (iw-60)+"px";
		}
		var pref = document.getElementById("qbox-image-pref");
		if(pref){
			pref.style.height = ih-20+"px";
		}
		var next = document.getElementById("qbox-image-next");
		if(next){
			next.style.height = ih+"px";
		}
		qbox.resize();
	},
	close : function(){
		qbox.isopen = false;
		document.body.style.height = "auto";
		document.body.style.overflow = 'auto';
		var obj = document.getElementById("qbox");
		if(obj){
			qbox.fade_out(obj,100,function(){
				obj.innerHTML = '';
				obj.style.display='none';
			});
		}
		return false;
	}
}
