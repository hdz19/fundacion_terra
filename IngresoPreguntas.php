<?php 
include ('funciones.php');
	session_start();
    $conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
   $usuario=$_SESSION['Usuario'];
   @$id_usuario = (@$_SESSION['Id_Usuario']); 
	if($_SESSION['Id_Rol'] !=1)
	{
		header("location: index.php");
    }
    @$id_usuario=$_SESSION['Id_Usuario'];
        if(isset($_POST['Respuesta'])){
            $r=array();
            foreach ($_POST['Respuesta'] as $clave => $valor) 
            {
              $r[]=$valor;          
            }
            $p=array();
            foreach ($_POST['Pregunta'] as $clave => $valor2) 
            {
                $p[]=$valor2;
            }

            $i=0;
            foreach ($r as $v )
            {
               
                 @$fecha_creacion  = date('Y-m-d');
                @$sqlinsert="INSERT INTO `tbl_ms_preguntas_usuario`
                 (`Id_Pregunta_Usuario`, `Id_Pregunta`, `Id_Usuario`, `Respuesta`, `Creado_Por`,
                  `Fecha_Creacion`, `Modificado_Por`, `Fecha_Modificacion`) 
                  VALUES (NULL, '".$p[$i]."', '$id_usuario', '".$r[$i]."', '$usuario', '$fecha_creacion', '$usuario', '2022-03-14');";
               // echo $sqlinsert;
                $resultado=mysqli_query($conexion,$sqlinsert);
                  
                $i++;
            }
            //$bitacora = EVENT_BITACORA($id_usuario ,6,'IngresoPreguntas','Ingreso de las preguntas.'); 
        }
        $consulta="Select Id_Pregunta,Pregunta from tbl_preguntas";
        $resultado=mysqli_query($conexion,$consulta);
 ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Preguntas Secretas</title>
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

                                        <center>  
                                          <img src="IMG/logo-fundacion.png" >
                                        </center>
                                        </br>
                                        <br></br>
                                        <div class="small mb-3 text-muted">A continuación se le presenta un formulario, deberá llenar los campos solicitados con las preguntas secretas que considere adecuadas,
                                            para que posteriormente sirvan como metodo de recuperación de su contraseña, en caso de que la llegara a olvidar.
                                        </div>
                                        <form action="" method="post" >
                                       <?php

                                       
                                       if($resultado->num_rows>0){
                                           while ($r=$resultado->fetch_array()) {
                                           ?>
                                            <label for="InputPregunta1"><b><i><?php echo $r["Pregunta"]; ?></i></b></label>
                                            <br>
                                            <div class="form-floating mb-4">      
                                            <input class="form-control" id="inpuP[]"  name="Pregunta[]" value="<?php echo $r["Id_Pregunta"]; ?>" type="hidden"/>
                                                <input class="form-control" id="inputR[]"  name="Respuesta[]" type="text" 
                                                placeholder="Ingrese la respuesta a su pregunta... !!! " onKeyUP="this.value=this.value.toUpperCase();" required  />
                                                <label for="inputEmail">Ingrese su respuesta: </label>
                                            </div>
                                        <?php
                                             }
                                        }
                                        ?>

                                            <script src="main.js"></script>

                                            <center>
                                                <button class="btn btn-primary" href="index.php">Aceptar</button>
                                    </center>                                  
                                        </form>

                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small">
                                        <a  href="login.php"></a>
                                        &nbsp;
                                        
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
