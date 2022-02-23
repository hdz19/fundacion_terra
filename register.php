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
            function pulsar(e) {
              tecla=(document.all) ? e.keyCode : e.which;
              if(tecla==32) return false;
            }
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
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Crear una cuenta</h3></div>
                                    <div class="card-body">
                                        <form>
                                        <br>
                                     <center>   <img src="IMG/logo-fundacion.png" ></center> <p>
                                        </br>
                                        <h3> Selecione rol del usuario </h3> <p>
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputFirstName" type="text"  style="text-transform:uppercase"
                                                         placeholder="Enter your first name" required pattern="[a-zA-Z]+" />
                                                        <label for="inputFirstName">Rol</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputLastName" type="text" style="text-transform:uppercase"
                                                        placeholder="Enter your last name" required pattern="[a-zA-Z]+"/>
                                                        <label for="inputLastName">Descripción</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputLastName" type="text" style="text-transform:uppercase"
                                                        placeholder="Enter your last name" required pattern="[a-zA-Z]+"/>
                                                        <label for="inputLastName">Creado Por: </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputLastName" type="text" style="text-transform:uppercase"
                                                        placeholder="Enter your last name"required pattern="[A-Z]+"/>
                                                        <label for="inputLastName">Fecha Creación: </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0"> 
                                                <button class="btn btn-primary" >Registrar Rol De Usuario</button>
                                            </div>
                                            </br>

                                            <h3> Ingrese información del usuario </h3> <p>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputEmail" style="text-transform:uppercase" name="Usuario" type="usuario"
                                                    placeholder="Por ejemplo juan" onkeypress="return pulsar(event)" maxlength="15" required pattern="[a-zA-Z]+" />
                                                    <label for="inputEmail">Usuario</label>
                                                
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputLastName" type="text" style="text-transform:uppercase"
                                                    placeholder="Enter your last name" required pattern="[a-zA-Z-]+"/>
                                                    <label for="inputLastName">Nombre Completo de Usuario</label>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputLastName" type="text" style="text-transform:uppercase"
                                                    placeholder="Enter your last name" required pattern="[a-zA-Z-]+"/>
                                                    <label for="inputLastName">Estado Usuario</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm" type="password" placeholder="Confirm password" 
                                                        onkeypress="return pulsar(event)" required />
                                                        <label for="inputPasswordConfirm"> Contraseña</label>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPasswordConfirm" type="text" placeholder="Confirm password"  required
                                                    onkeypress="return pulsar(event)" />
                                                    <label for="inputLastName"> Confirmar Contraseña</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm" type="text" placeholder="Confirm password" required/>
                                                        <label for="inputPasswordConfirm">Código de Rol</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm" type="email" placeholder="Confirm password" required
                                                        onkeypress="return pulsar(event)"/>
                                                        <label for="inputPasswordConfirm">Correo Electrónico</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputLastName" type="text" style="text-transform:uppercase"
                                                        placeholder="Enter your last name" required pattern="[a-zA-Z]+"/>
                                                        <label for="inputLastName">Creado Por: </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputLastName" type="text" style="text-transform:uppercase"
                                                        placeholder="Enter your last name"required pattern="[A-Z]+"/>
                                                        <label for="inputLastName">Fecha Creación: </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><button class="btn btn-primary btn-block" >Crear Cuenta</button></div>
                                     </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">¿Tienes una cuenta? Inicia sesión</a></div>
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

