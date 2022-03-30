<?php
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

date_default_timezone_set("America/Tegucigalpa");
$fecha = date("d/m/Y");
$filename = "Reporte-Solicitudes_" . $fecha. ".xls";


header("Content-Type: application/xls charset=latin1");
header("Content-Disposition:  attachment; filename=". $filename. "");


?>
                             <table width ="100%"style="text-align: center;" border="1" cellpadding=1 cellspacing=1> 
                             <center><img src="IMG/logo-fundacion.png" ></center>
                               <td colspan="8" bgcolor="F0E68C"><center><strong>Reporte de Solicitudes</strong></center></td>
                               
									
                                    <tr bgcolor= #FFA500">
                                    <th>ID </th>		                        
                                    <th>Archivo</th>	    
                                     <th>Nombre Completo</th>
                                    <th>Tipo de Solicitud</th>
                                    <th>Estado</th>
                                    <th>Nombre Proyecto</th>
                                    <th>Motivo</th>
                                    <th>Fecha de Registro </th>
                                    
                                    </tr>
                  <?php 
                  
                  
                  $resultado=mysqli_query($conexion,$consulta);
                  while($row=mysqli_fetch_assoc($resultado)){?>
                <tr>
					<td><?php echo $row["Id_Solicitud"]; ?></td>
          <td> <?php echo $row["enlace"]; ?></td>
					<td><?php echo $row["Nombre_Completo"]; ?></td>
					<td><?php echo $row["Tipo_Solicitud"]; ?></td>
					<td><?php echo $row["Estado"]; ?></td>
					<td><?php echo $row["Nombre_Proyecto"] ?></td>
					<td><?php echo $row["Motivo"] ?></td>
					<td><?php echo $row["Fecha_Registro_Solicitud"] ?></td>
				</tr>
           <?php
                  }mysqli_free_result($resultado);?>
                  </table>