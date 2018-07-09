<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');


include('dbconnect.php');

$name = $_REQUEST['name'];

$sql = "SELECT * FROM  carlist  where  brand LIKE '%".$name"%' ";

echo $sql;


$resource = mysql_query($sql);

$count_row = mysql_num_rows($resource);

if($count_row > 0) {
 while($result = mysql_fetch_assoc($resource)){
  $rows[]=$result;
 }


 $data = json_encode($rows);
 $totaldata = sizeof($rows);
 $results = '{"results":'.$data.'}';

}else{
 $results = '{"results":null}';
}

echo $results;
?>