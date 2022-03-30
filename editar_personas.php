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
    if (empty($_POST['Id_Tipo_Persona']) >= 1 && empty($_POST['Id_Division_Empresa']) >= 1 && 
    empty($_POST['Nombre_Completo']) >= 1  &&   empty($_POST['Identidad']) >= 1 &&   empty($_POST['Genero']) >= 1 
     
    &&  empty($_POST['Fecha_Nac']) >= 1 &&  empty($_POST['Creado_Por']) >= 1 &&   empty($_POST['Fecha_Creacion']) >= 1  && empty($_POST['Modificado_Por']) >= 1 &&  empty($_POST['Fecha_Mod']) >= 1 )
   {
       $alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
   }else{

       //Campos TBL_MS_USUARIO
        $id_personas = ($_POST['Id_Personas']);
        $id_tipo_persona = trim($_POST['Id_Tipo_Persona']);
        $id_division_empresa = trim($_POST['Id_Division_Empresa']);
        
        $nombre_completo  = ($_POST['Nombre_Completo']);
        $identidad  = $_POST['Identidad'];
        $genero  = $_POST['Genero'];
        $fecha_nac= $_POST['Fecha_Nac'];
        $creado_por  = $_POST['Creado_Por'];
        $fecha_creacion  = date('Y/m/d');
        $modificado_por  = $_POST['Modificado_Por'];
        $fecha_mod  = $_POST['Fecha_Mod'];

    	//CONEXION A LA BASE DE DATOS
        $conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

        $query = mysqli_query($conexion,"SELECT * FROM tbl_personas
													   WHERE (Identidad = '$identidad' AND Id_Perosnas != $id_personas)");

			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">La persona ya existe.</p>';
			}else{

				if(empty($_POST['Identidad']))
				{

                    //$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
					$sql_update = mysqli_query($conexion,"UPDATE tbl_personas SET Id_Personas='$id_personas',
                                                                                    Id_Tipo_Persona='$id_tipo_persona',
                                                                                    Id_Division_Empresa='$id_division_empresa',
                                                                                    Nombre_Completo='$nombre_completo',
                                                                                    Identidad='$identidad',
                                                                                    Genero='$genero',
                                                                                    Fecha_Nac= '$fecha_nac',
                                                                                    Creado_Por='$creado_por',
                                                                                    Fecha_Creacion='$fecha_creacion',
                                                                                    Modificado_Por='$modificado_por',
                                                                                    Fecha_Mod='$fecha_mod',
                                                                                    WHERE Id_Personas='$id_personas'");
                


                }if($sql_update){
                    
					$alert='<p class="msg_save">actualizado correctamente.</p>';
                    
                    ?> 
                    <script type="text/javascript">
                              alert('¡ actualizado correctamente !')
        
                              </script>
                                   <?php
            
            header('Location: lista_personas.php');
            ?> 
                   <?php
		}else{
				$alert='<p class="msg_error">Error al actualizar.</p>';
			}

                                             
            
            }
        }
                                            
 }                                       
//Mostrar Datos
if(empty($_REQUEST['id']))
{
	header('Location: lista_personas.php');
	mysqli_close($conexion);
}
$iduser = $_REQUEST['id'];

$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

