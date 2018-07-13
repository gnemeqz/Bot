<?php 
$link  = pg_connect("host=122.155.169.49 port=27388 dbname=portman user=operator password=operator^1999");
if($link){
	echo "Database connected...<br/>";
}else{
	echo "Database is not connect...".pg_last_error()."<br/>";
}

$Mail = $_POST['c_mail'];
$dataUser = $_POST['$dataId'];
$chkId = $dataUser;

if ($Mail == " ") {
	echo 'Not Inserted'; 
}else{

$result = pg_query($link, "INSERT INTO  php_user(code,mail) VALUES ('$dataUser','$Mail')");
	if(!$result){
		echo 'Not Inserted';
	}else{
		echo 'Inserted';
	
	}
}


?>