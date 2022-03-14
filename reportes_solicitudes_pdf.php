<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('IMG/logo-fundacion.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    $this->CELL(100);
    // Título
    $this->CELL(70,10,'Reporte de Solicitantes',0,0,'C' );
   
//se muestra fecha de imrpesion
    $this->CELL(70,15,'Fecha de Impresion:'.date("d/m/y"),0,1 );
    // Salto de línea
    $this->Ln(20);



    $this->Cell(10,10, "ID", 1, 0, 'C', 0);
    $this->Cell(35,10, "Archivo", 1, 0, 'C', 0);
    $this->Cell(35,10, "Nombre Completo", 1, 0, 'C', 0);
    $this->Cell(35,10, "Tipo de Solicitud", 1, 0, 'C', 0);
    $this->Cell(35,10, "Estado ", 1, 0, 'C', 0);
    $this->Cell(37,10, "Nombre del Proyecto", 1, 0, 'C', 0);
    $this->Cell(58,10, "Motivo ", 1, 0, 'C', 0);
    $this->Cell(35,10, "Fecha de Registros", 1, 1, 'C', 0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->CELL(0,10,utf8_decode ('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require 'cn.php';
$consulta =("SELECT s.Id_Solicitud, 
s.Id_Solicitud_Adjunto, 
s.Id_Personas, 
s.Id_Tipo_Solicitud, 
s.Id_Estado,
s.Nombre_Proyecto, 
s.Motivo,
s.Fecha_Registro_Solicitud,
a.enlace,
p.Nombre_Completo,
t.Tipo_Solicitud,
e.Estado FROM tbl_solicitud s 
 INNER JOIN tbl_solicitud_adjunto a
ON s.Id_Solicitud_Adjunto = a.Id_Solicitud_Adjunto 
INNER JOIN tbl_personas p
ON s.Id_Personas = p.Id_Personas
INNER JOIN tbl_tipo_solicitud t
ON s.Id_Tipo_Solicitud = t.Id_Tipo_Solicitud
INNER JOIN tbl_estado e
ON s.Id_Estado = e.Id_Estado");
$resultado=mysqli_query($conexion,$consulta);





$pdf = new PDF();
$pdf-> AliasNbPages();
$pdf->AddPage('landscape');
$pdf->setfillcolor(255,255,255);

$pdf->SetFont('Arial','',8);


while($row = $resultado->fetch_assoc()){
    
    $pdf->Cell(10,28, $row["Id_Solicitud"], 1, 0, 'C', 0);  
    $pdf->Cell(35,28, $pdf->Image($row["enlace"], $pdf->GetX(), $pdf->GetY(),35,28),1); 
    $pdf->Cell(35,28, $row["Nombre_Completo"], 1, 0, 'C', 0);
    $pdf->Cell(35,28, $row["Tipo_Solicitud"], 1, 0, 'C', 0);
    $pdf->Cell(35,28, $row["Estado"], 1, 0, 'C', 0);
    $pdf->Cell(37,28, $row["Nombre_Proyecto"], 1, 0, 'C', 0);
    $pdf->Cell(58,28, $row["Motivo"], 1, 0, 'C', 0);
    $pdf->Cell(35,28, $row["Fecha_Registro_Solicitud"], 1, 1, 'C', 0);


    $pdf->SetFillColor(233,229,235);//Color de Fondo
    $pdf->SetDrawColor(61,61,61);//Color de linea
/*
    $pdf->SetWidths(array(10,60,80,35));
    for($i=0;$i<count($data);$i++){

   
        $pdf->Row(array($i,$data[$i]["enlace"],ucwords(strolower(utf8_decode($data[$i]["Nombre_Completo"]))),$data[$i]["Tipo_Solicitud"]),15);
    }*/

}
$pdf->Output();
?>