$sql= mysqli_query($conexion,"SELECT u.Id_Personas ,u.Id_Tipo_Persona , u.Id_Division_Empresa ,u.Nombre_Completo,u.Identidad,
u.Genero,u.Fecha_Nac, u.Creado_Por, u.Fecha_Creacion, u.Modificado_Por, u.Fecha_Mod as Id_Rol, (r.Rol) as Rol
								FROM tbl_ms_usuario u
								INNER JOIN tbl_ms_roles r
								on u.Id_Rol = r.Id_Rol
								WHERE Id_Usuario= $iduser ");
                                
mysqli_close($conexion);
$result_sql = mysqli_num_rows($sql);

if($result_sql == 0){
	header('Location: lista_usuarios.php');
}else{
	$option = '';
	while ($data = mysqli_fetch_array($sql)) {
		# code...
		$iduser                = $data['Id_Usuario'];
		$usuario               = $data['Usuario'];
		$nombre_usuario        = $data['Nombre_Usuario'];
		$contraseña            = $data['Contraseña'];
		$id_rol                = $data['Id_Rol'];
		$id_personas           = $data['Id_Tipo_Persona'];
		$fecha_ultima_conexion = $data['Fecha_Ultima_Conexion'];
		$preguntas_contestadas = $data['Preguntas_Contestadas'];
		$primer_ingreso        = $data['Primer_Ingreso'];
	    $fecha_vencimiento     = $data['Fecha_Vencimiento'];
		$correo_electronico    = $data['Correo_Electronico'];
		$creado_por            = $data['Creado_Por'];
	    $fecha_creacion        = date('Y/m/d');
		$modificado_por        = $data['Modificado_Por'];
	    $fecha_modificacion    = $data['Fecha_Modificacion'];
		$id_estado_usuario     = $data['Id_Estado_Usuario'];
	
		
		

		if($id_rol == 1){
			$option = '<option value="'.$id_rol.'" select>'.$id_rol.'</option>';
		}else if($id_rol == 2){
			$option = '<option value="'.$id_rol.'" select>'.$id_rol.'</option>';	
		}else if($id_rol == 3){
			$option = '<option value="'.$id_rol.'" select>'.$id_rol.'</option>';
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

                                               
									<input type="hidden" name="Id_Usuario" value="<?php echo $iduser; ?>">
                                    <center> <h1>Editar Usuario</h1></center>

                               
                                    <label for="Usuario">Usuario</label>
                <input width: 50px; class="form-control" type="text" style="width: 450px" name="Usuario" id="Usuario" onKeyUP="this.value=this.value.toUpperCase();" placeholder="Usuario" value="<?php echo $usuario; ?>"
                onkeypress="return  SoloLetras(event)" maxlength="15"  >


				<label for="Nombre_Usuario">Nombre</label>
				<input class="form-control" style="width: 450px" type="text" onKeyUP="this.value=this.value.toUpperCase();" name="Nombre_Usuario" id="Nombre_Usuario" placeholder="Nombre completo" value="<?php echo $nombre_usuario; ?>"
                onkeypress="return  SoloLetras_Espacio_uno(event)" maxlength="100" >
				
              
				<label for="Contraseña">Contraseña</label>
                <input class="form-control" style="width: 450px" id="inputPassword" name="Contraseña" type="password" placeholder="Contraseña" 
                                                onkeypress="return pulsar(event)"  maxlength="256"  />
                                                <button class="btn btn-primary" type="button" onclick="mostrarPassword()"><span class="fa fa-eye-slash icon"></span></button>
                                               

				<label for="Correo_Electronico">Correo electrónico</label>
				<input class="form-control" style="width: 450px" id="inputPasswordConfirm" type="email"
                                                    name="Correo_Electronico" placeholder="example@gmail.com" value="<?php echo $correo_electronico; ?>"
                                                    onkeypress="return pulsar(event)" maxlength="50"/>

                                       
				<input type="hidden" name="Preguntas_Contestadas" style="width: 450px" id="Preguntas_Contestadas" placeholder="Cantidad "value="<?php echo $preguntas_contestadas; ?>">

				
				<input type="hidden" style="width: 450px" name="Primer_Ingreso" id="Primer_Ingreso" placeholder="Cantidad "value="<?php echo $primer_ingreso; ?>">

                <label for="Fecha_Ultima_Conexion">Fecha de Ultima Conexión</label>
				<input type="date" style="width: 450px" name="Fecha_Ultima_Conexion" id="Fecha_Ultima_Conexion" placeholder="Y/m/d" value="<?php echo $fecha_ultima_conexion; ?>">

                <label for="Fecha_Vencimiento">Fecha de Vencimiento</label>
				<input type="date" style="width: 450px" name="Fecha_Vencimiento" id="Fecha_Vencimiento" placeholder="Y/m/d" value="<?php echo $fecha_vencimiento; ?>">

                <label for="Fecha_Modificacion">Fecha de Modificación</label>
				<input type="date"style="width: 450px"  name="Fecha_Modificacion" id="Fecha_Modificacion" placeholder="Y/m/d" value="<?php echo $fecha_modificacion; ?>">

                <label for="Modificado_Por">Modificado Por </label>
				<input class="form-control"style="width: 450px"  type="text" onKeyUP="this.value=this.value.toUpperCase();" name="Modificado_Por" id="Modificado_Por" placeholder= "Modificado Por" value="<?php echo $modificado_por; ?>"
                onkeypress="return  SoloLetras_Espacio_uno(event)" maxlength="100" >


			

				<label for="Creado_Por">Creado Por </label>
				<input class="form-control" style="width: 450px" type="text"onKeyUP="this.value=this.value.toUpperCase();" name="Creado_Por" id="Creado_Por" placeholder= "Creado Por" value="<?php echo $creado_por; ?>"
                onkeypress="return  SoloLetras(event)" maxlength="15">


                                       <div class ="row mb-4">
                                            <div class="col-md-4">
                                                <label> Selecione su rol</label>
                                                <select class="form-select" aria-label="Default select example" name="Id_Rol">
                                                         <?php
														 $conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
                                                         $consulta="SELECT * FROM tbl_ms_roles ";
                                                         $resultado=mysqli_query($conexion,$consulta);
                                                         while($fila=$resultado->fetch_array()){
                                                             echo "<option value='".$fila['Id_Rol']."'>".$fila['Rol']."</option
                                                             >";
                                                         }
                                                         ?>
                                                         </select>
                                            </div>
                                            <div class="col-md-4">
                                                    <label> Selecione Tipo de Persona </label>
                                                    <select name="Id_Tipo_Persona" class="form-select" aria-label="Default select example">
                                                        <?php
														$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
                                                         $consulta="SELECT * FROM tbl_tipo_persona ";
                                                         $resultado=mysqli_query($conexion,$consulta);
                                                         while($fila=$resultado->fetch_array()){
                                                             echo "<option value='".$fila['Id_Tipo_Persona']."'>".$fila['Tipo_Persona']."</option
                                                             >";
                                                        }
                                                        ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label> Selecione Estado del Usuario </label> 
                                                <select name="Id_Estado_Usuario" class="form-select" aria-label="Default select example">
                                                        <?php
														$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
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
                            
                                        <div class="mt-4 mb-0">
                                                    <div class="d-grid">
                                                    <button type="submit" name="Actualizar Usuario" class="btn_save" >Actualizar Usuario</button></div>
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