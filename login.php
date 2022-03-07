

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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <center>   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"></center>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript">
            
            function TresLetras(a){
                //console.log(a);
                var str = a; //document.getElementById("inputPassword");
                let re =/(.)\1{1}/i;
                //([ab])\1{3,}/gm; //new RegExp('([ab])\2{3,}');
                var myArray = str.match(re);
                if (myArray!=null){
                    console.log(myArray);
                    alert('No se permite el ingreso de 3 letras iguales consecutivas');
                }
               // valida3letras(); 
            }
            function ValidarPassword(p){
               
               let pattern = new RegExp('/(.)\1{3}/i');//"([ab])\1{2,}");
                
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

            function pulsar(e) {
              tecla=(document.all) ? e.keyCode : e.which;
              if(tecla==32) return false;
              //valida3letras();
              //ValidarPassword('inputPassword');
              //console.log(e);
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

     function valida3letras(){
            var usuariolen=document.getElementById('inputEmail').value.length;
            var usuariotxt=document.getElementById('inputEmail').value;
            console.log(usuariolen);
            console.log(usuariotxt);
            if(usuariolen>0){
                fetch( 'valida3letras.php?Usuario='+usuariotxt)
                .then( response => {
                    if(response.status == 200) {
                        alert("Usuario no debe tener 3 letras iguales.")
                        return response.text();
                        } 
                    }); }
            }

            </script>      
    </head>
    <body class="bg-primary" oncopy="return false" oncut="return false" onpaste="return false" oncontextmenu="return false;">
   
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-4">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-1">Acceso</h3></div>
                                    <div class="card-body">
                                        <form action="validar.php" method="post">  
                                            <center><h1 class="animate__animated animate__backInLeft">¡ Bienvenido !</h1></center> </br>
                                            <center><img src="IMG/logo-fundacion.png" ></center> </br> </br>

                                            <div class="form-floating mb-4">      
                                                <input class="form-control" id="inputEmail"  name="Usuario" type="text"
                                                placeholder="Por ejemplo juan" onkeydown="return TresLetras(this.value)" onkeypress="return  SoloLetras(event)" onKeyUP="this.value=this.value.toUpperCase();"
                                                maxlength="15" required  />
                                                <label for="inputEmail">Usuario</label>
                                            </div>
                                            
                                            <div class="form-floating d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <input class="form-control" style="width: 350px" id="inputPassword" name="Contraseña" type="password" placeholder="Contraseña" 
                                                onkeypress="return pulsar(event)"  maxlength="256" required />
                                                <label for="inputPassword">Contraseña</label>
                                          <span class="indicator2"></span>
                                                <button class="btn btn-primary" type="button" onclick="mostrarPassword()"><span class="fa fa-eye-slash icon"></span></button>
                                                </div> 
                                            <div class="form-check mb-4">   
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.php">¿Has olvidado tu contraseña?</a> 
                                                <button class="btn btn-primary" >Acceso</button>
                                            </div>
                                        </form>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div> <br>
            <div id="layoutAuthentication_footer ">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small ">
                            <div class="text-muted">Copyright &copy; Tu Sitio Web 2022</div>
                            <div>
                                <a href="#">Política de privacidad</a>
                                &middot;
                                <a href="#"> Términos &amp; Condiciones </a>
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
