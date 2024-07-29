<?php
session_start();
if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellidos'])) {
    header('location:../../index.html?msg=sinSesion');
}

include('../modelo/conexion.php');
$id = $_GET["id"];
// Fecha actual
date_default_timezone_set('America/Lima');
$fechaActual = date('Y-m-d');
// Obtener los datos de la mesa reservada
$consulta = "SELECT * FROM reserva WHERE id = '$id'";
$respuesta = mysqli_query($conexion, $consulta);
$datos = mysqli_fetch_assoc($respuesta);
$mensaje = '';
$dni = $datos["dni"];
$nombre = $datos["nombre"];
$apellidos = $datos["apellidos"];
$celular = $datos["celular"];
$fechaDeReserva = $datos["fechaDeReserva"];
$validar = false;
if($_POST){
    $dni = $_POST["dni"];
    $nombre = trim(ucwords($_POST["nombre"]));
    $apellidos = trim(ucwords($_POST["apellidos"]));
    $celular = $_POST["celular"];
    date_default_timezone_set('America/Lima');
    $fechaReservo = date('Y-m-d H:i:s'); // El día que vino
    $fechaDeReserva = $_POST["fechaDeReserva"]; // Fecha para cuando
    $pagoReserva = 30;
    // Verificar si el número de DNI es valido
    if($dni === ""){
        $mensaje = '
            <div class="alert alert-danger" role="alert">
                El número de DNI es necesario
            </div>
        ';
        $validar = false;
    }else{ $validar = true; }
    if($validar){
        if(!is_numeric($dni)){
            $mensaje = '
                <div class="alert alert-danger" role="alert">
                    El DNI solo debe contener números
                </div>
            ';
            $validar = false;
        }else{ $validar = true; }
    }

    if($validar){
        if(strlen($dni) !== 8){
            $mensaje = '
                <div class="alert alert-danger" role="alert">
                    El DNI debe contener 8 números
                </div>
            ';
        }else{ $validar = true; }
    }

    // Validad celular
    if($validar){
        if($celular === ""){
            $mensaje = '
                <div class="alert alert-danger" role="alert">
                    El número de celular es necesario
                </div>
            ';
            $validar = false;
        }else{ $validar = true; }
    }
    
    if($validar){
        if(!is_numeric($celular)){
            $mensaje = '
                <div class="alert alert-danger" role="alert">
                    El número de celular solo debe contener números
                </div>
            ';
            $validar = false;
        }else{ $validar = true; }
    }

    if($validar){
        if(strlen($celular) !== 9){
            $mensaje = '
                <div class="alert alert-danger" role="alert">
                    El número de celular debe contener 9 números
                </div>
            ';
            $validar = false;
        }else{ $validar = true; }
    }

    if($validar){
        // Creando la consulta para el insertado a la base de datos
        $consulta = "UPDATE reserva SET nombre = '$nombre', apellidos = '$apellidos', celular = '$celular', fechaDeReserva = '$fechaDeReserva' WHERE id = '$id'";
        $respuesta = mysqli_query($conexion, $consulta);
        if($respuesta){
            header('location:./reserva.php?msg=mesaReservadaActualizada');
        }else{
            $mensaje = '
                <div class="alert alert-danger" role="alert">
                    Algo salio mal al intentar reservar la mesa
                </div>
            ';
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
        Editar la mesa <?php echo $_GET["mesa"]; ?>
        <div class="botones">
            <a href="./reservaciones.php" class="btn btn-primary">Volver a la lista</a>
        </div>
    </div>
    <form class="formulario" method="post">
        <?php echo $mensaje; ?>
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI:</label>
                    <input value="<?php echo $dni; ?>" type="text" class="form-control" id="dni" name="dni" placeholder="Escriba el DNI para buscar" required readonly>
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input value="<?php echo $nombre; ?>" type="text" class="form-control" id="nombre" name="nombre" placeholder="Escriba el nombre" required>
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input value="<?php echo $apellidos; ?>" type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Escribe los apellidos" required>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="celular" class="form-label">Celular:</label>
                    <input value="<?php echo $celular; ?>" type="text" class="form-control" id="celular" name="celular" placeholder="Número de celular" required>
                </div>
                <div class="mb-3">
                    <label for="fechaDeReserva" class="form-label">Para la fecha:</label>
                    <input value="<?php echo $fechaDeReserva === '' ? $fechaActual : $fechaDeReserva; ?>" min="<?php echo $fechaActual; ?>" type="date" class="form-control" id="fechaDeReserva" name="fechaDeReserva" placeholder="Seleccione la hora" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-warning btn-sm">Actualizar</button>
        <a href="anular-reserva.php?id=<?php echo $_GET["id"] . "&mesa=" . $_GET["mesa"]; ?>" type="submit" class="btn btn-danger btn-sm">Anular reserva</a>
    </form>
    <form action="ticket-excel.php">
        <a href="ticket-pdf.php?id=<?php echo $_GET["id"]; ?>" type="submit" class="btn btn-danger btn-sm" target="_blank">Descargar ticket como PDF</a>
        <input type="hidden" value="<?php echo $_GET["id"]; ?>" name="id">
        <button type="submit" class="btn btn-success btn-sm">
            Descargar ticket como Excel
        </button>
    </form>
</div>
</div>
<!-- fin del contenido principal -->

<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>