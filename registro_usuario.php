<?php 
include ('funciones.php');
session_start();


if($_SESSION['Id_Rol'] != 1)
	{
		header("location: index.php");
	}


//CONEXION A LA BASE DE DATOS
$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
//print_r($_POST);
if (strlen(@$_POST['crear_cuenta'])>= 1) 
{
    //print_r($_POST);
    if (isset($_POST['Usuario'])
    
    && strlen($_POST['Nombre_Usuario']) >= 1 && 
     strlen($_POST['Contraseña']) >= 1  && strlen($_POST['Id_Rol']) >= 1 &&  
     strlen($_POST['Id_Tipo_Persona']) >= 1  && strlen($_POST['Correo_Electronico']) >= 1  
     && strlen($_POST['Id_Estado_Usuario'])>= 1
    )
    
    {
        
        $Date1 = date('Y-m-d');
        $vence = date('Y-m-d', strtotime($Date1 . " + 30 day"));
	    //Campos TBL_MS_USUARIO
        $usuario = trim($_POST['Usuario']);
        $nombre_usuario = trim($_POST['Nombre_Usuario']);
        $contraseña  = ($_POST['Contraseña']); 
        $vcontraseña  = ($_POST['VContraseña']);        
        $id_rol  = $_POST['Id_Rol'];
        $id_personas  = $_POST['Id_Tipo_Persona'];
        $fecha_ultima_conexion  = $Date1;//$_POST['Fecha_Ultima_Conexion'];
        $preguntas_contestadas  = 1;
        $primer_ingreso  =1;
        //$fecha_vencimiento  = $_POST['Fecha_Vencimiento'];
        $correo_electronico  = $_POST['Correo_Electronico'];
        $creado_por  = trim($_POST['Usuario']);
        //$fecha_creacion  = date('Y/m/d');
        $modificado_por  = trim($_POST['Usuario']);
        //$fecha_modificacion  = $_POST['Fecha_Modificacion'];
        $id_estado_usuario  = $_POST['Id_Estado_Usuario'];
         //PROCESO DE INSERT DE LA TABLA: tbl_ms_usuario
	    $consulta="INSERT INTO tbl_ms_usuario (Usuario,Nombre_Usuario,Contraseña,Id_Rol,Id_Tipo_Persona,
        Fecha_Ultima_Conexion,Preguntas_Contestadas,Primer_Ingreso,Fecha_Vencimiento,
        Correo_Electronico,Creado_Por,Modificado_Por,Id_Estado_Usuario,Fecha_Creacion,Fecha_Modificacion,Verificar_Contraseña)
        VALUES ('$usuario','$nombre_usuario','$contraseña','$id_rol','$id_personas','$fecha_ultima_conexion','$preguntas_contestadas','$primer_ingreso',
			'$vence','$correo_electronico','$creado_por','$modificado_por','$id_estado_usuario','$Date1','$Date1','$vcontraseña')";

         //VERIFICAR QUE EL USUARIO NO SE REPITA EN LA BASE DE DATOS
         $verificar_usuario=mysqli_query($conexion, "SELECT * FROM tbl_ms_usuario WHERE Usuario='$usuario' OR Correo_Electronico = '$correo_electronico'");
         if(mysqli_num_rows($verificar_usuario) > 0){
            ?> 
	    	<script type="text/javascript">
                      alert('¡Este Usuario ya esta registrado, Intenta con otro diferente !')
                      </script>
                      <?php
            header('Location: lista_usuarios.php');
            ?>          
           <?php
            exit();
         }

      //PASO PARA SABER SI SE GUARDARON O NO LOS DATOS   
      echo $consulta;
         $resultado=mysqli_query($conexion,$consulta);   
         $last_id = mysqli_insert_id($conexion);
         $bitacora = EVENT_BITACORA($last_id,1,'insert','Inserta usuarios nuevos.');

	    if ($resultado) {
            mail ($correo_electronico, "Bienvenida al sistema", "Estimad@ ".$usuario.",
            Estamos  felices de que formes parte de nuestro sistema.
            Para ingresar favor utiliza tu usuario y contraseña.


            
            Favor no contestar.
            Generado automaticamente."
           ,
            "From: fundacio.terra22@gmail.com");
	    	?> 
	    	<script type="text/javascript">

                      alert('¡Exito, Inscrito Correctamente!')
                      
                      </script>
                           <?php
            header('Location: lista_usuarios.php');

	    } else {
        ?>    
  
            <script type="text/javascript">

                      alert('¡ Usuario o Contraseña Invalido, Intentalo de nuevo !')
                      </script>
                      <?php
           // header('Location: registro_usuario.php');          

	    }

    }else {
        ?>    
  
        <script type="text/javascript">
                  alert('¡Por favor completa los campos!')
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

            function pulsar2(e) {
              tecla=(document.all) ? e.keyCode : e.which;
              if(tecla==32) return false;
            }
            //Funcion Mostrar Contraseña
            function mostrarPassword(){
                var cambio = document.getElementsByClassName("inputPassword");
                if(cambio.type == "password"){
                    cambio.type = "text";
                    $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                }else{
                    cambio.type = "password";
                    $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
                }
	        } 

            function mostrarPassword2(){
                var cambio = document.getElementById("inputVPassword");
                if(cambio.type == "password"){
                    cambio.type = "text";
                    $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                }else{
                    cambio.type = "password";
                    $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
                }
	        } 

        function validatePassword(){
            let valide = document.getElementsByClassName('indicator')[0];
            var password = document.getElementById("password-input")
            ,confirm_password = document.getElementById("inputVPassword");
            if(password.value != confirm_password.value) {
                valide.innerHTML = 'contraseña no coincide.';
                }else{
                    valide.innerHTML = 'ok';
                }
        }
      //  password.onchange = validatePassword;
      //  confirm_password.onkeyup = validatePassword;
    </script> 
    </head>
    <body class="bg-primary">
    
        <div id="container">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Bienvenido</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
           <!-- Navbar Search-->
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        
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
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
					
                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                    
                      <nav class="sb-sidenav-menu-nested nav">
				
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
                        <h1 class="mt-4"></h1>
                        
 
                </main>
                                   
         <form class="password-strength"  method="POST">
         <center><img src="IMG/logo-fundacion.png" ></center>
         <br></br>                                      
                 <center> <h1>Crear Usuario</h1></center>
                 <label for="Usuario">Usuario</label>
                <input class="form-control" type="text" name="Usuario" id="Usuario" onKeyUP="this.value=this.value.toUpperCase();" placeholder="Usuario"
                onkeypress="return  SoloLetras(event)" maxlength="15"  >

				<label for="Nombre_Usuario">Nombre</label>
				<input class="form-control" type="text" onKeyUP="this.value=this.value.toUpperCase();" name="Nombre_Usuario" id="Nombre_Usuario" placeholder="Nombre completo"
                onkeypress="return  SoloLetras_Espacio_uno(event)" maxlength="100" >                            
               <!-- <label for="Contraseña">Contraseña</label>
                <div class="input-group mb-2 mr-sm-2">
                     <input class="form-control" style="width: 450px" id="inputPassword" name="Contraseña" type="password" placeholder="Contraseña" 
                     onkeypress="return pulsar(event)"  maxlength="256"  />
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        <button class="btn btn-primary" type="button" onclick="mostrarPassword()"><span class="fa fa-eye-slash icon"></span></button>
                        </div>
                    </div>
                </div>-->
                <link rel="stylesheet" href="./style.css">
                <div style="">
                <!-- -->
                <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
                <link href="https://fonts.googleapis.com/css?family=Muli:400,600&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/minty/bootstrap.min.css">
                <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css'>
                <link rel="stylesheet" href="./js/style.css">
                 <div class="form-group" >
                        <label for="password-input">Contraseña</label>
                            <div >
                                <input name="Contraseña" class="password-strength__input form-control inputPassword" type="password" id="password-input"
                                 aria-describedby="passwordHelp" placeholder="Enter password"  onkeypress="return pulsar(event)"  maxlength="256"/>
                                <div class="input-group-append">
                                <button class="password-strength__visibility btn btn-outline-secondary" type="button"><span class="password-strength__visibility-icon" data-visible="hidden"><i class="fas fa-eye-slash"></i></span><span class="password-strength__visibility-icon js-hidden" data-visible="visible"><i class="fas fa-eye"></i></span></button>
                                </div>
                            </div><small class="password-strength__error text-danger js-hidden">This symbol is not allowed!</small><small class="form-text text-muted mt-2" id="passwordHelp">¡Agregue 9 caracteres o más, letras minúsculas, letras mayúsculas, números y símbolos para que la contraseña sea realmente segura!</small>
                            </div>
                            <div class="password-strength__bar-block progress mb-4">
                            <div class="password-strength__bar progress-bar bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <!-- <button class="password-strength__submit btn btn-success d-flex m-auto" type="button" disabled="disabled">Submit</button> -->

                    </div>
                    </script><script  src="./js/script.js"></script>
                    
                    <span class="indicator"></span>
                <div class="">
                <label for="password-input">Verificar Contraseña</label>

                <input class="form-control" style="width: 450px" id="inputVPassword" name="VContraseña" type="password" placeholder="Verificar Contraseña" 
                     onkeypress="return pulsar2(event)" onKeyUP="validatePassword()" maxlength="15"  />   
                    <div class="input-group-text">                          
                         <button class="btn btn-primary" type="button" onclick="mostrarPassword2()"><span class="fa fa-eye-slash icon"></span></button>
                    </div>
         
                </div>
               
				<label for="Correo_Electronico">Correo electrónico</label>
				<input class="form-control" id="inputPasswordConfirm" type="email"
                                                    name="Correo_Electronico" placeholder="example@gmail.com" 
                                                    onkeypress="return pulsar(event)" maxlength="50"/>

				<input type="hidden" name="Preguntas_Contestadas" id="Preguntas_Contestadas" placeholder="Cantidad ">
			
				<input type="hidden" name="Primer_Ingreso" id="Primer_Ingreso" placeholder="Cantidad ">

        
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
                                        <input type="hidden" name="crear_cuenta" id="crear_cuenta" value="1">
                                            <button type="submit"  class="btn_save password-strength__submit" >Crear Cuenta</button>
                                                    
                                             </center>  
                                              

                    <!-- --> 
                </div>
                                   </form>
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