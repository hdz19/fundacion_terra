

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login </title>  
        <link rel="stylesheet" href="css/cabecera1.css" />   
        <link href="css/styles.css" rel="stylesheet" > 
        <center>   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"></center>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function pulsar(e) {
              tecla=(document.all) ? e.keyCode : e.which;
              if(tecla==32) return false;
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Acceso</h3></div>
                                    <div class="card-body">
                                        <form action="validar.php" method="post" >  
                                      <center>  <h1 class="animate__animated animate__backInLeft">¡ Bienvenido !</h1></center>
                                        <br>
                                     <center>   <img src="IMG/logo-fundacion.png" ></center>
                                        </br>
                                            <div class="form-floating mb-3">
                                              <input class="form-control" id="inputEmail" style="text-transform:uppercase" name="Usuario" type="usuario"
                                               placeholder="Por ejemplo juan" onkeypress="return pulsar(event)" minlength="5" maxlength="15" required />
                                                 <label for="inputEmail">Usuario</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" name="Contraseña" type="password" placeholder="Contraseña" 
                                                onkeypress="return pulsar(event)" minlength="5" maxlength="256" required />
                                                <label for="inputPassword">Contraseña</label>
                                               
                                            </div>
                                            <div class="form-check mb-3">
                                              
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.php">¿Has olvidado tu contraseña?</a>
                                                <button class="btn btn-primary" >Acceso</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.php">¿Necesito una cuenta? ¡Inscribirse!</a></div>
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
