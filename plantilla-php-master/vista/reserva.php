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
        Reservas
        <div class="botones">
            <a href="./inicio.php" class="btn btn-primary">Volver al inicio</a>
            <a href="./reservaciones.php" class="btn btn-warning">Lista de reserva</a>
        </div>
    </div>
    <div class="conatiner-reserva">
        <div class="box-reserva ocupado">
            <div class="texto">
                <h3>Mesa 1</h3>
                <div class="ocupado-por">Ocupado por: Mark</div>
            </div>
            <div class="accion">
                <button class="btn btn-info btn-sm"  disabled>Ordenar</button>
                <button class="btn btn-primary btn-sm">Detalles de mesa</button>
            </div>
        </div>
        <div class="box-reserva">
            <div class="texto">
                <h3>Mesa 2</h3>
                <div class="ocupado-por">Ocupado por: Libre</div>
            </div>
            <div class="accion">
                <a href="./reservar-mesa.php" class="btn btn-info btn-sm">Ordenar</a>
                <button class="btn btn-primary btn-sm">Detalles de mesa</button>
            </div>
        </div>
        <div class="box-reserva">
            <div class="texto">
                <h3>Mesa 3</h3>
                <div class="ocupado-por">Ocupado por: Libre</div>
            </div>
            <div class="accion">
                <a href="./reservar-mesa.php" class="btn btn-info btn-sm">Ordenar</a>
                <button class="btn btn-primary btn-sm">Detalles de mesa</button>
            </div>
        </div>
        <div class="box-reserva">
            <div class="texto">
                <h3>Mesa 4</h3>
                <div class="ocupado-por">Ocupado por: Libre</div>
            </div>
            <div class="accion">
                <a href="./reservar-mesa.php" class="btn btn-info btn-sm">Ordenar</a>
                <button class="btn btn-primary btn-sm">Detalles de mesa</button>
            </div>
        </div>
        <div class="box-reserva">
            <div class="texto">
                <h3>Mesa 5</h3>
                <div class="ocupado-por">Ocupado por: Libre</div>
            </div>
            <div class="accion">
                <a href="./reservar-mesa.php" class="btn btn-info btn-sm">Ordenar</a>
                <button class="btn btn-primary btn-sm">Detalles de mesa</button>
            </div>
        </div>
        <div class="box-reserva">
            <div class="texto">
                <h3>Mesa 6</h3>
                <div class="ocupado-por">Ocupado por: Libre</div>
            </div>
            <div class="accion">
                <a href="./reservar-mesa.php" class="btn btn-info btn-sm">Ordenar</a>
                <button class="btn btn-primary btn-sm">Detalles de mesa</button>
            </div>
        </div>
    </div>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>