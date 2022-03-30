<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('IMG/logo-fundacion.png',10,20,33);
    // Arial bold 15
    $this->SetFont('Arial','B',10);
    // Movernos a la derecha
    $this->CELL(100);
    // Título
    $this->CELL(1,20,'Reporte de Tipo de Solicitudes',0,0,'C' );
    $this->SetXY(130,20);
//se muestra fecha de imrpesion
    $this->CELL(50,20,'Fecha de Impresion:'.date('Y-m-d/ H:i:s'),0,1 );

   

    
    // Salto de línea
    $this->Ln(20);



    $this->Cell(45,10, "ID", 1, 0, 'C', 0);
    $this->Cell(45,10, "Tipo de Solicitud", 1, 1, 'C', 0);
    
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
$consulta =("SELECT Id_Tipo_Solicitud ,Tipo_Solicitud
 FROM tbl_tipo_solicitud  ");


$resultado=mysqli_query($conexion,$consulta);





$pdf = new PDF();
$pdf-> AliasNbPages();
$pdf->AddPage('P');
$pdf->setfillcolor(255,255,255);

$pdf->SetFont('Arial','',8);


while($row = $resultado->fetch_assoc()){
    
    $pdf->Cell(45,10, $row["Id_Tipo_Solicitud"], 1, 0, 'C', 0);  

    $pdf->Cell(45,10, $row["Tipo_Solicitud"], 1, 1, 'C', 0);
    


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
