<?php


function regresarConexion(){
  $server = "localhost";
  $usuario = "root";
  $clave = "";
  $base = "base_calendarioweb";

$conexion = mysqli_connect($server, $usuario, $clave, $base) or die ("Problema de conexion");
mysqli_set_charset($conexion, 'utf8');
return $conexion;
}


?>
