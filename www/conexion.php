<?php

$mysqli = new \mysqli("docker-mysql:3306","root","123456","db_crud_3_capas");

if($mysqli->connect_errno){
    die("fallo la conexion");
}else{
    //echo("Conexion exitosa");
}

?>   