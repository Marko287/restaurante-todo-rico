<?php
// Fecha actual
include('../modelo/conexion.php');
date_default_timezone_set('America/Lima');
$fechaActual = date('Y-m-d');
// Actualización a todos los registros que se pasaron la fecha de la reserva
//Lista
$consulta = "SELECT * FROM reserva WHERE fechaDeReserva < '$fechaActual' AND estado = 'reservado'";
$respuesta = mysqli_query($conexion, $consulta);
$nunRows = mysqli_num_rows($respuesta);
mysqli_next_result($conexion);
if($respuesta){
  if($nunRows > 0){
    // Cambiamos el estado de la lista
    while($fila = mysqli_fetch_assoc($respuesta)){
      $idReserva = $fila["id"];
      $consulta = "UPDATE reserva SET estado = 'no asistio' WHERE id = '$idReserva'";
      mysqli_query($conexion, $consulta);
      mysqli_next_result($conexion);
    }
  }
}

?>