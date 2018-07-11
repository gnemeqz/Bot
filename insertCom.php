<?php 
$link = mysqli_connect("localhost","id3526659_emaenggg","123456","id3526659_temptest");
if($link){
	echo "Database connected...<br/>";
}else{
	echo "Database is not connect...".mysqli_error()."<br/>";
}

$Mail = $_POST['c_mail'];
$dataUser = $_POST['$dataId'];
$chkId = $dataUser;

if ($Mail == " ") {
	echo 'Not Inserted'; 
}else{

$sql = "INSERT INTO  users(mail,userId) VALUES ('$Mail','$dataUser')";
	if(!mysqli_query($link,$sql)){
		echo 'Not Inserted';
	}else{
		echo 'Inserted';
	
	}
}


?>