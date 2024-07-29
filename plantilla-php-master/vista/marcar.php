<?php
if($_GET["id"]){
  include('../modelo/conexion.php');
  $id = $_GET["id"];
  $consulta = "UPDATE reserva SET estado = 'finalizado' WHERE id = '$id'";
  $respuesta = mysqli_query($conexion, $consulta);
  if($respuesta){
    header('location:./reservaciones.php?msg=marcarFinalizado');
  }else{
    header('location:./reservaciones.php?msg=errorMarcarFinalizado');
  }
}
?>