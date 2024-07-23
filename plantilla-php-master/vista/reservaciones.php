<?php
session_start();
if (!isset($_SESSION['nombre']) && !isset($_SESSION['apellidos'])) {
    header('location:../../index.html?msg=sinSesion');
}

include('../modelo/conexion.php');
// Fecha actual
date_default_timezone_set('America/Lima');
$fechaActual = date('Y-m-d');
// Consultar la lista de mesas reservadas
$consulta = "SELECT * FROM `reserva` ORDER BY fechaDeReserva DESC";
$respuesta = mysqli_query($conexion, $consulta);
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
                        <th scope="col">Mesa</th>
                        <th scope="col">Reservo el</th>
                        <th scope="col">Para</th>
                        <th scope="col">Pago</th>
                        <th scope="col">estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while($fila = mysqli_fetch_assoc($respuesta)){
                    ?>
                    <tr>
                        <th scope="row"><?php echo $i ?></th>
                        <td><?php echo $fila["nombre"] ?></td>
                        <td><?php echo $fila["apellidos"] ?></td>
                        <td><?php echo $fila["numeroMesa"] ?></td>
                        <td><?php echo $fila["fechaQueReservo"] ?></td>
                        <td><?php echo $fila["fechaDeReserva"] ?></td>
                        <td><?php echo "S/" . $fila["pagoReserva"] ?></td>
                        <td><?php echo $fila["estado"] ?></td>
                        <td>
                            <?php
                            if($fila["fechaDeReserva"] >= $fechaActual){ ?>
                                <?php if($fila["estado"] !== 'anulado'){ ?>
                                    <?php if($fila["estado"] !== 'no asistio'){ ?>
                                        <a href='./editar-reserva.php?id=<?php echo $fila["id"]; ?>&mesa=<?php echo $fila["numeroMesa"]; ?>' class='btn btn-outline-warning btn-sm' title='Editar'>
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a href='./anular-reserva.php?id=<?php echo $fila["id"];?>&mesa=<?php echo $fila["numeroMesa"];?>' class='btn btn-outline-warning btn-sm' title='Anular reserva'>
                                            <i class="fa-solid fa-ban"></i>
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                            <?php
                            }
                            ?>
                            <a href='./eliminar-reserva.php?id=<?php echo $fila["id"];?>' class="btn btn-outline-danger btn-sm" title="Eliminar">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>

                    <?php
                    $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>



<?php require('./layout/footer.php'); ?>