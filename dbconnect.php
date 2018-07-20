<?php 
$link = pg_connect("host=122.155.169.49 port=27388 dbname=portman user=operator password=operator^1999");
if($link){
	echo "Database connected...<br/>";
}else{
	print pg_last_error($link);
}



?>