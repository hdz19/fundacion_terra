
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Primer ingreso</title>
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
                                    <div class="card-header"><center><h3 class="animate__animated animate__backInLeft">Ingreso de preguntas secretas</h3><center/></div>
                                   
                                    <div class="card-body">
                                    <br>
                                     <center>   <img src="IMG/logo-fundacion.png" ></center>
                                        </br>
                                       
                                        <br></br>
                                        <div class="small mb-3 text-muted">A continuación se le presenta un formulario, deberá llenar los campos solicitados con las preguntas secretas que considere adecuadas,
                                            para que posteriormente sirvan como metodo de recuperación de su contraseña, en caso de la llegara a olvidar.
                                        </div>
                                       
                                        <form >
                                            

                                            <label for="InputPregunta1"><b><i>#1. Ingrese su primer pregunta:</i></b></label>
                                            <br>
                                             <input class="form-control" id="inputEmail"  name="Pregunta1" type="pregunta"
                                             onKeyUP="this.value=this.value.toUpperCase();" required  />
                                            </br>

                                            <div class="form-floating mb-4">      
                                                <input class="form-control" id="inputEmail"  name="Pregunta1" type="pregunta"
                                                placeholder="Ingrese la respuesta a su pregunta... !!! " onKeyUP="this.value=this.value.toUpperCase();" required  />
                                                <label for="inputEmail">Ingrese su respuesta: </label>
                                            </div>

                                            <label for="InputPregunta1" ><b><i>#2. Ingrese su segunda pregunta:</i></b></label>
                                            <br>
                                             <input class="form-control" id="inputEmail"  name="Pregunta2" type="pregunta"
                                             onKeyUP="this.value=this.value.toUpperCase();" required  />
                                            </br>

                                            <div class="form-floating mb-4">      
                                                <input class="form-control" id="inputEmail"  name="Pregunta" type="pregunta"
                                                placeholder="Ingrese la respuesta a su pregunta... !!! " onKeyUP="this.value=this.value.toUpperCase();" required  />
                                                <label for="inputEmail">Ingrese su respuesta: </label>
                                            </div>

                                            <label for="InputPregunta1"><b><i>#3. Ingrese su tercer pregunta:</i></b></label>
                                            <br>
                                             <input class="form-control" id="inputEmail"  name="Pregunta3" type="pregunta"
                                             onKeyUP="this.value=this.value.toUpperCase();" required  />
                                            </br>

                                            <div class="form-floating mb-4">      
                                                <input class="form-control" id="inputEmail"  name="Pregunta" type="pregunta"
                                                placeholder="Ingrese la respuesta a su pregunta... !!! " onKeyUP="this.value=this.value.toUpperCase();" required  />
                                                <label for="inputEmail">Ingrese su respuesta: </label>
                                            </div>

                                            <script src="main.js"></script>




                                            
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                
                                                <button class="btn btn-primary" href="index.php">Aceptar</button>
                                                 
                                            </div>
                                           
                                        </form>

                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small">
                                        <a  href="login.php">Volver a iniciar sesión</a>
                                        &nbsp;
                                        <a href="register.php">¿Necesita una cuenta? ¡Regístrese!</a>
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
