<?php
session_start();
if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellidos'])) {
    header('location:../../index.html?msg=sinSesion');
}

?>


<?php require('./layout/topbar.php'); ?>
<?php require('./layout/sidebar.php'); ?>


<div class="page-content">

    <div class="titul-principal">
        Lista de reservaciones
        <div class="botones">
            <a href="./inicio.php" class="btn btn-primary">Volver al inicio</a>
            <a href="./reserva.php" class="btn btn-warning">Vista de mesas</a>
        </div>
    </div>
    <div class="caja">
        <div class="container-table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Reservo el</th>
                        <th scope="col">Para</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for($i=1; $i<=40; $i++){
                        
                    ?>
                    <tr>
                        <th scope="row"><?php echo $i ?></th>
                        <td>Mark</td>
                        <td>Castro Espirito</td>
                        <td>12/12/2025</td>
                        <td>20/12/2025</td>
                        <td>08:00 AM</td>
                        <td>
                            <a href="#" class="btn btn-outline-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="#" class="btn btn-outline-danger btn-sm">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>

                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>



<?php require('./layout/footer.php'); ?>