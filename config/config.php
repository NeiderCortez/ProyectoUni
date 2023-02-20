<?php

$CONserver = "localhost";
$CONuser ="root";
$CONpass="123456";
$CONdb="redsocial";

$conexion= new mysqli($CONserver,$CONuser,$CONpass,$CONdb);

if ($conexion->connect_errno) {
	 die("La conexion ha fallado");
}

?>