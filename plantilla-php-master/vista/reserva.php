<?php
session_start();
if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellidos'])) {
    header('location:../../index.html?msg=sinSesion');
}

include('../modelo/conexion.php');
// Consultar las mesas reservadas
// Fecha actual
date_default_timezone_set('America/Lima');
$fechaActual = date('Y-m-d');
?>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <div class="titul-principal">
        Reservas
        <div class="botones">
            <a href="./inicio.php" class="btn btn-primary">Volver al inicio</a>
            <a href="./reservaciones.php" class="btn btn-warning">Lista de reserva</a>
        </div>
    </div>
    <div class="conatiner-reserva">
        <?php for($i = 1; $i <= 6; $i++){
            $consulta = "SELECT * FROM reserva WHERE numeroMesa = '$i' AND fechaDeReserva >= '$fechaActual' AND estado = 'reservado'";
            $respuesta = mysqli_query($conexion, $consulta);
            $datosDeReserva = mysqli_fetch_assoc($respuesta);
            $numRows = mysqli_num_rows($respuesta);
        ?>
        <div class="box-reserva <?php echo $numRows > 0 ? "ocupado" : '' ?>">
            <div class="texto">
                <h3>Mesa <?php echo $i ?></h3>
                <?php
                if($numRows > 0){
                    $nombreApellidos = $datosDeReserva["nombre"] . " " . $datosDeReserva["apellidos"];
                }
                echo $numRows > 0 ? "<div class='ocupado-por'>Ocupado por: $nombreApellidos</div>" : '';
                ?>
            </div>
            <div class="accion">
                <?php echo $numRows > 0 ? '' : "<a href='./reservar-mesa.php?mesa=$i' class='btn btn-info btn-sm' >Reservar</a>" ?>
                <?php echo $numRows > 0 ? '<button class="btn btn-primary btn-sm">Detalles de mesa</button>' : '' ?>
                <?php echo $numRows > 0 ? "<a href='./editar-reserva.php?id=". $datosDeReserva["id"] ."&mesa=". $datosDeReserva["numeroMesa"] ."' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen'></i></a>" : '' ?>
            </div>
        </div>
        <?php } ?>
    </div>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>