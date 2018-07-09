<?php 
$link = mysqli_connect("localhost","root","emaenggg","cartemp");
if($link){
	echo "Database connected...<br/>";
}else{
	echo "Database is not connect...".mysqli_error()."<br/>";
}

$sql = "SELECT * FROM  carlist";
$res = mysqli_query($link, $sql);
    while($obj = ($res)){
         $obj->id.  "   ,  ";
         $obj->brand."  ,  ";
         $obj->gen."  ,  ";
         $obj->type."    ";echo "<br/>";

        $myText = json_decode($obj);
        echo $myText;
    }
        mysqli_free_result($res);
        mysqli_close($link);

?>