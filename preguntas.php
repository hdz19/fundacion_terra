
<?php
session_start();

$usuario=$_POST['Usuario'];


$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

$consulta="Select up.Respuesta, p.Pregunta from tbl_ms_preguntas_usuario up
 inner join tbl_ms_usuario u on up.id_usuario=u.id_usuario 
 inner join tbl_preguntas p on up.id_pregunta=p.id_pregunta
 WHERE u.Usuario='$usuario'";

$resultado=mysqli_query($conexion,$consulta);

if($resultado->num_rows>0){
  
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Preguntas secretas</title>
        <link href="css/styleslistbox.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <center>   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"></center>
        <script type="text/javascript">
           

            //mostrar contraseña 
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
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><center><h3 class="animate__animated animate__backInLeft">Preguntas secretas</h3><center/></div>
                                   
                                    <div class="card-body">
                                    <br>
                                     <center>   <img src="IMG/logo-fundacion.png" ></center>
                                        </br>
                                       
                                        <br></br>
                                        <div class="small mb-3 text-muted">A continuación se le presentan sus preguntas secretas,
                                        </div>
                                       
                                        <form >
                                            <!--LISTBOX-->

                                            <div class="container">
                                            <center><h2 class="animate__animated animate__backInLeft">¡ Bienvenido !</h2></center> </br>

                                                <div class="select-box">
                                                    <div class="options-container">
                                                    <?php
                                                        while($filas=$resultado->fetch_array()){
                                                            ?>
                                                            <div class="option">
                                                            <input
                                                            type="radio"
                                                            class="radio"
                                                            id="automobiles"
                                                            name="category"
                                                            />
                                                            <label for="automobiles"><?php echo  $filas['Pregunta'];?></label>
                                                        </div>
                                                        <?php //echo "<option value='".$fila['Id_Rol']."'>".$fila['Rol']."</option>";
                                                        }
                                                         ?>
                                       </div>

                                                        <div class="selected">
                                                            Seleccione su pregunta
                                                        </div>
                                                </div>
                                            </div>

                                            <div class="form-floating mb-4">      
                                                <input class="form-control" id="inputEmail"  name="Pregunta" type="pregunta"
                                                placeholder="Ingrese la respuesta a su pregunta... !!! " onKeyUP="this.value=this.value.toUpperCase();" required  />
                                                <label for="inputEmail">Ingrese su respuesta: </label>
                                            </div>

                                            <div class="form-floating d-flex align-items-center justify-content-between mt-4 mb-0">      
                                                <input class="form-control" id="inputPassword"  name="Contraseña" type="password"
                                                placeholder="Ingrese su nueva contraseña... !!! minlength="5" maxlength="10" " style="width: 350px" required  />
                                                <label for="inputEmail">Ingrese su nueva contraseña: </label>
                                                <button class="btn btn-primary" type="button" onclick="mostrarPassword()"><span class="fa fa-eye-slash icon"></span></button>
                                            </div>

                                            
                                            <div class="form-floating d-flex align-items-center justify-content-between mt-4 mb-0">      
                                                <input class="form-control" id="inputPassword"  name="Contraseña" type="password"
                                                placeholder="Confirme su contraseña... !!! " minlength="5" maxlength="10" style="width: 350px" required  />
                                                <label for="inputEmail">Confirmar contraseña: </label>
                                                <button class="btn btn-primary" type="button" onclick="mostrarPassword()"><span class="fa fa-eye-slash icon"></span></button>
                                            </div>

                                            <script src="main.js"></script>


                                            <br></br>
                                            <center>
                                                
                                               <button class="btn btn-primary">Aceptar</button>
                                                 
                                                    </center>
                                                    
                                        </form>

                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small">
                                        <a  href="login.php"></a>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
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
    </body>
</html>

<?php
}else{
    ?>

       
      
      <?php
      
        header("location:password.php");
      ?>    
    
        <script type="text/javascript">
          alert('¡ Usuario no encontrado !');
        </script>
    
    <?php 
    
  }
  
  
  mysqli_free_result($resultado);
  mysqli_close($conexion);
  ?>