<?php 
$link = pg_connect("host=122.155.169.49 port=27388 dbname=portman user=operator password=operator^1999");
if($link){
	echo "Database connected...<br/>";
}else{
	print pg_last_error($link);
}
// $sqlChk = pg_query($link, "SELECT id FROM php_car"); 
//   echo $sqlChk;


$sql = pg_query($link,"SELECT id,brand FROM php_car WHERE id = $sqlChk");
while($rs = pg_fetch_array($sql)) { 
    if ($outp != "[") {$outp .= " ";} 
        $outp .= 'ID  : ' . $rs["id"] . ' ';
        $outp .= 'Brand  : ' . $rs["brand"] . ' ';} 

    echo($outp); 
?>