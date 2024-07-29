<?php
session_start();
if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellidos'])) {
    header('location:../../index.html?msg=sinSesion');
}

include('../modelo/conexion.php');
// Consultar si la mesa ya esta reservada
$numMesa = intval($_GET["mesa"]);
$consulta = "SELECT * FROM reserva WHERE numeroMesa = '$numMesa' AND estado = 'reservado'";
$respuesta = mysqli_query($conexion, $consulta);
$numRows = mysqli_num_rows($respuesta);
if($numRows > 0){
    header('location:./reserva.php?msg=mesaOcupada');
}
// Fecha actual
date_default_timezone_set('America/Lima');
$fechaActual = date('Y-m-d');
// Incialización de variables
$mensaje = '';
$dni = '';
$nombre = '';
$apellidos = '';
$celular = '';
$fechaDeReserva = '';
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
        $consulta = "INSERT INTO reserva (dni, nombre, apellidos, celular, numeroMesa, fechaQueReservo, fechaDeReserva, pagoReserva, estado) VALUES ('$dni', '$nombre', '$apellidos', '$celular', '$numMesa', '$fechaReservo', '$fechaDeReserva', '$pagoReserva', 'reservado') ";
        $respuesta = mysqli_query($conexion, $consulta);
        if($respuesta){
            $idReserva = mysqli_insert_id($conexion);
            // Abrir la pestaña con el envio del id mediante la URL
            echo "<script>
                window.open('./ticket-pdf.php?id=$idReserva', '_blank');
                window.location.href = './reserva.php?msg=mesaReservada';
            </script>";
            // header('location:./reserva.php?msg=mesaReservada');
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
        Reservar la mesa número <?php echo $_GET["mesa"]; ?>
        <div class="botones">
            <a href="./inicio.php" class="btn btn-primary">Volver al inicio</a>
            <a href="./reserva.php" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
    <form class="formulario" method="post">
        <?php echo $mensaje; ?>
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-9">
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI:</label>
                            <input value="<?php echo $dni; ?>" type="text" class="form-control" id="dni" name="dni" placeholder="Escriba el DNI para buscar" required>
                        </div>
                    </div>
                    <div class="col-2">
                        <button style="width: 110px;" id="buscarDNI" class="btn btn-primary btn-sm mt-4"><i class="fa-solid fa-search"></i> Buscar</button>
                    </div>
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
        <button type="submit" class="btn btn-primary btn-sm">Reservar</button>
    </form>
</div>
</div>
<!-- fin del contenido principal -->

<script>
    const buscarDNI = document.getElementById("buscarDNI");
    buscarDNI.addEventListener('click', async (e)=>{
        e.preventDefault();
        const dni = document.getElementById("dni").value;
        if(dni !== '' && dni.length === 8){
            const formData = new FormData();
            formData.append('dni', dni);
            const res = await fetch('api.php', {
                method: 'POST',
                mode: 'cors',
                body: formData
            });
            const resJson = await res.json();
            if(res.json){
                document.getElementById("nombre").value = resJson.nombres;
                document.getElementById("apellidos").value = resJson.apellidoPaterno + ' ' + resJson.apellidoMaterno;
            }else{
                swal({
                    title: 'Error',
                    text: 'Algo salio mal en la consulta',
                    icon: 'error',
                });
            }
        }else{
            swal({
                title: 'Verifique',
                text: 'El DNI es erroneo verifique',
                icon: 'error',
            });
        }
    });
    
</script>
<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>