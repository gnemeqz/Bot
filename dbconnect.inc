<?php 
$link = mysqli_connect("localhost","id3526659_emaenggg","123456","id3526659_temptest");
if($link){
	echo "Database connected...<br/>";
}else{
	echo "Database is not connect...".mysqli_error()."<br/>";
}

?>