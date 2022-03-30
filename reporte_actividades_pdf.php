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
    $this->CELL(70,15,'Fecha de Impresion:'.date('Y-m-d/ H:i'),0,1 );

   

    
    // Salto de línea
    $this->Ln(20);



    $this->Cell(10,10, "ID", 1, 0, 'C', 0);
    $this->Cell(40,10, "Archivo", 1, 0, 'C', 0);
    $this->Cell(60,10, "Descripcion ", 1, 0, 'C', 0);
    $this->Cell(50,10, "Nombre del Proyecto", 1, 0, 'C', 0);
    $this->Cell(58,10, "Tipo Actividad ", 1, 1, 'C', 0);
  
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
$consulta =("SELECT a.Id_Actividad, 
          
a.Archivo, 
a.Descripcion, 

 s.Nombre_Proyecto,
 ta.Tipo_Actividad
 FROM tbl_actividades a
 

 INNER JOIN tbl_solicitud s
 ON a.Id_Solicitud = s.Id_Solicitud

 INNER JOIN tbl_tipo_actividad ta
 ON a.Id_Tipo_Actividad = ta.Id_Tipo_Actividad");
$resultado=mysqli_query($conexion,$consulta);





$pdf = new PDF();
$pdf-> AliasNbPages();
$pdf->AddPage('landscape');
$pdf->setfillcolor(255,255,255);

$pdf->SetFont('Arial','',8);


while($row = $resultado->fetch_assoc()){
    
    $pdf->Cell(10,28, $row["Id_Actividad"], 1, 0, 'C', 0);  
    $pdf->Cell(40,28, $pdf->Image($row["Archivo"], $pdf->GetX(), $pdf->GetY(),40,28),1); 
    $pdf->Cell(60,28, $row["Descripcion"], 1, 0, 'C', 0);
    $pdf->Cell(50,28, $row["Nombre_Proyecto"], 1, 0, 'C', 0);
    $pdf->Cell(58,28, $row["Tipo_Actividad"], 1, 1, 'C', 0);
 


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
