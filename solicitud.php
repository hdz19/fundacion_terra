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
		$alert='';
		if(empty($_POST['Id_Personas  ']) || empty($_POST['	Id_Tipo_Solicitud']) ||empty($_POST['Id_Estado'])
        ||empty($_POST['Nombre_Proyecto']) ||empty($_POST['Motivo']) 
        )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{
  
            $id_persona = $_POST['Id_Personas'];
            $id_tipo_solicitud = $_POST['Id_Tipo_Solicitud'];
            $id_estado = $_POST['Id_Estado'];
            $nombre_proyecto = $_POST['Nombre_Proyecto'];
            $motivo = $_POST['Motivo'];
            $fecha_registro_solicitud = datetime("Y-m-d\TH-i");
			

			
           
            if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['limpiardatos']))
	{
		$alert='<p class="msg_save">Se limpio la Informacion.</p>';
	}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['grabardatos']))
	
	{
	$sqlgrabar = "INSERT INTO tbl_solicitud (Id_Personas,Id_Tipo_Solicitud,
    Id_Estado,Nombre_Proyecto,Motivo,Fecha_Registro_Solicitud)
    VALUES ('$id_persona','$id_tipo_solicitud','$id_estado','$nombre_proyecto',
    '$motivo','$fecha_registro_solicitud')";

