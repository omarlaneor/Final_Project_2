<?php

require_once('../fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->image('../assets/logo-university.png', 92, 8, 20); // X, Y, Tamaño
        $this->Ln(20);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 20);

        // Movernos a la derecha
        $this->Cell(60);

        // Título
        $this->Cell(70, 10, 'Tabla de permisos ', 0, 0, 'C');



        // Salto de línea

        $this->Ln(30);
        $this->SetFont('Arial', 'B', 10);
        $this->SetX(40);
        $this->Cell(20, 10, 'ID', 1, 0, 'C', 0);
        $this->Cell(55, 10, 'Email / Usuario', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'Permiso', 1, 0, 'C', 0,);
        $this->Cell(25, 10, 'Estado', 1, 1, 'C', 0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);

        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página

        $this->Cell(0, 10, '--- Omar Osorio ---', 0, 0, 'C');

        //$this->SetFillColor(223, 229,235);
        //$this->SetDrawColor(181, 14,246);
        //$this->Ln(0.5);
        // pie de pagina

    }
}
function verRol($id_rol, $conn)
{
    $query = mysqli_query($conn, "SELECT rol FROM roles WHERE id = '$id_rol'");
    $row = mysqli_fetch_array($query);
    return $row ? $row['rol'] : 'No asignada';
}

$conn = mysqli_connect("localhost", "root", "", "university");
$sql =  "SELECT maestros.id, maestros.email, maestros.id_rol, maestros.estado
FROM maestros";

$result = mysqli_query($conn, $sql);

$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
//$pdf->SetWidths(array(10, 30, 27, 27, 20, 20, 20, 20, 22));
while ($row = $result->fetch_assoc()) {

    $pdf->SetX(40);

    $pdf->Cell(20, 10, $row['id'], 1, 0, 'C', 0);
    $pdf->Cell(55, 10, $row['email'], 1, 0, 'C', 0);

    $permisoRol = verRol($row['id_rol'], $conn);
    $pdf->Cell(25, 10, $permisoRol, 1, 0, 'C', 0);

    $pdf->Cell(25, 10, $row['estado'], 1, 1, 'C', 0);


    /*   $this->Cell(20,10,'ID',1,0,'C',0);
    $this->Cell(55,10,'Email / Usuario',1,0,'C',0);
    $this->Cell(25,10,'Permiso',1,0,'C',0,);
    $this->Cell(25,10,'Estado',1,1,'C',0);
    */
}

$pdf->Output();
