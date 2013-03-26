<?php
/**
 * Copyright 2012 @ BWmedien GmbH
 * 
 * Author : Benjamin Hartl
 * Date : 2012-11-26
 */

?><!DOCTYPE html>
<html>
<head>
<title>Tablesort</title>
<style>
html,body {
	font-family:arial;
	font-size:12px;
}

table {
	background-color:#CCC;
	border-spacing:0px;
}
table tr,table th, table td {
	margin:0px;
	padding:0px;
	border:0px;
}
table th {
	width:150px;
	padding:10px 20px;
	background-color:#AE0;
	border-top:1px solid #CF0;
	border-left:1px solid #BC0;
	border-bottm:1px solid #BC0;
	border-right:1px solid #CF0;
	text-align:left;
}
table th.ThSortable {
	cursor:pointer;
	-moz-user-select: none; 
	-khtml-user-select: none; 
	user-select: none;
}
table th.ThSortUp, table th.ThSortDown {
	background-color:#BF4;
}
table td {
	padding:5px 20px;
	border-top:1px solid #F5F5F5;
	border-left:1px solid #AAA;
	border-bottom:1px solid #AAA;
	border-right:1px solid #F5F5F5;
}
table td.First, table th.First {
	border-left:0px;
}
table tr.Second {
	background-color:#DDD;
}

</style>
<script>
function SbxTablesort(obj,cb) {
	
	var objects = new Array();
	var compare = function(a,b){
		if(a.sort < b.sort){
			return -1;
		}else if(a.sort > b.sort){
			return 1;
		}else{
			return 0;
		}
	};
	var i = objects.length;
	var th = obj.getElementsByTagName("thead")[0].getElementsByTagName("th");
	var tb = obj.getElementsByTagName("tbody")[0];
	var td = tb.getElementsByTagName("tr")[0].getElementsByTagName("td");
	if(th && td){
		if(cb && typeof cb == "function"){
			cb(tb);
		}
		objects[i] = {
			table : obj,
			col : 0,
			up : false,
			callback : cb,
			sort : function(col){
				this.col = col;
				this.up = !this.up;
				var th = this.table.getElementsByTagName("th");
				for(i=0;i<th.length;i++){
					if(th[i].className.match(/ThSortable/)){
						th[i].className = "ThSortable";
						if(i == col){
							th[i].className = "ThSortable ThSort"+(this.up ? "Up" : "Down");
						}
					}
				}
				var a = new Array();
				var s = "";
				var tr = this.table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
				for(i=0;i<tr.length;i++){
					a.push({
						sort : tr[i].getElementsByTagName("td")[col].getAttribute("data-sort"),
						val : tr[i].innerHTML
					});
				}
				a.sort(objects);
				for(i=0;i<a.length;i++){
					var row = '<tr>'+a[i].val+'</tr>';
					if(this.up){
						s += row;
					}else{
						s = row+s;
					}
				}
				this.table.getElementsByTagName("tbody")[0].innerHTML = s;
				if(typeof this.callback == "function"){
					this.callback(this.table.getElementsByTagName("tbody")[0]);
				}
			}
		};
		
		for(var j=0;j<th.length;j++){
			if(td[j] && td[j].getAttribute("data-sort") != null){
				th[j].onclick = function(me,i,j){
					return function(){
						me.tablesorta[i].sort(j);
					}
				}(this,i,j);
				th[j].className = "ThSortable";
			}
		}
	}
}
</script>
</head>
<body>
<h3>Tablesort</h3>
<table id="table" data-key="table-sort">
	<thead>
		<tr class="First">
			<th class="First">Geb.</th>
			<th>Name</th>
			<th>Download</th>
		</tr>
	</thead>
	<tbody>
		<tr class="Second">
			<td data-sort="1992-06-01">01.06.1992</td>
			<td data-sort="Benjamin">Benjamin</td>
			<td><a href="#">Download</a></td>
		</tr>
		<tr class="First">
			<td data-sort="1995-08-03">03.08.1995</td>
			<td data-sort="Matthias">Matthias</td>
			<td><a href="#">Download</a></td>
		</tr>
		<tr class="Second">
			<td data-sort="1991-01-22">22.01.1991</td>
			<td data-sort="Vroni">Vroni</td>
			<td><a href="#">Download</a></td>
		</tr>
		<tr class="First">
			<td data-sort="22.09.1970">22.09.1970</td>
			<td data-sort="Regina">Regina</td>
			<td><a href="#">Download</a></td>
		</tr>
	</tbody>
</table>
<script>
var ts = new SbxTablesort(document.getElementById("table"),function(tb){
	var tr = tb.getElementsByTagName("tr");
	for(var i=0;i<tr.length;i++){
		tr[i].className = i%2 == 0 ? "Second" : "First";
	}
});
</script>
</body>
</html>