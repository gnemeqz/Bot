<?php 

<div id="num01"></div>
<script>
var xmlhttp = new XMLHttpRequest();
var url = "http://203.158.131.67/~chumpol/04-06-243/Lab01/showMyMobiles.php";

xmlhttp.onreadystatechange = function(){
	if (this.readyState == 4 && this.status == 200) {
		var myArr = JSON.parse(this.responseText);
		getMobile(myArr);
		}
	};
xmlhttp.open("GET",url,true);
xmlhttp.send();

function getMobile(tmpMobile){
	var res = "";
	var i;
	for (i = 0; i < tmpMobile.length; i++) {
		res += '<tr><td>'+tmpMobile[i].Name+'</td><td>'+ tmpMobile[i].OS + '</td><td>'+ tmpMobile[i].CPU + '</td><td>' + tmpMobile[i].ROM_RAM +'</td></td>'+ tmpMobile[i].Price + '</td></tr>';
    }
    document.getElementById("num01").innerHTML = '<table><tr><th>MobileName</th><th>OS</th><th>CPU</th><th>Price</th></tr>' + res + '</table>';
} 

</script>







?>