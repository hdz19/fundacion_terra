<?php 


session_start();
if($_SESSION['Id_Rol'] != 1){

	header("location: index.php");

}
	

//CONEXION A LA BASE DE DATOS
$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

if (isset($_POST['crear_persona'])) {
    if (strlen($_POST['Id_Tipo_Persona']) >= 1 && strlen($_POST['Id_Division_Empresa']) >= 1 && 
     strlen($_POST['Nombre_Completo']) >= 1  &&   strlen($_POST['Identidad']) >= 1 &&   strlen($_POST['Genero']) >= 1  
       
     &&  strlen($_POST['Creado_Por']) >= 1  &&  strlen($_POST['Modificado_Por']) >= 1  )
    {
	    
	    //Campos TBL_PERSONAS
        $id_tipo_persona     = trim($_POST['Id_Tipo_Persona']);
	    $id_division_empresa = trim($_POST['Id_Division_Empresa']);
        $nombre_completo     = ($_POST['Nombre_Completo']); 
		$identidad           = $_POST['Identidad'];
		$genero              = $_POST['Genero'];
		$fecha_nac           = $_POST['Fecha_Nac'];
		$creado_por          = $_POST['Creado_Por'];
		$fecha_creacion      = date('Y/m/d');
		$modificado_por      = $_POST['Modificado_Por'];
		$fecha_mod           = $_POST['Fecha_Mod'];
		

        
        //PROCESO DE INSERT DE LA TABLA: tbl_ms_usuario
	    $consulta="INSERT INTO tbl_personas (Id_Tipo_Persona,Id_Division_Empresa,Nombre_Completo,Identidad,	Genero,
        Fecha_Nac,Creado_Por,Fecha_Creacion,Modificado_Por,Fecha_Mod)
        VALUES ('$id_tipo_persona','$id_division_empresa','$nombre_completo','$identidad','$genero','$fecha_nac',
	    '$creado_por','$fecha_creacion','$modificado_por','$fecha_mod')";


        //VERIFICAR QUE EL USUARIO NO SE REPITA EN LA BASE DE DATOS
        $verificar_personas=mysqli_query($conexion, "SELECT * FROM tbl_personas WHERE Identidad='$identidad'");


        if(mysqli_num_rows($verificar_personas) > 0){
         
            ?> 
	    	<script type="text/javascript">
                alert('¡ Esta persona ya esta registrada, Intenta con otra diferente !')
            </script>
            
            <?php
    
            //header('Location: lista_usuarios.php'); falta crear lista_personas.php
            
            ?> 
                      
           
          
           
          exit();
        }

      
    
     
        <?php
	} 

    }   else {
        ?>    
  
        <script type="text/javascript">
                  alert('¡ Por favor completa los campos!')
                  </script>
          <?php      
    }
} //TIRA ERROR SI LO QUITO



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
						<li><a class="nav-link" href="registro_personas.php">Nueva Persona</a></li>
						<li><a class="nav-link" href="lista_usuarios.php">Lista de Personas</a></li>
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
                        <h1 class="mt-4">Fundacion Terra</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Panel de Control</li>
                        </ol>
                    
                           
                            
                       
                            
                        
                </main>
                                   
                                    <form action="" method="post">
                                                                   
                                   <center> <h1>Crear Persona</h1></center>




                                   <div class ="row mb-4">
                                            <div class="col-md-8">
                                                <label> Selecione su ID de tipo persona</label>
                                                <select class="form-select" aria-label="Default select example" name="Id_Tipo_Persona">
                                                         <?php
                                                         $consulta="SELECT * FROM tbl_tipo_persona ";
                                                         $resultado=mysqli_query($conexion,$consulta);
                                                         while($fila=$resultado->fetch_array()){
                                                             echo "<option value='".$fila['Id_Tipo_Persona']."'>".$fila['Tipo_Persona']."</option
                                                             >";
                                                         }
                                                         ?>
                                                         </select>
                                            </div>
                                            </div>

                                            
                                            <div class ="row mb-4">
                                            <div class="col-md-8">
                                                    <label> Selecione su division en la empresa </label>
                                                    <select name="Id_Division_Empresa" class="form-select" aria-label="Default select example">
                                                        <?php
                                                         $consulta="SELECT * FROM tbl_division_empresa ";
                                                         $resultado=mysqli_query($conexion,$consulta);
                                                         while($fila=$resultado->fetch_array()){
                                                             echo "<option value='".$fila['Id_Division_Empresa']."'>".$fila['Division_Empresa']."</option
                                                             >";
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                            </div>




				<label for="Nombre_Completo">Nombre Completo</label>
				<input class="form-control" type="text" onKeyUP="this.value=this.value.toUpperCase();" name="Nombre_Completo" id="nombre_completo" placeholder="Nombre completo"
                onkeypress="return  SoloLetras_Espacio_uno(event)" maxlength="100" >
				
				<label for="identidad">Identidad</label>
				<input class="form-control" type="text" onKeyUP="this.value=this.value.toUpperCase();" name="Identidad" id="identidad" placeholder="ID"
                maxlength="20" >

                <label for="genero">Genero</label>
				<input class="form-control" type="text" onKeyUP="this.value=this.value.toUpperCase();" name="Genero" id="genero" placeholder="Genero"
                maxlength="1" >


                <label for="Fecha_Nac">Fecha Nacimiento</label>
				<input type="date" name="Fecha_Nac" id="fecha_nac" placeholder="Y/m/d">

                
				<label for="Creado_Por">Creado Por </label>
				<input class="form-control"  type="text"onKeyUP="this.value=this.value.toUpperCase();" name="Creado_Por" id="Creado_Por" placeholder= "Creado Por"
                onkeypress="return  SoloLetras(event)" maxlength="15">

                <label for="Fecha_creacion">Fecha de Creacion</label>
				<input type="date" name="Fecha_Creacion" id="fecha_creacion" placeholder="Y/m/d">

                <label for="Fecha_Modificacion">Fecha de Modificación</label>
				<input type="date" name="Fecha_Mod" id="Fecha_Modificacion" placeholder="Y/m/d">

                <label for="Modificado_Por">Modificado Por </label>
				<input class="form-control" type="text" onKeyUP="this.value=this.value.toUpperCase();" name="Modificado_Por" id="Modificado_Por" placeholder= "Modificado Por" 
                onkeypress="return  SoloLetras_Espacio_uno(event)" maxlength="100" >

                                        
                                        <center> 

                                            <button type="submit" name="crear_persona" class="btn_save" >Crear Persona</button></div>
                                                    
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