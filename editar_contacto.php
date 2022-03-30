<?php 
//include "../conexion.php";

session_start();
/*if($_SESSION['Id_Rol']!= 1)
	{
		header("location: index.php");
	}*/
    $conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");


 if(!empty($_POST))
 {
     $alert='';
    if (empty($_POST['Id_Personas']) >= 1 && empty($_POST['Id_Tipo_Contacto']) >= 1 )
   {
       $alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
   }else{

 
       //Campos TBL_MS_USUARIO
       $id_contacto = ($_POST['Id_Contacto']);
       $id_personas = trim($_POST['Id_Personas']);
       $id_tipo_contacto = trim($_POST['Id_Tipo_Contacto']);
      
    			//CONEXION A LA BASE DE DATOS
$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

$query = mysqli_query($conexion,"SELECT * FROM tbl_contacto
													   WHERE (Id_Personas = '$id_personas' AND Id_Contacto != $id_contacto)
													   OR (Id_Tipo_Contacto = '$id_tipo_contacto' AND Id_Contacto 
                                                       != $id_contacto) ");

			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El id persona y id tipo contacto ya existe.</p>';
			
                    //$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
					$sql_update = mysqli_query($conexion,"UPDATE tbl_contacto SET 
                    Id_Contacto='$id_contacto',Id_Personas='$id_personas', Id_Tipo_Contacto='$id_tipo_contacto'
                    WHERE Id_Usuario='$id_usuario'");

                }if($sql_update){
                    $sql_update = mysqli_query($conexion,"UPDATE tbl_contacto SET 
                    Id_Contacto='$id_contacto',Id_Personas='$id_personas', Id_Tipo_Contacto='$id_tipo_contacto'
                    WHERE Id_Usuario='$id_usuario'");
					$alert='<p class="msg_save">Contacto actualizado correctamente.</p>';
                    
                    ?> 
                    <script type="text/javascript">
                              alert('¡ Contacto actualizado correctamente !')
        
                              </script>
                                   <?php
            
            header('Location: lista_contacto.php');
            ?> 
                   <?php
				}else{
					$alert='<p class="msg_error">Error al actualizar el contacto.</p>';
				}

                                             
            
            }
        }
                                            
                                     
//Mostrar Datos
if(empty($_REQUEST['id']))
{
	header('Location: lista_contacto.php');
	mysqli_close($conexion);
}
$idcontacto = $_REQUEST['id'];

$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
$sql= mysqli_query($conexion,"SELECT u.Id_Contacto,u.Id_Personas, u.Id_Tipo_Contacto
								FROM tbl_contacto u
								WHERE Id_Contacto= $idcontacto ");
mysqli_close($conexion);
$result_sql = mysqli_num_rows($sql);

if($result_sql == 0){
	header('Location: lista_contacto.php');
}else{
	$option = '';
	while ($data = mysqli_fetch_array($sql)) {
		# code...
		$idcontacto            = $data['Id_Contacto'];
		$id_personas           = $data['Id_Personas'];
		$id_tipo_contacto      = $data['Id_Tipo_Contacto'];
	
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
        <title>Registro de Usuario</title>
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
			cambio.type = "pas  sword";
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
            
				<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">

					Usuarios
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
					
                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                    
                      <nav class="sb-sidenav-menu-nested nav">
						
						<li><a class="nav-link" href="lista_contacto.php">Lista de Contacto</a></li>
                </nav>
                </div>
					
				







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
                        
                  <div class="form_register">
						 
			<hr>

            <form action="" method="post" >
                    <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>   
                               
                    <center> <h1> Contactos </h1></center>
                    <a href = "lista_contacto.php"> Atras </a> 
                    <div>
                        <center> <h3> Editar contacto </h3>
                    <div class ="row mb-4">
                        <div class="col-md-12">
                            <h5> Id personas </h5>
                            <input width: 50px; class="form-control" type="text" style="width: 450px" 
                            name="Id_Personas" id="Id_Personas" placeholder="Id_Persona" value="<?php echo $id_personas; ?>"
                            maxlength="15" >
                            </div>
                        </div>
                    <div>
                    <div class ="row mb-4">
                        <div class="col-md-12">
                            <h5> Id Tipo Contacto </h5>
                            <input width: 50px; class="form-control" type="text" style="width: 450px" 
                            name="Id_Tipo_Contacto" id="Id_Tipo_Contacto" placeholder="Id_Tipo_Contacto" value="<?php echo $id_personas; ?>"
                            maxlength="15" >
                        </div>
                    <div>
                   
                        
                   <button  type="submit" name="orden" class="btn_save" > Actualizar Contacto </button>
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