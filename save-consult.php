<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=donaciones.xls");

$servername = "db631924938.db.1and1.com";
$username = "dbo631924938";
$password = "oEyTjtgXVEreieHxjWWB";
$dbname = "db631924938";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT  
p.ID as id, p.post_date as fecha,
p.post_title as nombre,
		MAX(CASE WHEN pm1.meta_key = 'monto' then pm1.meta_value ELSE NULL END) as monto,
		MAX(CASE WHEN pm1.meta_key = 'correo' then pm1.meta_value ELSE NULL END) as correo,
		MAX(CASE WHEN pm1.meta_key = 'celular' then pm1.meta_value ELSE NULL END) as celular,
		MAX(CASE WHEN pm1.meta_key = 'calle' then pm1.meta_value ELSE NULL END) as calle,
		MAX(CASE WHEN pm1.meta_key = 'numero' then pm1.meta_value ELSE NULL END) as numero,
		MAX(CASE WHEN pm1.meta_key = 'colonia' then pm1.meta_value ELSE NULL END) as colonia,
		MAX(CASE WHEN pm1.meta_key = 'cp' then pm1.meta_value ELSE NULL END) as cp,
		MAX(CASE WHEN pm1.meta_key = 'municipio' then pm1.meta_value ELSE NULL END) as municipio,
		MAX(CASE WHEN pm1.meta_key = 'estado' then pm1.meta_value ELSE NULL END) as estado
 FROM  HjHwmqCbposts as p  
 JOIN HjHwmqCbpostmeta as pm1 

 ON  pm1.post_id = p.ID 

where

p.post_type ='donaciones' and post_status = 'publish'
                  
GROUP BY
   p.ID";
   
   
   
$result = $conn->query($sql);
echo  'Nombre'.  "\t" . 'Monto'. "\t"  . 'Correo'. "\t"  . 'Celular' . "\t"  . 'Calle' . "\t"  . 'Numero' . "\t"  . 'Colonia' . "\t"  . 'CP'. "\t"  . 'Municipio' . "\t"  . 'Estado' . "\n";


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  $row["nombre"].  "\t" . $row["monto"]. "\t"  . $row["correo"]. "\t"  . $row["celular"] . "\t"  . $row["calle"] . "\t"  . $row["numero"] . "\t"  . $row["colonia"] . "\t"  . $row["cp"] . "\t"  . $row["municipio"] . "\t"  . $row["estado"] . "\n";
    }
} else {
    echo "0 results";
}
$conn->close();



?>