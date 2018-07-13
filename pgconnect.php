<?php 
$link = pg_connect("host=122.155.169.49 port=27388 dbname=portman user=operator password=operator^1999");
if($link){
	print "Database connected...<br/>";
}else{
	print pg_last_error($link);
}
        
// $sql = "SELECT to_json(array_agg(test)) FROM test";
// $res = pg_query($link, $sql);
        
//         $myArr = pg_fetch_assoc($res);

//         preg_match('/^{(.*)}$/', $myArr, $matches);
//         $phpArr = str_getcsv($matches[1]);
      
//         print_r($phpArr);
       
//         // print_r ($myArr);
//         pg_free_result($res);
//         pg_close($link);

$result = pg_query($link, "SELECT * FROM php_car");
if (!$result) {
  echo "An error occurred.\n";
  exit;
}

while ($row = pg_fetch_assoc($result)) {
  echo $row['brand'].' - ';
  echo $row['gen'] .' - ' ;
  echo $row['type_car'].' | ';

}
 
        // $result = $conn->query("SELECT type FROM Carlist"); 
        // $outp = ""; 
        // while($rs = $result->fetch_array(MYSQLI_ASSOC)) { 
        //     if ($outp != "[") {$outp .= " ";} 
        //         $outp .= 'ประเภทรถ  : ' . $rs["type"] . ' ';} 
        //         $outp .=""; 
        //         $conn->close(); 
        //     echo($outp); 

// $conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=123456");
// $result = $conn->pg_query("SELECT to_json(array_agg(test)) FROM test"); 
// $outp = ""; 
// while($rs = $result->pg_fetch_assoc($result)){
//         if( $outp != "[") {$outp .= " "; 
//             $outp .= 'id  : ' . $rs["custid"] . ' ';   
//             $outp .= 'customer  : ' . $rs["customer"] . ' ';
//         }     

//         pg_close($link);
//         print_r ($outp);
//         pg_free_result($conn);
        


       
?>