<?php

require_once('../fpdf/fpdf.php');

class PDF extends FPDF
{

    function Header()
    {
        $this->image('../assets/logo-university.png', 220, 4, 30); // X, Y, Tamaño
        $this->Ln(30);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 20);

        // Movernos a la derecha
        $this->Cell(60);

        // Título
        $this->Cell(100, 20, 'Tabla de Maestros ', 0, 0, 'C');
        // Salto de línea

        $this->Ln(30);
        $this->SetFont('Arial', 'B', 10);
        $this->SetX(10);
        $this->Cell(60, 10, 'Email', 1, 0, 'C', 0);
        $this->Cell(40, 10, 'Nombres', 1, 0, 'C', 0,);
        $this->Cell(40, 10, 'Apellidos', 1, 0, 'C', 0);
        $this->Cell(40, 10, 'Dirección', 1, 0, 'C', 0);
        $this->Cell(40, 10, 'Fecha', 1, 0, 'C', 0);
        $this->Cell(40, 10, 'Clase', 1, 1, 'C', 0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);

        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página

        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');

        //$this->SetFillColor(223, 229,235);
        //$this->SetDrawColor(181, 14,246);
        //$this->Ln(0.5);
    }
}

function getName($id_clase, $conn)
{
    $query = mysqli_query($conn, "SELECT clase FROM clases WHERE id = '$id_clase'");
    $row = mysqli_fetch_array($query);
    return $row ? $row['clase'] : 'No asignada';
}

$conn = mysqli_connect("localhost", "root", "", "university");
mysqli_set_charset($conn, 'utf8');
$sql = "SELECT maestros.id, maestros.name, maestros.lastname, maestros.email, maestros.direccion, maestros.fecha, maestros.id_clase FROM maestros";
$result = mysqli_query($conn, $sql);

$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage('L');
$pdf->SetFont('Arial', '', 10);

while ($row = $result->fetch_assoc()) {
    $pdf->SetX(10);

    $pdf->Cell(60, 10, $row['email'], 1, 0, 'C', 0);
    $pdf->Cell(40, 10, $row['name'], 1, 0, 'C', 0);
    $pdf->Cell(40, 10, $row['lastname'], 1, 0, 'C', 0);
    $pdf->Cell(40, 10, $row['direccion'], 1, 0, 'C', 0);
    $pdf->Cell(40, 10, $row['fecha'], 1, 0, 'C', 0);

    $nombreClase = getName($row['id_clase'], $conn);

    $pdf->Cell(40, 10, $nombreClase, 1, 1, 'C', 0);
}

$pdf->Output();
