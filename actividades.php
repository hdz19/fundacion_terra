<?php 


session_start();
/*
if($_SESSION['Id_Rol'] != 1)
	{
		header("location: index.php");
	}
	
*/
//CONEXION A LA BASE DE DATOS
$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

if(!empty($_POST))
	{
		/*$alert='';*/
		if( empty($_POST['Descripcion']) ||empty($_POST['Id_Solicitud '])
        ||empty($_POST['Id_Tipo_Actividad ']) 
        )
		/*{$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{*/
		
            $descripcion = $_POST['Descripcion'];
            $id_solicitud = $_POST['Id_Solicitud'];
            $id_tipo_actividad = $_POST['Id_Tipo_Actividad'];

            

            foreach($_FILES['Archivo']['tmp_name'] as $key => $tmp_name){
                if($_FILES['Archivo']['name'][$key]){
    
                    $filename = $_FILES['Archivo']['name'][$key];
                    $temporal = $_FILES['Archivo']['tmp_name'][$key];
                    $directorio = "Archivo/";
                
                   if(!file_exists($directorio)){
                       mkdir($directorio, 0777);
                   }
                   $dir = opendir($directorio);
                   $ruta= $directorio.'/'.$filename;

                   if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['limpiardatos']))
            {
                $alert='<p class="msg_save">Se limpio la Informacion.</p>';
            }
            if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['grabardatos']))
	
            {
                   if(move_uploaded_file($temporal,$ruta)){
    
                


                    $insertarSQL = "INSERT INTO tbl_actividades (Archivo, Descripcion, Id_Solicitud, Id_Tipo_Actividad)
                    VALUES ('$ruta','$descripcion','$id_solicitud','$id_tipo_actividad')";
                    $resultado =mysqli_query($conexion,$insertarSQL);
                    


				if($resultado){
					$alert='<p class="msg_save">Datos  Ingresados correctamente.</p>';
                    
				}else{
                    $alert='';
                    $alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
				}

			}
        
        }
    }
            }
}
        
            
        

?>

