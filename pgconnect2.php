<?php
 



$conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=123456"); 
$result = pg_query($conn, "SELECT lat,lng FROM Locat WHERE LOC_ID = '1'"); 
                
                while($row = pg_fetch_array($result)) { 
                  echo  $row['lat']. '  ';
                  echo  $row['lng']. '  '; }
                    
                    pg_close($conn);
?>