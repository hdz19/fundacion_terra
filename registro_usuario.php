<?php 


session_start();
if($_SESSION['Id_Rol'] != 1)
	{
		header("location: index.php");
	}
	

//CONEXION A LA BASE DE DATOS
$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

if (isset($_POST['crear_cuenta'])) {
    if (strlen($_POST['Usuario']) >= 1 && strlen($_POST['Nombre_Usuario']) >= 1 && 
     strlen($_POST['Contraseña']) >= 1  &&   strlen($_POST['Id_Rol']) >= 1 &&   strlen($_POST['Id_Tipo_Persona']) >= 1  
     &&   strlen($_POST['Preguntas_Contestadas']) >= 1 &&   strlen($_POST['Primer_Ingreso']) >= 1 
     && strlen($_POST['Correo_Electronico']) >= 1  &&  strlen($_POST['Creado_Por']) >= 1  &&  strlen($_POST['Modificado_Por']) >= 1 
    && strlen($_POST['Id_Estado_Usuario']) >= 1 )
    {
	    
	    //Campos TBL_MS_USUARIO
        $usuario = trim($_POST['Usuario']);
	    $nombre_usuario = trim($_POST['Nombre_Usuario']);
       
        $contraseña  = ($_POST['Contraseña']);
			$id_rol  = $_POST['Id_Rol'];
			$id_personas  = $_POST['Id_Tipo_Persona'];
			$fecha_ultima_conexion  = $_POST['Fecha_Ultima_Conexion'];
			$preguntas_contestadas  = $_POST['Preguntas_Contestadas'];
			$primer_ingreso  = $_POST['Primer_Ingreso'];
			$fecha_vencimiento  = $_POST['Fecha_Vencimiento'];
			$correo_electronico  = $_POST['Correo_Electronico'];
			$creado_por  = $_POST['Creado_Por'];
			$fecha_creacion  = date('Y/m/d');
			$modificado_por  = $_POST['Modificado_Por'];
			$fecha_modificacion  = $_POST['Fecha_Modificacion'];
			$id_estado_usuario  = $_POST['Id_Estado_Usuario'];

        
         //PROCESO DE INSERT DE LA TABLA: tbl_ms_usuario
	    $consulta="INSERT INTO tbl_ms_usuario (Usuario,Nombre_Usuario,Contraseña,Id_Rol,Id_Tipo_Persona,
        Fecha_Ultima_Conexion,Preguntas_Contestadas,Primer_Ingreso,Fecha_Vencimiento,
        Correo_Electronico,Creado_Por,Fecha_Creacion,Modificado_Por,Fecha_Modificacion,Id_Estado_Usuario)
         VALUES ('$usuario','$nombre_usuario','$contraseña','$id_rol','$id_personas','$fecha_ultima_conexion','$preguntas_contestadas','$primer_ingreso',
			'$fecha_vencimiento','$correo_electronico','$creado_por','$fecha_creacion','$modificado_por','$fecha_modificacion','$id_estado_usuario')";


         //VERIFICAR QUE EL USUARIO NO SE REPITA EN LA BASE DE DATOS
         $verificar_usuario=mysqli_query($conexion, "SELECT * FROM tbl_ms_usuario WHERE Usuario='$usuario' OR Correo_Electronico = '$correo_electronico'");


         if(mysqli_num_rows($verificar_usuario) > 0){
         
            ?> 
	    	<script type="text/javascript">
                      alert('¡ Este Usuario ya esta registrado, Intenta con otro diferente !')
                      </script>
                      <?php
    
    header('Location: lista_usuarios.php');
    ?> 
                      
           <?php
          
           
            exit();
         }

      //PASO PARA SABER SI SE GUARDARON O NO LOS DATOS   
         $resultado=mysqli_query($conexion,$consulta);   
	    if ($resultado) {
            mail ($correo_electronico, "Bienvenid@", "Estimado (a) $usuario ,
            Estamos felices de que formes parte de nuestro sistema.
            Para ingresar favor utiliza tu usuario y contraseña.
            
            Favor no contestar. 
            Generado automaticamente."
           ,
            "From: fundacio.terra22@gmail.com");
	    	?> 
	    	<script type="text/javascript">
                      alert('¡ Exito, Inscrito Correctamente !')
                      
                      </script>
                           <?php
    header('Location: lista_usuarios.php');
    
    ?> 
           <?php
	    } else {
            ?>    
  
            <script type="text/javascript">
                      alert('¡ Usuario o Contraseña Invalido, Intentalo de nuevo !')
                      </script>
                      <?php
    header('Location: registro_usuario.php');
    
    ?> 
              <?php           
	    }

    }   else {
        ?>    
  
        <script type="text/javascript">
                  alert('¡ Por favor completa los campos!')
                  </script>
          <?php      
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

            function ValidarPassword(p){
                        
                        let pattern = new RegExp("^(?=(.*[a-zA-Z]){1,})(?=(.*[0-9]){2,}).{8,}$"); //Regex: At least 8 characters with at least 2 numericals
                let inputToListen = document.getElementById(p); // Get Input where psw is write
                let valide = document.getElementsByClassName('indicator')[0]; //little indicator of validity of psw
                console.log(inputToListen.value);
                inputToListen.addEventListener('input', function () { // Add event listener on input
                    if(pattern.test(inputToListen.value)){
                        valide.innerHTML = 'ok';
                    }else{
                        valide.innerHTML = 'not ok'
                    }
                });
                }
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
              ValidarPassword('inputPassword');
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
                        <h1 class="mt-4">Fundacion Terra</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Panel de Control</li>
                        </ol>
                    
                           
                            
                       
                            
                        
                </main>
                                   
                                    <form action="" method="post">
                                                                   
                                   <center> <h1>Crear Usuario</h1></center>
                 <label for="Usuario">Usuario</label>
                <input class="form-control" type="text" name="Usuario" id="Usuario" onKeyUP="this.value=this.value.toUpperCase();" placeholder="Usuario"
                onkeypress="return  SoloLetras(event)" maxlength="15"  >

				<label for="Nombre_Usuario">Nombre</label>
				<input class="form-control" type="text" onKeyUP="this.value=this.value.toUpperCase();" name="Nombre_Usuario" id="Nombre_Usuario" placeholder="Nombre completo"
                onkeypress="return  SoloLetras_Espacio_uno(event)" maxlength="100" >
                <span class="indicator"></span>
				<label for="Contraseña">Contraseña</label>
                <input class="form-control" style="width: 450px" id="inputPassword" name="Contraseña" type="password" placeholder="Contraseña" 
                                                onkeypress="return pulsar(event)"  maxlength="256"  />
                                                
                                                <button class="btn btn-primary" type="button" onclick="mostrarPassword()"><span class="fa fa-eye-slash icon"></span></button>
                                               

				<label for="Correo_Electronico">Correo electrónico</label>
				<input class="form-control" id="inputPasswordConfirm" type="email"
                                                    name="Correo_Electronico" placeholder="example@gmail.com" 
                                                    onkeypress="return pulsar(event)" maxlength="50"/>

                                        <label for="Preguntas_Contestadas">Preguntas Contestadas</label>
				<input type="int" name="Preguntas_Contestadas" id="Preguntas_Contestadas" placeholder="Cantidad ">

				
				<input type="hidden" name="Primer_Ingreso" id="Primer_Ingreso" placeholder="Cantidad ">
               

                <label for="Fecha_Ultima_Conexion">Fecha de Ultima Conexión</label>
				<input type="date" name="Fecha_Ultima_Conexion" id="Fecha_Ultima_Conexion" placeholder="Y/m/d">

                <label for="Fecha_Vencimiento">Fecha de Vencimiento</label>
				<input type="date" name="Fecha_Vencimiento" id="Fecha_Vencimiento" placeholder="Y/m/d">

                <label for="Fecha_Modificacion">Fecha de Modificación</label>
				<input type="date" name="Fecha_Modificacion" id="Fecha_Modificacion" placeholder="Y/m/d">

                <label for="Modificado_Por">Modificado Por </label>
				<input class="form-control" type="text" onKeyUP="this.value=this.value.toUpperCase();" name="Modificado_Por" id="Modificado_Por" placeholder= "Modificado Por" 
                onkeypress="return  SoloLetras_Espacio_uno(event)" maxlength="100" >


			

				<label for="Creado_Por">Creado Por </label>
				<input class="form-control"  type="text"onKeyUP="this.value=this.value.toUpperCase();" name="Creado_Por" id="Creado_Por" placeholder= "Creado Por"
                onkeypress="return  SoloLetras(event)" maxlength="15">


                                        <div class ="row mb-4">
                                            <div class="col-md-8">
                                                <label> Selecione su Rol</label>
                                                <select class="form-select" aria-label="Default select example" name="Id_Rol">
                                                         <?php
                                                         $consulta="SELECT * FROM tbl_ms_roles ";
                                                         $resultado=mysqli_query($conexion,$consulta);
                                                         while($fila=$resultado->fetch_array()){
                                                             echo "<option value='".$fila['Id_Rol']."'>".$fila['Rol']."</option
                                                             >";
                                                         }
                                                         ?>
                                                         </select>
                                            </div>
                                            </div>
                                            <div class ="row mb-4">
                                            <div class="col-md-8">
                                                    <label> Selecione tipo de persona </label>
                                                    <select name="Id_Tipo_Persona" class="form-select" aria-label="Default select example">
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
                                                <label> Selecione estado de usuario </label> 
                                                <select name="Id_Estado_Usuario" class="form-select" aria-label="Default select example">
                                                        <?php
                                                        $consulta="SELECT * FROM tbl_ms_estado_usuario ";
                                                        $resultado=mysqli_query($conexion,$consulta);
                                                         while($fila=$resultado->fetch_array()){
                                                             echo "<option value='".$fila['Id_Estado_Usuario']."'>".$fila['Estado_Usuario']."</option
                                                             >";
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                        </div>  
                                         
                                        
                                        <center> 
                                                    <button type="submit" name="crear_cuenta" class="btn_save" >Crear Cuenta</button></div>
                                                    
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