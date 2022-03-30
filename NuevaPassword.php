<?php 
//include "../conexion.php";
include ('funciones.php');
session_start();
if($_SESSION['Id_Rol']!= 1)
	{
		//header("location: index.php");
	}
    $conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

 if(!empty($_POST))
 {
     $alert='';
    if (empty($_POST['Usuario']) >= 1 && empty($_POST['Nombre_Usuario']) >= 1 && 
    empty($_POST['Contraseña']) >= 1  &&   empty($_POST['Id_Rol']) >= 1 &&   empty($_POST['Id_Tipo_Persona']) >= 1 
     
    && empty($_POST['Correo_Electronico']) >= 1  &&  empty($_POST['Creado_Por']) >= 1  &&  empty($_POST['Modificado_Por']) >= 1  && 
    empty($_POST['Id_Estado_Usuario']) >= 1 )
   {
       $alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
   }
   else{
         //Campos TBL_MS_USUARIO
           $id_usuario = ($_POST['Id_Usuario']);
           $usuario = trim($_POST['Usuario']);
           $nombre_usuario = trim($_POST['Nombre_Usuario']);
           $contraseña  = ($_POST['Contraseña']);
           $id_rol  = $_POST['Id_Rol'];
           $id_personas  = $_POST['Id_Tipo_Persona'];
           $fecha_ultima_conexion  = $_POST['Fecha_Ultima_Conexion'];
           $preguntas_contestadas  = 1;
			$primer_ingreso  =1;
           $fecha_vencimiento  = $_POST['Fecha_Vencimiento'];
           $correo_electronico  = $_POST['Correo_Electronico'];
           $creado_por  = $_POST['Creado_Por'];
           $fecha_creacion  = date('Y/m/d');
           $modificado_por  = $_POST['Modificado_Por'];
           $fecha_modificacion  = $_POST['Fecha_Modificacion'];
           $id_estado_usuario  = $_POST['Id_Estado_Usuario'];
//CONEXION A LA BASE DE DATOS
$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

$query = mysqli_query($conexion,"SELECT * FROM tbl_ms_usuario 
													   WHERE (Usuario = '$usuario' AND Id_Usuario != $id_usuario)
													   OR (Correo_Electronico = '$correo_electronico' AND Id_Usuario != $id_usuario) ");

			$result = mysqli_fetch_array($query);

			if($result > 0){
                if(isset($_GET['t'])){
                	$alert='<p class="msg_success">Contraseña Actualizada Correctamente!</p>';
                    $sql_update = mysqli_query($conexion,"UPDATE tbl_ms_usuario SET Id_Usuario='$id_usuario',Usuario='$usuario',
                    Nombre_Usuario='$nombre_usuario', Contraseña='$contraseña',Id_Rol='$id_rol',Id_Tipo_Persona='$id_personas',
                    Fecha_Ultima_Conexion='$fecha_ultima_conexion',Preguntas_Contestadas='$preguntas_contestadas',Primer_Ingreso='$primer_ingreso',
                    Fecha_Vencimiento='$fecha_vencimiento',Correo_Electronico='$correo_electronico',Creado_Por='$creado_por',
                    Fecha_Creacion='$fecha_creacion',
                    Modificado_Por='$modificado_por',Fecha_Modificacion='$fecha_modificacion',Id_Estado_Usuario='$id_estado_usuario' WHERE Id_Usuario='$id_usuario'");
                    header('Location: index.php');    
            }else{
				$alert='<p class="msg_error">El correo o el usuario ya existe.</p>';
                }
			}
            else{
				if(empty($_POST['Contraseña']))
				{
                    //$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
					$sql_update = mysqli_query($conexion,"UPDATE tbl_ms_usuario SET Id_Usuario='$id_usuario',Usuario='$usuario',
                                                                                    Nombre_Usuario='$nombre_usuario',Id_Rol='$id_rol',Id_Tipo_Persona='$id_personas',
                                                                                  Fecha_Ultima_Conexion='$fecha_ultima_conexion',
                                                                                  Preguntas_Contestadas='$preguntas_contestadas',
                                                                                  Primer_Ingreso='$primer_ingreso',
                                                                                  Fecha_Vencimiento='$fecha_vencimiento',
                                                                                  Correo_Electronico='$correo_electronico',Creado_Por='$creado_por',
                                                                                  Fecha_Creacion='$fecha_creacion',
                                                                                   Modificado_Por='$modificado_por',
                                                                                   Fecha_Modificacion='$fecha_modificacion',
                                                                                   Id_Estado_Usuario='$id_estado_usuario' WHERE Id_Usuario='$id_usuario'");
                }else{
                    //$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
                    $sql_update = mysqli_query($conexion,"UPDATE tbl_ms_usuario SET Id_Usuario='$id_usuario',Usuario='$usuario',
                    Nombre_Usuario='$nombre_usuario', Contraseña='$contraseña',Id_Rol='$id_rol',Id_Tipo_Persona='$id_personas',
                    Fecha_Ultima_Conexion='$fecha_ultima_conexion',Preguntas_Contestadas='$preguntas_contestadas',Primer_Ingreso='$primer_ingreso',
                    Fecha_Vencimiento='$fecha_vencimiento',Correo_Electronico='$correo_electronico',Creado_Por='$creado_por',
                    Fecha_Creacion='$fecha_creacion',
                    Modificado_Por='$modificado_por',Fecha_Modificacion='$fecha_modificacion',Id_Estado_Usuario='$id_estado_usuario' WHERE Id_Usuario='$id_usuario'");


                }
                if($sql_update){
                    $bitacora = EVENT_BITACORA($id_usuario ,3,'Update','Cambio de contraseña.');
					$alert='<p class="msg_save">Usuario actualizado correctamente.</p>';
                    
                    ?> 
                    <script type="text/javascript">
                              alert('¡Contraseña actualizada correctamente!')
        
                              </script>
                                   <?php
            
           // header('Location: lista_usuarios.php');
            ?> 
                   <?php
				}else{
					$alert='<p class="msg_error">Error al actualizar el usuario.</p>';
				}

                                             
            
            }
        }
                                            
 }                                       
//Mostrar Datos
if(empty($_REQUEST['id']))
{
	//header('Location: lista_usuarios.php');
	mysqli_close($conexion);
}
$iduser = $_REQUEST['id'];

$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
$sql= mysqli_query($conexion,"SELECT u.Id_Usuario,u.Usuario, u.Nombre_Usuario,u.Contraseña,u.Id_Tipo_Persona,
u.Fecha_Ultima_Conexion,u.Preguntas_Contestadas,u.Primer_Ingreso,
u.Fecha_Vencimiento,u.Correo_Electronico,u.Creado_Por,u.Fecha_Creacion,u.Fecha_Modificacion,
u.Modificado_Por,u.Id_Estado_Usuario,(u.Id_Rol) as Id_Rol, (r.Rol) as Rol
								FROM tbl_ms_usuario u
								INNER JOIN tbl_ms_roles r
								on u.Id_Rol = r.Id_Rol
								WHERE Id_Usuario= $iduser ");
mysqli_close($conexion);
$result_sql = mysqli_num_rows($sql);

if($result_sql == 0){
	//header('Location: lista_usuarios.php');
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
        <title>Cambio Contraseña</title>
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
    <?php
        if(isset($_GET['t']))
        {
            if($_GET['t']==1)
            {
?>
             <script type="text/javascript">
              alert('Favor Actualize su contraseña!');
             </script>
<?php
            }
        }
    ?>
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
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
					
                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                    
                      <nav class="sb-sidenav-menu-nested nav">
						<li><a class="nav-link" href="registro_usuario.php">Nuevo Usuario</a></li>
						<li><a class="nav-link" href="lista_usuarios.php">Lista de Usuarios</a></li>
                        <li><a class="nav-link" href="lista_bitacora.php">Lista de Bitacora</a></li>
                </nav>
                </div>	
			<?php } ?>    
                                </nav>
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
                                    <center> <h1>Cambiar Contraseña</h1></center>

                               
                                    <label for="Usuario">Nueva Contraseña</label>
                <input width: 50px; class="form-control" type="text" style="width: 450px" name="Usuario" id="Usuario" onKeyUP="this.value=this.value.toUpperCase();" placeholder="Usuario" value="<?php echo $usuario; ?>"
                onkeypress="return  SoloLetras(event)" maxlength="15"  >


				<label for="Nombre_Usuario">Confirmar Contraseña</label>
				<input class="form-control" style="width: 450px" type="text" onKeyUP="this.value=this.value.toUpperCase();" name="Nombre_Usuario" id="Nombre_Usuario" placeholder="Nombre completo" value="<?php echo $nombre_usuario; ?>"
                onkeypress="return  SoloLetras_Espacio_uno(event)" maxlength="100" >
				
                            
                                        <div class="mt-4 mb-0">
                                                    <div class="d-grid">
                                                    <button type="submit" name="Actualizar Usuario" class="btn_save" >Cambiar</button></div>
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
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
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