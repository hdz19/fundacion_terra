<?php 
//include "../conexion.php";

session_start();
if($_SESSION['Id_Rol']!= 1)
	{
		header("location: index.php");
	}
    $conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");


    if(!empty($_POST))
	{
		$alert='';
		if(  empty($_POST['Estado']) >= 1 )
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{
            $id_estado = ($_POST['Id_Estado']);
			$estado = $_POST['Estado'];
    			//CONEXION A LA BASE DE DATOS
$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");


                    //$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
					$sql_update = mysqli_query($conexion,"UPDATE tbl_estado SET Id_Estado='$id_estado',Estado='$estado'
                     WHERE Id_Estado='$id_estado'");
               if($sql_update){
                    
					$alert='<p class="msg_save">Estado actualizado correctamente.</p>';
                    ?> 
                    <script type="text/javascript">
                              alert('¡ Estado actualizado correctamente !')
        
                              </script>
                                   <?php
            
            header('Location: estado_solicitud.php');
               
           
            ?> 
                   <?php
				}else{
					$alert='<p class="msg_error">Error al actualizar el estado.</p>';
				}

                                             
            
            }
        }
                                            
                                       
//Mostrar Datos
if(empty($_REQUEST['id']))
{
	header('Location: estado_solicitud.php');
	mysqli_close($conexion);
}
$id_estado = $_REQUEST['id'];

$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
$sql= mysqli_query($conexion,"SELECT Id_Estado, Estado
								FROM tbl_estado 
							
								WHERE Id_Estado= $id_estado ");
mysqli_close($conexion);
$result_sql = mysqli_num_rows($sql);

if($result_sql == 0){
	header('Location: estado_solicitud.php');
}else{
	$option = '';
	while ($data = mysqli_fetch_array($sql)) {
		# code...
		$id_estado                = $data['Id_Estado'];
		$estado               = $data['Estado'];
	
	
		
	


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
        <title>Actualizar</title>
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
                

		                  <div class="form_register">
						
		
            <section id="container">
            <center>  <form  action="" method="post">                                 
									<input type="hidden" name="Id_Estado" value="<?php echo $id_estado; ?>">
                                    

                                    <center> <h1>Mantenimiento</h1></center>

                               

                          
                            <tr>                    
                              <td>  <input width: 50px; class="form-control" type="text" style="width: 450px" name="Estado" id="Estado" onKeyUP="this.value=this.value.toUpperCase();" placeholder="Tipo Solicitud" value="<?php echo $estado; ?>"
                onkeypress="return  SoloLetras(event)" maxlength="15"  ></td>

                                                 
                                           <td colspan="4" align="center">
                                           <div class="btn-group">
                                                   
                                                    <button type="submit" name="Actualizar Estado" class="btn_save" >Actualizar </button></div>
                                                    
                                                  
                                               
                                            </div>
                                            </td>
                                              </tr>    
                                            
                                    </tbody>
                                
                                    </form><p>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>

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