if(mysqli_query($conexion,$sqlgrabar))
{
	$alert='<p class="msg_save">Tipo de Solicitud Ingresado correctamente.</p>';
}else 
{
	echo "Error: " .$sql."<br>".mysql_error($conexion);
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
           <!-- Navbar Search-->
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
                <main>
                <link href="css/nuevo.css" rel="stylesheet" />
                <link href="http://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
                   <nav class="menu">   
                                  
                     </nav>
                     <div class="contenedor">
                     
                     </div>
                
                </main>
                
             
                                   
                                    <form action="" method="post">
                                    
                                    <link href="css/nuevo.css" rel="stylesheet" />
                                    <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>       

                <table border="1">


                                <tr>
                                    <td colspan="10"><label>Mantenimiento de Solicitud</label></td>
                                </tr>               
                                <tr>
                                    <td colspan="10" ><label>Registrar Solicitud </label></td></tr>

                                <tr>
                                

                    
                                    <td colspan="3" ><label> Nombre del Solicitante</label>
                    
                            
                                    
                                         <select class="form-select" aria-label="Default select example" name="Id_Personas">
                                <?php
                                    $consulta="SELECT * FROM tbl_personas ";
                                    $resultado=mysqli_query($conexion,$consulta);
                                        while($fila=$resultado->fetch_array()){
                                            echo "<option value='".$fila['Id_Personas']."'>".$fila['Nombre_Completo']."</option
                                                >";
                                            }
                                        ?>
                                </select>
                        </td>
                    
                    
                         <td colspan="2" > <label> Tipo de Solicitud</label>
                        <select class="form-select" aria-label="Default select example" name="Id_Tipo_Solicitud">
                                <?php
                                    $consulta="SELECT * FROM tbl_tipo_solicitud ";
                                    $resultado=mysqli_query($conexion,$consulta);
                                        while($fila=$resultado->fetch_array()){
                                            echo "<option value='".$fila['Id_Tipo_Solicitud']."'>".$fila['Tipo_Solicitud']."</option
                                                             >";    
                                        }
                                ?>
                            </select>
                       
                    
                    </td>
                    <td colspan="2" ><label> Selecione el estado de solicitud</label>
                   
                     <select class="form-select" aria-label="Default select example" name="Id_Estado">
                                    <?php
                                        $consulta="SELECT * FROM tbl_estado ";
                                        $resultado=mysqli_query($conexion,$consulta);
                                        while($fila=$resultado->fetch_array()){
                                             echo "<option value='".$fila['Id_Estado']."'>".$fila['Estado']."</option>";
                                            }
                                    ?>
                                </select>
                                </td>
                    
                       
                        
                    </tr>
                   
                    <tr>
                    <td colspan="3"><label for="Motivo">Motivo de la Solicitud</label>
                        <input class="form-control" type="text" onKeyUP="this.value=this.value.toUpperCase();" 
                        name="Motivo" id="Motivo" placeholder=" Motivo" onkeypress="return  SoloLetras_Espacio_uno(event)" maxlength="100" >
                        </td>
                         
                    
                        <td colspan="3" > <label for="Nombre_Proyecto">Nombre del Proyecto</label>
                        
                        <div class="col-md-12">
                     <input class="form-control" type="text" onKeyUP="this.value=this.value.toUpperCase();" 
                                name="Nombre_Proyecto" id="Nombre_Proyecto" placeholder="El proyecto se llamará"
                                onkeypress="return  SoloLetras_Espacio_uno(event)" maxlength="100" >
                               
                                      

                                </td>
                        </tr>         

                <div class ="row mb-4">
                    <div class="col-md-12"> 
                                           
                        <input  type="hidden" type="datetime-local" name="Fecha_Registro_Solicitud" step="1" min="2013-01-01T00:00Z" max="2013-12-31T12:00Z" value="<?php echo date("Y-m-d\TH-i");?>">
                    </div>
                </div>
                                </tr>	
                                            
                                </tr>

                                <tr>
                                    <td colspan="10" align="center">
                                        <div class="btn-group">
                                            <input type="submit" style="background-color:#5CB8E5" class="btn btn-default" value="Limpiar" name="limpiardatos" > 
                                            <input type="submit" style="background-color:#91C66C" class="btn btn-default" value="Enviar" name="grabardatos" >
                                             
                                            
                                        </div>
                                   </td>
                                </tr>


                                             


<tr><td colspan="10"><label>Listado Solicitud </label></td></tr>
<tr>
<td colspan="10" align="center">
<div class="btn-group">
 
                     <a type="submit" href="reportes_solicitudes_pdf.php"  style="background-color:#B22222" class="btn_save">PDF</a>
                    <a type="submit" href="buscar_solicitud.php"  style="background-color:#008080" class="btn_save">Buscar</a>
              
                </div>
                    </td>
                </tr>  

<tr><td><label>Codigo</label></td>
<td><label>Nombre Completo</label></td>
	<td><label>Tipo de Solicitud </label></td>
    <td><label>Estado </label></td>
    <td><label>Nombre Proyecto</label></td>
    <td><label>Motivo </label></td>
    <td><label>Fecha Registro</label></td>
    <td><label>Acciones</label></td>

    
	
</tr>

<?php 
			//Paginador
			$sql_registe = mysqli_query($conexion,"SELECT COUNT(*) as total_registro FROM tbl_solicitud  ");
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

			$query = mysqli_query($conexion,"SELECT s.Id_Solicitud, 
          
            s.Id_Personas, 
            s.Id_Tipo_Solicitud, 
            s.Id_Estado,
            s.Nombre_Proyecto, 
            s.Motivo,
            s.Fecha_Registro_Solicitud,
            
            p.Nombre_Completo,
            t.Tipo_Solicitud,
            e.Estado FROM tbl_solicitud s 
            
            INNER JOIN tbl_personas p
			ON s.Id_Personas = p.Id_Personas
            INNER JOIN tbl_tipo_solicitud t
			ON s.Id_Tipo_Solicitud = t.Id_Tipo_Solicitud
            INNER JOIN tbl_estado e
			ON s.Id_Estado = e.Id_Estado
             ORDER BY s.Id_Solicitud ASC LIMIT $desde,$por_pagina 
				");

			mysqli_close($conexion);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
            
				<tr>
                <td><?php echo $data["Id_Solicitud"]; ?></td>
					
					<td><?php echo $data["Nombre_Completo"]; ?></td>
					<td><?php echo $data["Tipo_Solicitud"]; ?></td>
					<td><?php echo $data["Estado"]; ?></td>
					<td><?php echo $data["Nombre_Proyecto"] ?></td>
					<td><?php echo $data["Motivo"] ?></td>
					<td><?php echo $data["Fecha_Registro_Solicitud"] ?></td>
                    <td>
						<a class="link_edit" href="actualizar_solicitud.php?id=<?php echo $data["Id_Solicitud"]; ?>">Editar</a>

					<?php if($data["Id_Solicitud"] != 1){ ?>
						|
						<a class="link_delete" href="eliminar_solicitud.php?id=<?php echo $data["Id_Solicitud"]; ?>">Eliminar</a>
					<?php } ?>
						
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