<?php

?><!DOCTYPE html>
<html>
<head>

<title>3D Corousel</title>

<style>
html,body {
	margin:0px;
	padding:0px;
	font-family:arial,sans-serif;
	font-size:14px;
	background-color:#173c54;
}
.Wrapper {
	width:700px;
	margin:10px auto;
	padding:10px;
	border:1px solid #CCC;
	background-color:white;
}
.Wrapper h1 {
	margin:0px;
	padding:5px 10px;
	background-color:black;
	font-size:18px;
	color:white;
}
.Wrapper p {
	padding:5px 0px;
}
.Wrapper .Control {
	text-align:center;
}
.Wrapper .Control input[type=button] {
	width:100px;
}

ul.Carousel {
	position:relative;
	height:300px;
	margin:0px;
	padding:0px;
	border:1px inset #666;
	overflow:hidden;
}
ul.Carousel li.CarouselElement {
	position:absolute;
	top:0px;
	left:0px;
	width:300px;
	height:200px;
	margin:0px;
	padding:0px;
	background-color:#CCC;
	border:2px solid #AAA;
	list-style:none;
	
}
</style>

<script>

function SbxCarousel(obj,param){

	if(!param){
		param = {
			box : {}
		};
	}
	var caro_container = obj;
	var caro_elements = new Array();
	var caro_box_width = param.box.width || 300;
	var caro_box_height = param.box.height || 200;
	var caro_box_top = -10;
	var caro_box_left = 80;
	var caro_box_size = 30;
	var caro_anz = 2;
	var caro_speed = 5;
	var caro_last = 0;
	var caro_index = 0;
	var caro_run = false;
	
	this.next = function(){
		if(!caro_run){
			caro_index--;
			if(caro_index < 0){
				caro_index = caro_elements.length-1;
			}
			this.show(caro_index);
		}
	};
	this.pref = function(){
		if(!caro_run){
			caro_index++;
			if(caro_index >= caro_elements.length){
				caro_index = 0;
			}
			this.show(caro_index);
		}
	};
	this.run = function(count){
		if(count < 100){
			count++;
			for(i=caro_anz*-1;i<=caro_anz;i++){
				this.render(this.find(caro_index,i),i+count/100);
			}
			window.setTimeout(function(caro,count){
				return function(){
					caro.run(count);
				}
			}(this,count),caro_speed);
		}else{
			caro_run = false;
			caro_last = caro_index;
		}
	};
	this.find = function(index,i){
		if(!i){
			i = 0;
		}
		if(index+i < 0){
			i = caro_elements.length-i;
		}else if(index+i > caro_elements.length){
			i = Math.abs(i);
		}
		return index+i;
	};
	this.render = function(index,i){
		if(caro_elements[index]){
			var abs = Math.abs(i);
			caro_elements[index].style.display = "block";
			caro_elements[index].style.zIndex = Math.floor(caro_anz+1-abs);
			caro_elements[index].style.width = (caro_box_width-(abs*caro_box_size))+"px";
			caro_elements[index].style.height = (caro_box_height-(abs*caro_box_size))+"px";
			caro_elements[index].style.top = ((caro_container.offsetHeight/2)-(caro_box_height/2)+(abs*caro_box_top))+"px";
			caro_elements[index].style.left = ((caro_container.offsetWidth/2)-(caro_box_width/2)+(i*caro_box_left))+"px";
		}
	};
	this.show = function(index){
		if(!caro_run && index != caro_last){
			caro_run = true;
			caro_index = index;
			this.run(0);
		}
	};

	var i = 0;
	var tmp = obj.getElementsByTagName("li");
	for(i=0;i<tmp.length;i++){
		if(tmp[i].className == "CarouselElement"){
			tmp[i].style.display="none";
			tmp[i].onclick = function(caro,i){
				return function(){
					caro.show(i);
				}
			}(this,i);
			caro_elements.push(tmp[i]);
		}
	}
	caro_index = Math.floor(caro_elements.length/2);
	for(i=caro_anz*-1;i<=caro_anz;i++){
		this.render(caro_index+i,i);
	}
}
</script>

</head>
<body>

<div class="Wrapper">

<h1>Simple 3D Karusell</h1>
<p>
	Ein simpler 3D-Karusell effekt
</p>
<br />
<ul id="c" class="Carousel">

<?php
for($i=0;$i<=5;$i++){
	echo '<li class="CarouselElement">Container '.$i.'</li>';
}
?>

</ul>
<br />
<p class="Control">
	<input type="button" value="zur&uuml;ck" onclick="c.pref()" />
	<input type="button" value="weiter" onclick="c.next()" />
</p>

</div>

<script>
var c = new SbxCarousel(document.getElementById("c"));
</script>

</body>
</html>