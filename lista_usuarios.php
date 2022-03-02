<?php 
/*
	session_start();
	if($_SESSION['Id_Rol'] != 1)
	{
		header("location: ./");
	}
*/	
	$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

 ?>



<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Lista</title>
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
                        <li><a class="dropdown-item" href="#!">Ajustes</a></li>
                       
                        <li><a class="dropdown-item" href="#!">Cerrar Sesion</a></li>
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
                                Panel de Control
                            </a>
                            <div class="sb-sidenav-menu-heading">Interfaz</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Diseños
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.php">Navegación Estatica</a>
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
                                        Autentificacion
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.php">Acceso</a>
                                            <a class="nav-link" href="usuario.php">Registro</a>
                                            <a class="nav-link" href="password.php">Recuperar Contraseña</a>
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
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="Graficas.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Graficas
                            </a>
                            <a class="nav-link" href="tabla.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tabla
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
                        <h1 class="mt-4">Lista de Usuarios</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Panel de Control</a></li>
							
                            <li class="breadcrumb-item active">Tabla</li>
                        </ol>
						
						
						
                        <div class="card mb-4">
                           
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Lista Usuarios
                            </div>
                           <div class="col-md-6"> <a href="registro_usuario.php" class="btn_new">Crear Usuario</a>


</div>
                       <right>     <form action="buscar_usuario.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<input type="submit" value="Buscar" class="btn_search">

            
		</form></right>
                        <div class="card-body">
                                <table >
								<tbody>
                                    <thead>
									
                                        <tr>
										<th>Id Usuario</th>
				                        <th>Usuario</th>
			                          	<th>Nombre Usuario</th>
			                         	<th>Contraseña</th>
				                        <th>Id Rol</th>
			                         	<th>Id Personas</th>
				                        <th>Fecha de Ultima Conexion</th>
				                        <th>Preguntas Contestadas</th>
				                        <th>Primer Ingreso</th>
				                        <th>Fecha Vencimiento</th>
				                        <th>Correo Electrónico</th>
				                        <th>Creado Por</th>
				                        <th>Fecha Creacion</th>
				                       <th>Modificado Por</th>
				                       <th>Fecha_Modificacion Por</th>
				                       <th>Estado Usuario</th>
				                       <th>Acciones</th>
                                        </tr>
										<?php 
			//Paginador
			$sql_registe = mysqli_query($conexion,"SELECT COUNT(*) as total_registro FROM tbl_ms_usuario WHERE Id_Estado_Usuario = 1 ");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 5;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conexion,"SELECT u.Id_Usuario, u.Usuario, u.Nombre_Usuario, u.Contraseña, u.Id_Rol, u.Id_Tipo_Persona,
			u.Fecha_Ultima_Conexion, u.Preguntas_Contestadas, u.Primer_Ingreso, u.Fecha_Vencimiento,
		 u.Correo_Electronico, u.Creado_Por, u.Fecha_Creacion, u.Modificado_Por,u.Fecha_Modificacion, 
		 u.Id_Estado_Usuario FROM tbl_ms_usuario u INNER JOIN tbl_ms_roles r 
			ON u.Id_Rol = r.Id_rol WHERE Id_Estado_Usuario = 1 ORDER BY u.Id_Usuario ASC LIMIT $desde,$por_pagina 
				");

			mysqli_close($conexion);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
				<tr>
					<td><?php echo $data["Id_Usuario"]; ?></td>
					<td><?php echo $data["Usuario"]; ?></td>
					<td><?php echo $data["Nombre_Usuario"]; ?></td>
					<td><?php echo $data["Contraseña"]; ?></td>
					<td><?php echo $data["Id_Rol"]; ?></td>
					<td><?php echo $data["Id_Tipo_Persona"] ?></td>
					<td><?php echo $data["Fecha_Ultima_Conexion"] ?></td>
					<td><?php echo $data["Preguntas_Contestadas"] ?></td>
					<td><?php echo $data["Primer_Ingreso"] ?></td>
					<td><?php echo $data["Fecha_Vencimiento"] ?></td>
					<td><?php echo $data["Correo_Electronico"] ?></td>
					<td><?php echo $data["Creado_Por"] ?></td>
					<td><?php echo $data["Fecha_Creacion"] ?></td>
					<td><?php echo $data["Modificado_Por"] ?></td>
					<td><?php echo $data["Fecha_Modificacion"] ?></td>
					<td><?php echo $data["Id_Estado_Usuario"] ?></td>
					

					<td>
						<a class="link_edit" href="editar_usuario.php?id=<?php echo $data["Id_Usuario"]; ?>">Editar</a>

					<?php if($data["Id_Usuario"] != 1){ ?>
						|
						<a class="link_delete" href="eliminar_confirmar_usuario.php?id=<?php echo $data["Id_Usuario"]; ?>">Eliminar</a>
					<?php } ?>
						
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
                            </div>
                        </div>
                    </div>
                </main>
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
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
		</section>
    </body>

</html>
