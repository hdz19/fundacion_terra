<?php
session_start();
if( isset($_SESSION['Usuario']))
{
    $conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
    $resultclave=mysqli_query($conexion,"SELECT Contraseña FROM `tbl_ms_usuario` WHERE `Usuario`='".$_SESSION['Usuario']."'");
    $sqlrclave=$resultclave->fetch_array();
    $resultclave2=mysqli_query($conexion,"SELECT Contraseña FROM `tbl_ms_hist_contraseña` WHERE `ID_Usuario`='".$_SESSION['Id_Usuario']."' order by Fecha_Creacion desc limit 0,1");  
   //print_r($resultclave2->fetch_array());
    $sqlrclave2=$resultclave2->fetch_array();
    if(isset($sqlrclave) && isset($sqlrclave2)){
        if($sqlrclave['Contraseña']==$sqlrclave2['Contraseña']){
            header("location:http://localhost/fundacion_terra/NuevaPassword.php?id=".$_SESSION['Id_Usuario']."&t=1");
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
        <title>Fundación Terra</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Bienvenido</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
           <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        

                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li> 
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
                                Contenido Informativo
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Gestiones
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
                        <li><a class="nav-link" href="lista_bitacora.php">Lista de Bitacora</a></li>
                        <li><a class="nav-link" href="NuevaPassword.php?id=<?php echo $_SESSION['Id_Usuario'];?>">Cambiar Contraseña</a></li>
                        <li><a class="nav-link" href="IngresoPreguntas.php">Preguntas Secretas</a></li>
                </nav>
                </div>
					
				
			<?php } ?>
                                    
                                   
                                    
                                </nav>
                            </div>
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small"></div>
                        
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><img src="IMG/logo-fundacion.png" ></h1>
                        <ol class="breadcrumb mb-4">
                            
                        </ol>
                    
                           
                        
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Su sitio web 2022</div>
                            <div>
                                <a href="#">Política de privacidad</a>
                                &middot;
                                <a href="#">Terminos &amp; Condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
       

    </body>
</html>
<?php
}

else{
    echo "<h1> NO TIENE PERMISO </h1>";
}
?> 