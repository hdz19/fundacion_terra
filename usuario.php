<?php 


session_start();
if($_SESSION['Id_Rol'] != 1)
	{
		header("location: ./");
	}

//CONEXION A LA BASE DE DATOS
$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

if (isset($_POST['crear_cuenta'])) {
    if (strlen($_POST['Usuario']) >= 1 && strlen($_POST['Nombre_Usuario']) >= 1 && 
     strlen($_POST['Contraseña']) >= 1  &&   strlen($_POST['Id_Rol']) >= 1 &&   strlen($_POST['Id_Tipo_Persona']) >= 1
     &&   strlen($_POST['Preguntas_Contestadas']) >= 1 &&   strlen($_POST['Primer_Ingreso']) >= 1  
     && strlen($_POST['Correo_Electronico']) >= 1  &&  strlen($_POST['Creado_Por']) >= 1  &&  strlen($_POST['Modificado_Por']) >= 1 && 
     strlen($_POST['Id_Estado_Usuario']) >= 1 )
    {
	    
	    //Campos TBL_MS_USUARIO
        $usuario = trim($_POST['Usuario']);
	    $nombre_usuario = trim($_POST['Nombre_Usuario']);
       
        $contraseña  = ($_POST['Contraseña']);
			$id_rol  = $_POST['Id_Rol'];
			$id_personas  = $_POST['Id_Tipo_Persona'];
			$fecha_ultima_conexion  = date('Y/m/d');
			$preguntas_contestadas  = $_POST['Preguntas_Contestadas'];
			$primer_ingreso  = $_POST['Primer_Ingreso'];
			$fecha_vencimiento  = date('Y/m/d');
			$correo_electronico  = $_POST['Correo_Electronico'];
			$creado_por  = $_POST['Creado_Por'];
			$fecha_creacion  = date('Y/m/d');
			$modificado_por  = $_POST['Modificado_Por'];
			$fecha_modificacion  = date('Y/m/d');
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
    
    include("login.php")
    ?> 
                      
           <?php
          
           
            exit();
         }

      //PASO PARA SABER SI SE GUARDARON O NO LOS DATOS   
         $resultado=mysqli_query($conexion,$consulta);   
	    if ($resultado) {
	    	?> 
	    	<script type="text/javascript">
                      alert('¡ Exito, Inscrito Correctamente !')
                      </script>
           <?php
	    } else {
            ?>    
  
            <script type="text/javascript">
                      alert('¡ Usuario o Contraseña Invalido, Intentalo de nuevo !')
                      </script>
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
        <title>Registro de Usuario</title>
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
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="card shadow-lg border-0 rounded-lg mt-3">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Crear una cuenta</h3></div>
                                    <div class="card-body">
                                   
                                    <form action="usuario.php" method="post">
                                        <br>
                                        <center>   <img src="IMG/logo-fundacion.png" ></center> <p>
                                        </br>
                                        <h3> Ingrese datos del Usuario </h3> <p></br>
                                        <div class="row mb-4">
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputEmail" onKeyUP="this.value=this.value.toUpperCase();" name="Usuario" type="usuario"
                                                    placeholder="Por ejemplo juan" onkeypress="return  SoloLetras(event)" maxlength="15" />
                                                    <label for="inputEmail">Usuario</label>
                                                </div>
                                            </div>   
                                            <div class="col-md-8">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputLastName" type="text" onKeyUP="this.value=this.value.toUpperCase();"
                                                    name="Nombre_Usuario"
                                                    placeholder="Enter your last name" onkeypress="return  SoloLetras_Espacio_uno(event)" maxlength="100" />
                                                    <label for="inputLastName">Nombre Completo de Usuario</label>
                                                </div>
                                            </div>
                                        </div>  

                                        <div id="content" class="col-lg-12">
              <?php
             //FUNCION PARA GENERAR UNA CONTRASEÑA NUEVA
            function generatePassword($length)
            {
                $key = "";
                //$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
                $pattern = "1234567890abcdefghijklmñnopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ._#@&()";
                $max = strlen($pattern)-1;
                for($i = 0; $i < $length; $i++){
                    $key .= substr($pattern, mt_rand(0,$max), 1);
                }
                return $key;
            }

            if (isset($_POST['submitChars'])) {
                $length = (int)$_POST['chars'];
                echo '<div class="alert alert-success">Nueva contraseña generada: <strong>'.generatePassword($length).'</strong></div>';
            }
            ?>
                                        <div class="row mb-4">
                                                <div class="col-md-5">    
                                                    <label for="chars">Número de caracteres</label>
                                                    <input class="form-control" type="text" name="chars" value="15" maxlength="2" >
                                                    <small id="emailHelp" class="form-text text-muted">Introduce un número de caracteres para generar la contraseña.</small>
                                                    <button type="submit" name="submitChars" class="btn btn-primary">Enviar</button> <br>
                                                </div>           
                                            <div class="col-md-7">
                                            <div class="form-floating d-flex align-items-center justify-content-between mt-0 mb-2">
                                                <input class="form-control" style="width: 450px" id="inputPassword" name="Contraseña" type="password" placeholder="Contraseña" 
                                                onkeypress="return pulsar(event)"  maxlength="256"  />
                                                <label for="inputPassword">Contraseña</label>
                                                <button class="btn btn-primary" type="button" onclick="mostrarPassword()"><span class="fa fa-eye-slash icon"></span></button>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class ="row mb-4">
                                            <div class="col-md-10">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPasswordConfirm" type="email"
                                                    name="Correo_Electronico" placeholder="Confirm password" 
                                                    onkeypress="return pulsar(event)" maxlength="50"/>
                                                    <label for="inputPasswordConfirm">Correo Electrónico</label>
                                                </div>
                                            </div>
                                        </div>

                                        <label for="Preguntas_Contestadas">Preguntas Contestadas</label>
				<input type="int" name="Preguntas_Contestadas" id="Preguntas_Contestadas" placeholder="Cantidad ">

				<label for="Primer_Ingreso">Primer Ingreso</label>
				<input type="int" name="Primer_Ingreso" id="Primer_Ingreso" placeholder="Cantidad ">
                <label for="Modificado_Por">Modificado Por </label>
				<input type="text" name="Modificado_Por" id="Modificado_Por" placeholder= "Modificado Por">

			

				<label for="Creado_Por">Creado Por </label>
				<input type="text" name="Creado_Por" id="Creado_Por" placeholder= "Creado Por">


                                        <div class ="row mb-4">
                                            <div class="col-md-4">
                                                <label> Selecione su rol</label>
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
                                            <div class="col-md-4">
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
                                            <div class="col-md-4">
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
                                         
                                        
                                        <center> <div class="col-md-2" >    
                                                <div class="mt-4 mb-0">
                                                    <div class="d-grid">
                                                    <button type="submit" name="crear_cuenta" class="btn_save" >Crear Cuenta</button></div>
                                                    </div>  
                                                </div> 
                                            </div> </center>     
                                    </form><p>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">¿Tener una cuenta? Ir a iniciar sesión</a></div>
                                    </div>
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