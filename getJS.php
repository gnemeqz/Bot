<?php header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8"); 
$conn = new mysqli("localhost", "id3526659_emaenggg", "123456", "id3526659_temptest"); 
$result = $conn->query("SELECT brand,gen,type FROM Carlist"); 
$outp = "["; 
while($rs = $result->fetch_array(MYSQLI_ASSOC)) { 
    if ($outp != "[") {$outp .= ",";} 
    $outp .= '{"brand":"' . $rs["brand"] . '",'; 
    $outp .= '"gen":"' .    $rs["gen"] . '",'; 
    $outp .= '"type":"'.    $rs["type"] . '"}'; } 
    $outp .="]"; 
    $conn->close(); 
    echo($outp); 
    ?>