<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Registro Usuario</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
		<link href="css/nuevo.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
	
    
    
        
       
        <script type="text/javascript">


            //Funcion Solo Letras
            function SoloLetras(e)
            {
                key=e.keyCode || e.which;
                tecla=String.fromCharCode(key).toString();
                letras ="{ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz}";

                especiales = [8,13]
                tecla_especial =false
                for(var i in especiales){
                    if(key ==especiales[i]){
                        tecla_especial = true;
                        break;
                    }
                }
                if(letras.indexOf(tecla) == -1 && !tecla_especial)
                {
                    alert("Ingrese Solo Letras");
                    return false
                }
            }

            function SoloLetras_Espacio_uno(e)
            {
                key=e.keyCode || e.which;
                tecla=String.fromCharCode(key).toString();
                letras ="{ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz}";

                especiales = [8,13,32]
                tecla_especial =false
                for(var i in especiales){
                    if(key ==especiales[i]){
                        tecla_especial = true;
                        break;
                    }
                }
                if(letras.indexOf(tecla) == -1 && !tecla_especial)
                {
                    alert("Ingrese Solo Letras");
                    return false
                }

            }
            function pulsar(e) {
              tecla=(document.all) ? e.keyCode : e.which;
              if(tecla==32) return false;
            }
            //Funcion Mostrar Contraseña
            function mostrarPassword(){
		var cambio = document.getElementById("inputPassword");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 
    </script> 
    </head>
    <body class="bg-primary">
    
        <div id="container">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Sistema de Solicitudes </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
           ><!-- Navbar Search-->
            <!-- Navbar-->
            <ul>
                <li><a class="navbar-brand ps-3" href="tipo_solicitud.php">Tipos Solicitudes </a></li>
            </ul>
            <ul>
                <li><a class="navbar-brand ps-3" href="estado_solicitud.php">Estado </a></li>
            </ul>
            <ul >
                <li class="nav-item dropdown">
                    <a class="navbar-brand ps-3" href="#" 
                     data-bs-toggle="dropdown"> Solicitudes </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="solicitud.php">Ingresar solicitudes</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="mantenimiento.php">Mantenimiento</a></li> 
                    </ul>
                </li>
            </ul>
            <ul>
                <li><a class="navbar-brand ps-3" href="tipo_actividad.php">Tipo Actividades</a></li>
            </ul> 
            <ul>
                <li class="nav-item dropdown">
                    <a class="navbar-brand ps-3" href="#" 
                     data-bs-toggle="dropdown"> Actividades </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="actividades.php">Ingresar actividades </a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="mantenimiento.php">Mantenimiento</a></li> 
                    </ul>
                </li>
            </ul>  
            <ul>
            </ul>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"> </i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Ajustes</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="login.php">Cerrar sesión</a></li> 
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Configuración</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Panel de Control
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Diseños
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.php">Navegación estática</a>
                                    <a class="nav-link" href="layout-sidenav-light.php">Luz Sidenav</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Paginas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    <?php 
				if($_SESSION['Id_Rol'] == 1){
			 ?>
				<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">

					Usuarios
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
					
                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                    
                      <nav class="sb-sidenav-menu-nested nav">
						<li><a class="nav-link" href="registro_usuario.php">Nuevo Usuario</a></li>
						<li><a class="nav-link" href="lista_usuarios.php">Lista de Usuarios</a></li>
                </nav>
                </div>
					
				
			<?php } ?>





                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Autentificacion
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.php">Acceso</a>
                                            <a class="nav-link" href="usuario.php">Registro</a>
                                            <a class="nav-link" href="password.php">Recuperar Contraseña</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.php">401 Page</a>
                                            <a class="nav-link" href="404.php">404 Page</a>
                                            <a class="nav-link" href="500.php">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Complementos</div>
                            <a class="nav-link" href="Graficas.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Graficas
                            </a>
                            <a class="nav-link" href="tabla.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
             
                </ol>                        
                        
                </main>
                                   
                                    <form action="" method="post" enctype="multipart/form-data">
                                   
                                    <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>  
                                    <table border="1">              
                                    <tr>
                                    <td colspan="10"><label>Mantenimiento de Actividades</label></td>
                                </tr>               
                                <tr>
                                    <td colspan="10" ><label>Registrar Información </label></td></tr>

                                <tr>
                                
                    
                                <td colspan="3" >    <label for="Archivo"> Seleccione Archivo</label>		              
                            <input type="file" name="Archivo[]" id="Archivo[]" class="form__file" multiple="" required >

                            </td>
                          
                        
                            <td colspan="3" >  <label for="Descripcion"> Descripcion </label>
				            <input class="form-control" type="text" onKeyUP="this.value=this.value.toUpperCase();" 
                            name="Descripcion" id="Descripcion" placeholder="Descripcion de archivo" onkeypress="return  SoloLetras_Espacio_uno(event)" maxlength="50" >
                            </td>
                          
                    </tr>    
                     
                   
                    <tr>
      
                    <td colspan="3" >   <label> Solicitud </label>
                            <select class="form-select" aria-label="Default select example" name="Id_Solicitud">
                                <?php
                                    $consulta="SELECT * FROM tbl_solicitud ";
                                    $resultado=mysqli_query($conexion,$consulta);
                                        while($fila=$resultado->fetch_array()){
                                            echo "<option value='".$fila['Id_Solicitud']."'>".$fila['Nombre_Proyecto']."</option
                                                >";
                                            }
                                        ?>
                                </select>
                     
                                </td>
                                <td colspan="4" >  <label> Tipo de Actividad </label>
                            <select class="form-select" aria-label="Default select example" name="Id_Tipo_Actividad">
                                <?php
                                    $consulta="SELECT * FROM tbl_tipo_actividad ";
                                    $resultado=mysqli_query($conexion,$consulta);
                                        while($fila=$resultado->fetch_array()){
                                            echo "<option value='".$fila['Id_Tipo_Actividad']."'>".$fila['Tipo_Actividad']."</option
                                                             >";    
                                        }
                                ?>
                            </select>
                     
                            </td>
                            
                          </tr>   
                          


                          <td colspan="10" align="center">
                                        <div class="btn-group">
                                            <input type="submit" style="background-color:#5CB8E5" class="btn btn-default" value="Nuevo" name="limpiardatos" > 
                                            <input type="submit" style="background-color:#91C66C" class="btn btn-default" value="Enviar" name="grabardatos" >
                                            
                                        </div>
                                   </td>
                                        
                                             <tr><td colspan="10"><label>Listado de Actividades</label></td></tr>
                                             <tr>
<td colspan="10" align="center">
<div class="btn-group">
 
                     <a type="submit" href="reporte_actividades_pdf.php"  style="background-color:#B22222" class="btn_save">PDF</a>
                    <a type="submit" href="buscar_actividades.php"  style="background-color:#008080" class="btn_save">Buscar</a>
              
                </div>
                    </td>
                </tr>  
                                             
<tr><td><label>Codigo</label></td>
	<td><label>Archivo</label></td>
    <td><label> Descripcion</label></td>
    <td><label>Nombre del Proyecto  </label></td>
    <td><label>Tipo Actividad  </label></td>
    <td><label>Acciones    </label></td>
    
	
</tr>

<?php 
			//Paginador
			$sql_registe = mysqli_query($conexion,"SELECT COUNT(*) as total_registro FROM tbl_actividades  ");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 5;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conexion,"SELECT a.Id_Actividad, 
          
           a.Archivo, 
           a.Descripcion, 
          
            s.Nombre_Proyecto,
            ta.Tipo_Actividad
            FROM tbl_actividades a
            
          
            INNER JOIN tbl_solicitud s
			ON a.Id_Solicitud = s.Id_Solicitud

            INNER JOIN tbl_tipo_actividad ta
			ON a.Id_Tipo_Actividad = ta.Id_Tipo_Actividad
             ORDER BY a.Id_Actividad ASC LIMIT $desde,$por_pagina 
				");

			mysqli_close($conexion);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
            
				<tr>
					<td><?php echo $data["Id_Actividad"]; ?></td>
                    <td><img src="<?php echo $data["Archivo"]; ?>" width="120"  srcset=""></td>" 
				
                    <td><?php echo $data["Descripcion"]; ?></td>
				
                    <td><?php echo $data["Nombre_Proyecto"]; ?></td>
				
                    <td><?php echo $data["Tipo_Actividad"]; ?></td>
				
                    <td>
						<a class="link_edit" href="actualizar_actividades.php?id=<?php echo $data["Id_Actividad"]; ?>">Editar</a>

				
						
						<a class="link_delete" href="eliminar_confirmar_actividades.php?id=<?php echo $data["Id_Actividad"]; ?>">Eliminar</a>
				
						
					</td>
                    
                    
				
				
				</tr>
                
		<?php 
				}

			}
		 ?>
										
										</thead>
                                    </tbody>
                                </table>
								<div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>
</center>  		
                                    </form><p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div> <br>
            
  	
			                                
                                    
                      

                  
            
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        
    </body>
</html>