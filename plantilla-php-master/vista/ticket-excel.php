<?php
header("Content-Type: application/xls");
header('Content-Disposition: attachment; filename=ticket_' . date('Y:m:d:m:d'). ".xls");
header('Pagina: no-cache');
if($_GET){
    include('../modelo/conexion.php');
    $idReserva = $_GET["id"];
    $consulta = "SELECT * FROM reserva WHERE id = '$idReserva'";
    $respuesta = mysqli_query($conexion, $consulta);
    $reservaData = mysqli_fetch_assoc($respuesta);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir exel</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th><h4>Comprovante de Reservación</h4></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <b>A nombre:</b> <?php echo $reservaData["nombre"] . " " . $reservaData["apellidos"]; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Con DNI:</b> <?php echo $reservaData["dni"]; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Fecha de la reservación:</b> <?php echo $reservaData["fechaDeReserva"]; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Número de mesa:</b> <?php echo $reservaData["numeroMesa"]; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Pago de reserva:</b> <?php echo $reservaData["pagoReserva"]; ?>
                </td>
            </tr>
            <tr></tr>
            <tr>
                <td>Restaurante Todo Rico</td>
            </tr>
            <tr>
                <td>
                Fecha: <?php
                    date_default_timezone_set('America/Lima');
                    echo date('Y/m/d');
                ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Numeros de contacto:</b> +51 987654321
                </td>
            </tr>
        </tbody>
    </table>

</body>
</html>

<?php
}
?>