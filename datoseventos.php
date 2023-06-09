<?php

header('Content-Type: application/json');

session_start();

require("conexion.php");

$conexion = regresarConexion();


switch ($_GET['accion']) {

  case 'listar':
    $datos = mysqli_query($conexion, "select id,
                titulo as title,
                descripcion,
                inicio as start,
                fin as end,
                colortexto as textColor,
                colorfondo as backgroundColor
                from eventos");
    $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
    echo json_encode($resultado);

    break;

  case 'agregar':
    $respuesta = mysqli_query($conexion, "insert into eventos (titulo, descripcion, inicio, fin, colortexto, colorfondo, usuario) values
                          ('$_POST[titulo]','$_POST[descripcion]','$_POST[inicio]','$_POST[fin]','$_POST[colortexto]','$_POST[colorfondo]','$_SESSION[usuario]')");
    echo json_encode($respuesta);
    break;

  case 'modificar':
    $respuesta = mysqli_query($conexion, "update eventos set titulo = '$_POST[titulo]',
                        descripcion = '$_POST[descripcion]',
                        inicio = '$_POST[inicio]',
                        fin = '$_POST[fin]',
                        colortexto = '$_POST[colortexto]',
                        colorfondo = '$_POST[colorfondo]'
                        where id = $_POST[id]");
    echo json_encode($respuesta);
    break;

  case 'borrar':
      $respuesta = mysqli_query($conexion, "delete from eventos where id = $_POST[id]");
      echo json_encode($respuesta);
    break;
}

 ?>
