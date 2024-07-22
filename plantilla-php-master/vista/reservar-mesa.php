<?php
session_start();
if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellidos'])) {
    header('location:../../index.html?msg=sinSesion');
}

?>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <div class="titul-principal">
        Reservar mesa #2
        <div class="botones">
            <a href="./inicio.php" class="btn btn-primary">Volver al inicio</a>
            <a href="./reserva.php" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
    <form class="formulario">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI:</label>
                    <div class="row">
                        <div class="col-10">
                            <input type="text" class="form-control" id="dni" name="dni" placeholder="Escriba el DNI para buscar">
                        </div>
                        <div class="col-2">
                            <button id="buscarDNI" class="btn btn-primary btn-sm"><i class="fa-solid fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escriba el nombre">
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Escribe los apellidos">
                </div>
                <div class="mb-3">
                    <label for="mesa" class="form-label">Número de mesa:</label>
                    <select class="form-control" name="mesa" id="mesa">
                        <option value="1">Mesa 1</option>
                        <option value="2">Mesa 2</option>
                        <option value="3">Mesa 3</option>
                        <option value="4">Mesa 4</option>
                        <option value="5">Mesa 5</option>
                        <option value="6">Mesa 6</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="celular" class="form-label">Celular:</label>
                    <input type="text" class="form-control" id="celular" name="celular" placeholder="Número de celular">
                </div>
                <div class="mb-3">
                    <label for="fechaReservo" class="form-label">Fecha que reservo:</label>
                    <input type="date" class="form-control" id="fechaReservo" name="fechaReservo" placeholder="Seleccione la fechaReservo">
                </div>
                <div class="mb-3">
                    <label for="fechaDeReserva" class="form-label">Para la fecha:</label>
                    <input type="date" class="form-control" id="fechaDeReserva" name="fechaDeReserva" placeholder="Seleccione la hora">
                </div>
                <div class="mb-3">
                    <label for="pagoReserva" class="form-label">Pago de reserva:</label>
                    <input type="number" min="20" class="form-control" id="pagoReserva" name="pagoReserva" placeholder="Seleccione la hora">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Reservar</button>
        <button type="submit" class="btn btn-warning btn-sm">Reporte</button>
    </div>
</div>
</div>
<!-- fin del contenido principal -->

<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>
<script src="api.js"></script>