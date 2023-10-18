<?php
$hostname = "localhost";
$user = "root";
$password = "";
$basedatos = "tatosdb2";

$dbcon = mysqli_connect($hostname, $user, $password, $basedatos);

if(!$dbcon){
    echo "Fallo la conexion a MariaDB: (" .$mysqli_connect_errno($dbcon) . ")" . $mysqli_connect_error($dbcon);
}

return $dbcon;