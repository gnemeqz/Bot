<?php 
$link = pg_connect("host=ec2-184-73-174-171.compute-1.amazonaws.com port=5432 dbname=dd0vscf6vmmsuj user=xercyudnluuomg password=71e72059e3297be42a8a0b61b3c9afc6fdf0a711c365b3f31f08949a515b4a55");
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

$result = pg_query($link,"INSERT INTO  users(mail,userId) VALUES ('$Mail','$dataUser')");
	if(!$result){
		echo 'Not Inserted';
	}else{
		echo 'Inserted';
	
	}
}


?>