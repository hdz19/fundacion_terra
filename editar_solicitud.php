<?php 
//include "../conexion.php";

session_start();
/*
if($_SESSION['Id_Rol']!= 1)
	{
		header("location: index.php");
	}
    $conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
*/

 if(!empty($_POST))
 {
    $alert='';
		if(empty($_POST['Id_Solicitud_Adjunto']) || empty($_POST['Id_Personas']) ||empty($_POST['Id_Tipo_Solicitud'])
        ||empty($_POST['Id_Estado']) ||empty($_POST['Nombre_Proyecto']) || empty($_POST['Motivo']) 
        )
		{$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{
			
            $id_solicitud              = $_POST['Id_Solicitud'];
			$id_solicitud_adjunto      = $_POST['Id_Solicitud_Adjunto'];
            $id_persona                = $_POST['Id_Personas'];
            $id_tipo_solicitud         = $_POST['Id_Tipo_Solicitud'];
            $id_estado                 = $_POST['Id_Estado'];
            $nombre_proyecto           = $_POST['Nombre_Proyecto'];
            $motivo                    = $_POST['Motivo'];
            $fecha_registro_solicitud  = date('Y/m/d');

    			//CONEXION A LA BASE DE DATOS
$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
/*
$query = mysqli_query($conexion,"SELECT * FROM tbl_ms_usuario 
													   WHERE (Usuario = '$usuario' AND Id_Usuario != $id_usuario)
													   OR (Correo_Electronico = '$correo_electronico' AND Id_Usuario != $id_usuario) ");

			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El correo o el usuario ya existe.</p>';
			}else{

				if(empty($_POST['Contraseña']))
				{
*/
                    //$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
					$sql_update = mysqli_query($conexion,"UPDATE tbl_solicitud SET Id_Solicitud='$id_solicitud',Id_Solicitud_Adjunto='$id_solicitud_adjunto',
                                                                                    Id_Personas='$id_persona',Id_Tipo_Solicitud='$id_tipo_solicitud',
                                                                                    Id_Estado='$id_estado',Nombre_Proyecto='$nombre_proyecto', 
                                                                                    Motivo= '$motivo'WHERE Id_Solicitud='$id_solicitud'");
    


                }if($sql_update){
                    
					$alert='<p class="msg_save">Usuario actualizado correctamente.</p>';
                    
                    ?> 
                    <script type="text/javascript">
                              alert('¡ Usuario actualizado correctamente !')
        
                              </script>
                                   <?php
            
            header('Location: lista_solicitud.php');
            ?> 
                   <?php
				}else{
					$alert='<p class="msg_error">Error al actualizar el usuario.</p>';
				}

                                             
            
            
        
                                            
 }                                       
//Mostrar Datos
if(empty($_REQUEST['id']))
{
	header('Location: lista_solicitud.php');
	mysqli_close($conexion);
}
$idsolicitud = $_REQUEST['id'];

$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
$sql= mysqli_query($conexion,"SELECT s.Id_Solicitud, 
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
ON s.Id_Estado = e.Id_Estado



WHERE s.Id_Solicitud= $idsolicitud ");
mysqli_close($conexion);
$result_sql = mysqli_num_rows($sql);

if($result_sql == 0){
	header('Location: lista_solicitud.php');
}else{
	$option = '';
	while ($data = mysqli_fetch_array($sql)) {
		# code...
		$idsolicitud                  = $data['Id_Solicitud'];
		$id_solicitud_adjunto         = $data['Id_Solicitud_Adjunto'];
		$id_persona                   = $data['Id_Personas'];
		$id_tipo_solicitud            = $data['Id_Tipo_Solicitud'];
		$id_estado                    = $data['Id_Estado'];
		$nombre_proyecto              = $data['Nombre_Proyecto'];
		$motivo                       = $data['Motivo'];
		$fecha_registro_solicitud     = $data['Fecha_Registro_Solicitud'];



		
		
/*
		if($id_rol == 1){
			$option = '<option value="'.$id_rol.'" select>'.$id_rol.'</option>';
		}else if($id_rol == 2){
			$option = '<option value="'.$id_rol.'" select>'.$id_rol.'</option>';	
		}else if($id_rol == 3){
			$option = '<option value="'.$id_rol.'" select>'.$id_rol.'</option>';
		}
*/

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
        <title>Editar Solicitud</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
       
        <link href="css/nuevo.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />

		
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
	
                <main>
				
	                  <section id="container">
                      <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Sistema de Solicitudes </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
           ><!-- Navbar Search-->
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
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
                    <div class="container-fluid px-4">
                        
                       
                    
                                
                        
                </main>
		
		                  <div class="form_register">
						 
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            <section id="container">
            <center>  <form  action="" method="post">

                                               
									<input type="hidden" name="Id_Solicitud" value="<?php echo $idsolicitud; ?>">
                                    <center> <h1>Editar Solicitud</h1></center>

                                    <label for="Nombre_Proyecto">Nombre del Proyecto</label>
                <input width: 50px; class="form-control" type="text" style="width: 450px" name="Nombre_Proyecto" id="Nombre_Proyecto" onKeyUP="this.value=this.value.toUpperCase();"  value="<?php echo $nombre_proyecto; ?>"
                onkeypress="return  SoloLetras(event)" maxlength="15"  >


				<label for="Motivo">Motivo de la Solicitud</label>
				<input class="form-control" style="width: 450px" type="text" onKeyUP="this.value=this.value.toUpperCase();" name="Motivo" id="Motivo"  value="<?php echo $motivo; ?>"
                onkeypress="return  SoloLetras_Espacio_uno(event)" maxlength="100" >
				
              
				

                                       <div class ="row mb-4">
                                            <div class="col-md-4">
                                            <label> Selecione su Documento</label>
                                                <select class="form-select" aria-label="Default select example" name="Id_Solicitud_Adjunto" >
                                                         <?php
                                                         $consulta="SELECT * FROM tbl_solicitud_adjunto ";
                                                         $resultado=mysqli_query($conexion,$consulta);
                                                         while($fila=$resultado->fetch_array()){
                                                             echo "<option value='".$fila['Id_Solicitud_Adjunto']."'>".$fila['enlace']."</option
                                                             >";
                                                         }
                                                         ?>
                                                         </select>
                                            </div>
                                            <div class="col-md-4">
                                            <label> Nombre del Solicitante</label>
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
                                            </div>
                                            <div class="col-md-4">
                                            <label> Tipo de Solicitud</label>
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
                                            </div>
                                            <div class="col-md-4">
                                            <label> Estado de la Solicitud </label>
                                                <select class="form-select" aria-label="Default select example" name="Id_Estado">
                                                         <?php
                                                         $consulta="SELECT * FROM tbl_estado ";
                                                         $resultado=mysqli_query($conexion,$consulta);
                                                         while($fila=$resultado->fetch_array()){
                                                             echo "<option value='".$fila['Id_Estado']."'>".$fila['Estado']."</option
                                                             >";
                                                         }
                                                        ?>
                                                </select>
                                            </div>
                                        </div>          
                            
                                        <div class="mt-4 mb-0">
                                                    <div class="d-grid">
                                                    <button type="submit" name="Actualizar Usuario" class="btn_save" >Editar</button></div>
                                                    </div>  
                                                </div> 
                                            </div> </center>     
                                    </form><p>
                                    </center>
                                       
                                    </section >
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