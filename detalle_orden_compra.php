<?php 


session_start();
if($_SESSION['Id_Rol'] != 1){

	header("location: index.php");

}
	

//CONEXION A LA BASE DE DATOS
$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

<<<<<<<< HEAD:detalle_orden_compra.php
if(!empty($_POST)){
        $alert='';
        if(empty($_POST['Precio']) || empty($_POST['Descripcion_de_Producto']) || empty($_POST['Producto']) || empty($_POST['Cantidad']))
        {
            $alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
        }else{
               
        	$precio= $_POST['Precio'];
			$descripcion_producto= $_POST['Descripcion_de_Producto'];
            $producto= $_POST['Producto'];
            $cantidad= $_POST['Cantidad'];
		
            $consulta = mysqli_query($conexion,"INSERT INTO tbl_detalle_orden_compra (Precio, Descripcion_de_Producto, Producto, Cantidad)
            VALUES ('$precio','$descripcion_producto','$producto','$cantidad')");
            if($consulta){
                $alert='<p class="msg_save">El detalle del producto se registro correctamente.</p>';
            }else{
                $alert='<p class="msg_error">Error al ingresar el detalle del producto.</p>';
            }
	
        }    
}    
========
if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['Division_Empresa']) 
        )
		{$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{
			

			$div_empresa = $_POST['Division_Empresa'];
          
			


		

				$query_insert = mysqli_query($conexion,"INSERT INTO tbl_division_empresa (Division_Empresa)
                VALUES ('$div_empresa')");
				if($query_insert){
					$alert='<p class="msg_save"> Solicitud Ingresado correctamente.</p>';
                    header('Location: registro_div_empresa.php');
				}else{
					$alert='<p class="msg_error">Error al Ingresar la asolicitud.</p>';
				}

			}


		}
>>>>>>>> d6b6c5477a8a6fb9c5881884d1e23c2920028be4:registro_div_empresa.php
?>

<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Registro de Division Empresa</title>
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
                letras ="{ABCDEFGHIJKLMN??OPQRSTUVWXYZabcdefghijklmn??opqrstuvwxyz}";

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
                letras ="{ABCDEFGHIJKLMN??OPQRSTUVWXYZabcdefghijklmn??opqrstuvwxyz}";

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



    </script> 
    </head>
    <body class="bg-primary">
    
        <div id="container">
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
                        <li><a class="dropdown-item" href="login.php">Cerrar sesi??n</a></li> 
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Configuraci??n</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Panel de Control
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Dise??os
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.php">Navegaci??n est??tica</a>
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
<<<<<<<< HEAD:detalle_orden_compra.php
						<li><a class="nav-link" href="orden_compra.php">Nueva orden de compra</a></li>
						
========
						<li><a class="nav-link" href="registro_division_empresa.php">Nueva Division Empresa</a></li>
						<li><a class="nav-link" href="lista_div_empresa.php">Lista de divisiones</a></li>
>>>>>>>> d6b6c5477a8a6fb9c5881884d1e23c2920028be4:registro_div_empresa.php
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
                                            <a class="nav-link" href="password.php">Recuperar Contrase??a</a>
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
                        <h1 class="mt-4">Fundacion Terra</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Panel de Control</li>
                        </ol>                        
                </main>
                                   
<<<<<<<< HEAD:detalle_orden_compra.php
                <form action="" method="post">
                    <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>              
                    <div>
                    <center> <h1> Detalle orden compra </h1></center>
                        <label for="Precio">Precio</label>
				        <input class="form-control" type="text" onKeyUP="this.value=this.value.toUpperCase();" 
                        name="Precio" id="Precio" placeholder="0.00"
                        maxlength="11" >
                    </div>
                    <div>
                        <label for="Descripcion_de_Producto">Descripcion de Producto </label>
				        <input class="form-control" type="text" onKeyUP="this.value=this.value.toUpperCase();" 
                        name="Descripcion_de_Producto" id="Descripcion_de_Producto" placeholder="Ingrese el estado"
                        maxlength="100" >
                    </div>
                    <div>
                        <label for="Producto">Producto</label>
				        <input class="form-control" type="text" onKeyUP="this.value=this.value.toUpperCase();" 
                        name="Producto" id="Producto" placeholder="Ingrese el nombre del producto"
                        onkeypress="return  SoloLetras_Espacio_uno(event)" maxlength="50" >
                    </div>
                    <div>
                        <label for="Cantidad"> Cantidad </label>
				        <input class="form-control" type="text" onKeyUP="this.value=this.value.toUpperCase();" 
                        name="Cantidad" id="Cantidad" placeholder="1"
                        maxlength="11" >
                    </div>
                    <center> <button  type="submit" name="orden" class="btn_save" >Enviar estado </button> </center>
========
                                    <form action="" method="post">
                                    <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>                     
                                   <center> <h1>Crear Nueva Division De empresa</h1></center>
                 <label for="Division_Empresa">Nombre de la division de empresa</label>
                <input class="form-control" type="text" name="Division_Empresa" id="Division_Empresa" onKeyUP="this.value=this.value.toUpperCase();" placeholder="Nombre de divisi??n"
                onkeypress="return  SoloLetras(event)" maxlength="20" >

				
                                        
                                        <center> 
                                                    <button type="submit" name="crear_div_emp" class="btn_save" >Crear Divisi??n</button></div>
                                                    
                                             </center>     
>>>>>>>> d6b6c5477a8a6fb9c5881884d1e23c2920028be4:registro_div_empresa.php
                                    </form><p>
                                    
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