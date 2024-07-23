<?php
if($_GET["id"]){
  include('../modelo/conexion.php');
  $id = $_GET["id"];
  $consulta = "DELETE FROM reserva WHERE id = '$id'";
  $respuesta = mysqli_query($conexion, $consulta);
  if($respuesta){
    header('location:./reservaciones.php?msg=eliminarReserva');
  }else{
    header('location:./reservaciones.php?msg=errorEliminarReserva');
  }
}
?>