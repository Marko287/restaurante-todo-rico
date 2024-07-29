<?php
require('../../fpdf/fpdf.php');

class PDF extends FPDF
{
    private $cliente;
    private $dni;
    private $fechaReserva;
    private $numeroMesa;
    private $adelanto;
    private $fechaActual;
    private $numerosContacto;
    private $codigoBarras;

    // Método para establecer datos de la reserva
    function setReservationData($cliente, $dni, $fechaReserva, $numeroMesa, $adelanto, $fechaActual, $numerosContacto, $codigoBarras)
    {
        $this->cliente = $cliente;
        $this->dni = $dni;
        $this->fechaReserva = $fechaReserva;
        $this->numeroMesa = $numeroMesa;
        $this->adelanto = $adelanto;
        $this->fechaActual = $fechaActual;
        $this->numerosContacto = $numerosContacto;
        $this->codigoBarras = $codigoBarras;
    }

    // Cabecera de página
    function Header()
    {
        // Título
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 10, 'Comprovante de Reservacion', 0, 1, 'C');
        // Salto de línea
        $this->Ln(10);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Contenido del comprobante
    function Body()
    {
        $this->SetFont('Arial', '', 12);

        $this->Cell(0, 10, 'A nombre: ' . $this->cliente, 0, 1, 'C');
        $this->Cell(0, 10, 'Con DNI: ' . $this->dni, 0, 1, 'C');
        $this->Cell(0, 10, 'Fecha de la reservacion: ' . $this->fechaReserva, 0, 1, 'C');
        $this->Cell(0, 10, 'Numero de mesa: ' . $this->numeroMesa, 0, 1, 'C');
        $this->Cell(0, 10, 'Pago por la reserva: S/ ' . $this->adelanto, 0, 1, 'C');
        
        // Espacio para imagen de código de barras
        $this->Ln(10);
        $this->Cell(0, 10, ' ', 0, 1, 'C'); // Espacio antes de la imagen
        $this->Image($this->codigoBarras, 80, $this->GetY(), 50); // Ajusta las coordenadas y tamaño según sea necesario
        $this->Ln(40); // Ajusta el salto de línea según el tamaño de la imagen

        $this->Cell(0, 10, 'Restaurante Todo Rico', 0, 1, 'C');
        $this->Cell(0, 10, 'Fecha: ' . $this->fechaActual, 0, 1, 'C');
        $this->Cell(0, 10, 'Numeros de contacto: ' . $this->numerosContacto, 0, 1, 'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

include('../modelo/conexion.php');
$idReserva = $_GET["id"];
$consulta = "SELECT * FROM reserva WHERE id = '$idReserva'";
$respuesta = mysqli_query($conexion, $consulta);
$reservaData = mysqli_fetch_assoc($respuesta);

// Establecer datos de la reserva
$cliente = $reservaData["nombre"] . ' ' . $reservaData["apellidos"];
$dni = $reservaData["dni"];
$fechaReserva = $reservaData["fechaDeReserva"];
$numeroMesa = $reservaData["numeroMesa"];
$adelanto = $reservaData["pagoReserva"];
date_default_timezone_set('America/Lima');
$fechaActual = date('d/m/Y');  // Fecha actual
$numerosContacto = "+51 987654321";
$codigoBarras = "codigo_barras.png";

$pdf->setReservationData($cliente, $dni, $fechaReserva, $numeroMesa, $adelanto, $fechaActual, $numerosContacto, $codigoBarras);
$pdf->Body();
$pdf->Output();
?>
