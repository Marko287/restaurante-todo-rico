<?php
session_start();
if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellidos'])) {
    header('location:../../index.html?msg=sinSesion');
}

include('../modelo/conexion.php');
// Fecha actual
date_default_timezone_set('America/Lima');
$fechaActual = date('Y-m-d');
// Conulta de datos con ID
$idReserva = $_GET["id"];
$consulta = "SELECT * FROM reserva WHERE id = '$idReserva'";
$respuesta = mysqli_query($conexion, $consulta);
$reservaData = mysqli_fetch_assoc($respuesta);
// Incialización de variables
$mensaje = '';
$motivo = '';
if($_POST){
    $idReserva = $_GET["id"];
    $motivo = $_POST["motivo"];
    $devolcion = $reservaData["pagoReserva"];
    $fechaAnulacion = date('Y-m-d H:i:s');
    // Añadimos un registro de anulación de reserva
    $consulta = "INSERT INTO anulaciones (id_reserva, fechaAnulacion, motivo, devolucion) VALUES ('$idReserva', '$fechaAnulacion', '$motivo', '$devolcion')";
    $respuesta = mysqli_query($conexion, $consulta);
    mysqli_next_result($conexion);
    if($respuesta){
        // Anular el registro de reserva
        $consulta = "UPDATE reserva SET estado = 'anulado' WHERE id = '$idReserva'";
        $respuesta = mysqli_query($conexion, $consulta);
        mysqli_next_result($conexion);
        if($respuesta){
            header('location:./reservaciones.php?msg=anulacionExito');
        }
    }else{
        if($respuesta){
            header('location:./reservaciones.php?msg=anulacionError');
        }
    }
}
?>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">
    <div class="titul-principal">
        Anular la reserva de mesa <?php echo $_GET["mesa"]; ?>
        <div class="botones">
            <a href="./reservaciones.php" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
    <form class="formulario" method="post">
        <p>Rellene el formulario para realizar la anulación de la reserva</p>
        <?php echo $mensaje; ?>
        <h5 class="mb-2">Datos adicionales:</h5>
        <ul class="list-group">
            <li class="list-group-item"><b>DNI: </b><?php echo $reservaData["dni"]; ?></li>
            <li class="list-group-item"><b>Nombre: </b><?php echo $reservaData["nombre"]; ?></li>
            <li class="list-group-item"><b>Apellidos: </b><?php echo $reservaData["apellidos"]; ?></li>
            <li class="list-group-item"><b>Fecha que vino a reservar: </b><?php echo $reservaData["fechaQueReservo"]; ?></li>
            <li class="list-group-item"><b>Fecha para cuando quiso la reserva: </b><?php echo $reservaData["fechaDeReserva"]; ?></li>
            <li class="list-group-item"><b>Pago de reserva: </b> S/<?php echo $reservaData["pagoReserva"]; ?></li>
        </ul>
        <div class="row">
            <div class="m-3">
                <label for="motivo" class="form-label">Motivo de anulación</label>
                <textarea class="form-control" name="motivo" id="motivo" rows="3" placeholder="Escribe la razón" style="width: 98%;" required></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-danger btn-sm">Anular reserva</button>
    </form>
</div>
</div>
<!-- fin del contenido principal -->

<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>