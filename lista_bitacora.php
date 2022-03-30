<?php 
include ('funciones.php');
	session_start();
	if($_SESSION['Id_Rol'] !=1)
	{
		header("location: index.php");
    }
    $id_usuario=$_SESSION['Id_Usuario'];
	$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");
    $bitacora = EVENT_BITACORA($id_usuario ,6,'Consulta','Ingreso a la lista de bitacora.');
 ?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Lista Bitacora</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
		<link href="css/nuevo.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
	    <section id="container">
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Sistema de Solicitudes</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
         
		
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        
                       
                        <li><a class="dropdown-item" href="logout.php">Cerrar Sesion</a></li>
                    </ul>
                </li>
            </ul>
          </nav>
           <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Contenido Informativo
                            </a>
                            <div class="sb-sidenav-menu-heading">Interfaz</div>
                            
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Gestiones
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Usuarios
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                            
                                            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                            
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <li><a class="nav-link" href="registro_usuario.php">Nuevo Usuario</a></li>
                                                <li><a class="nav-link" href="lista_usuarios.php">Lista de Usuarios</a></li>
                                                <li><a class="nav-link" href="lista_bitacora.php">Cambiar Contraseña</a></li>
                                        </nav>
                                        </div>

                                    
                                </nav>
                            </div>
                           
                    </div>
                   
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>

                    <div class="container-fluid px-8">                       
                        
                    <div class="card mb-6">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Lista Bitacora
                            </div> <p>
                            
                            <div class = "col-md-15">
                            <center> <img src="IMG/logo-fundacion.png" > <center>
                            </div>    
                
                       <right> <form action="buscar_usuario.php" method="get" class="form_search">
                                <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
                                <input type="submit" value="Buscar" class="btn_search">
                        </form></right>

                        <div class="card-body">
                        <table >
                            <tbody>
                                <thead>
                                    <tr>
                                    <th></th> <th></th>
                                        <th>Id Bitacora</th> 
                                        <th></th> <th></th>
                                        <th></th>
                                        <th>Id Usuario</th>
                                        <th></th><th></th>
                                        <th></th>
                                        <th>Id Objeto</th>
                                        <th></th><th></th>
                                        <th></th>
                                        <th>Fecha</th>
                                        <th></th><th></th>
                                        <th></th>
                                        <th>Accion</th>
                                        <th></th><th></th>
                                        <th></th>
                                        <th><center>Descripcion</center></th> 
                                        
                                    </tr>          
			                        <?php 
			//Paginador
			$sql_registe = mysqli_query($conexion,"SELECT COUNT(*) as total_registro FROM tbl_ms_bitacora  ");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 5;

			if(empty(@$_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

		$query = mysqli_query($conexion,"SELECT u.Id_Bitacora,u.Id_Usuario,u.Id_Objeto, u.Fecha
		,u.Fecha,u.Accion,u.Descripcion FROM tbl_ms_bitacora u ORDER BY u.Fecha ASC LIMIT $desde,$por_pagina");

		mysqli_close($conexion);

		$result = mysqli_num_rows($query);
		if($result>0){
				while ($data = mysqli_fetch_array($query))
                 {
			    ?>
				<tr style="background-color:white;">
                <td></td> <td></td>
					<td><?php echo $data["Id_Bitacora"]; ?></td>
                    <td></td> <td></td>
                    <td></td>
					<td><?php echo $data["Id_Usuario"]; ?></td>
                    <td></td><td></td>
                    <td></td>
					<td><?php echo $data["Id_Objeto"]; ?></td>
                    <td></td><td></td>
                    <td></td>
					<td><?php echo $data["Fecha"]; ?></td>
                    <td></td><td></td>
                    <td></td>
					<td><?php echo $data["Accion"] ?></td>
                    <td></td><td></td>
                    <td></td>
					<td><?php echo $data["Descripcion"] ?></td>				
					<td>

                    </td>
				</tr>
		        <?php 
				}
			}
		 ?>
                                            </thead>
                                        </tbody>
                                    </table>
        <div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>
    </main>


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
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
		</section>
    </body>

</html>
