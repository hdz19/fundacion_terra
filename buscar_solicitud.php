<?php 
	session_start();
	/*if($_SESSION['Id_Rol'] != 1)
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
        <title>Buscar Usuarios</title>
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
            <?php 

			$busqueda = strtolower($_REQUEST['busqueda']);
			if(empty($busqueda))
			{
<<<<<<< HEAD
				
=======

				header("location: lista_solicitud.php");

>>>>>>> d6b6c5477a8a6fb9c5881884d1e23c2920028be4
				mysqli_close($conexion);
			}


		 ?>
		
            <!-- Navbar-->
          <right>  <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
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
<<<<<<< HEAD
                       
=======

                       

                        <h1 class="mt-4">Lista de Solicitudes</h1>

>>>>>>> d6b6c5477a8a6fb9c5881884d1e23c2920028be4
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Panel de Control</a></li>
							
                            <li class="breadcrumb-item active">Tabla</li>
                        </ol>
						
					
						
                        <div class="card mb-4">
                           
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
<<<<<<< HEAD
=======

>>>>>>> d6b6c5477a8a6fb9c5881884d1e23c2920028be4
                                Lista Tipo de Solicitudes
                            </div>
							<div class="col-md-6"> <a href="solicitud.php" class="btn_new">Nueva Solicitud</a>

<<<<<<< HEAD
=======
                                Lista Solicitudes
                            </div>
							<div class="col-md-6"> <a href="solicitud.php" class="btn_new">Crear Solicitud</a>


>>>>>>> d6b6c5477a8a6fb9c5881884d1e23c2920028be4

</div>
							<right>     <form action="buscar_solicitud.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<input type="submit" value="Buscar" class="btn_search">

            
		</form></right>
                        <div class="card-body">
                                <table >
								<tbody>
                                    <thead>
									
<<<<<<< HEAD
=======

>>>>>>> d6b6c5477a8a6fb9c5881884d1e23c2920028be4
                                    <tr><td><label>Codigo</label></td>
<td><label>Nombre Completo</label></td>
	<td><label>Tipo de Solicitud </label></td>
    <td><label>Estado </label></td>
    <td><label>Nombre Proyecto</label></td>
    <td><label>Motivo </label></td>
    <td><label>Fecha Registro</label></td>
    <td><label>Acciones</label></td>

    
	
</tr>
										<?php 
		

        $conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");	

        $query = mysqli_query($conexion,"SELECT 
        s.Id_Solicitud, 
          
        s.Id_Personas, 
        s.Id_Tipo_Solicitud, 
        s.Id_Estado,
        s.Nombre_Proyecto, 
        s.Motivo,
        s.Fecha_Registro_Solicitud,
        
        p.Nombre_Completo,
        t.Tipo_Solicitud,
        e.Estado FROM tbl_solicitud s 
        
        INNER JOIN tbl_personas p
        ON s.Id_Personas = p.Id_Personas
        INNER JOIN tbl_tipo_solicitud t
        ON s.Id_Tipo_Solicitud = t.Id_Tipo_Solicitud
        INNER JOIN tbl_estado e
        ON s.Id_Estado = e.Id_Estado
                                    WHERE 
                                    ( s.Id_Solicitud LIKE '%$busqueda%' OR 
                                    s.Id_Personas LIKE '%$busqueda%' OR 
                                    s.Id_Tipo_Solicitud LIKE '%$busqueda%' OR 
                                    s.Id_Estado LIKE '%$busqueda%' OR 	
                                    s.Nombre_Proyecto LIKE '%$busqueda%' OR 
                                    s.Motivo LIKE '%$busqueda%' OR
                                    s.Fecha_Registro_Solicitud LIKE '%$busqueda%' OR 	
                                    p.Nombre_Completo LIKE '%$busqueda%' OR 	  
                                    t.Tipo_Solicitud LIKE '%$busqueda%' OR
                                    e.Estado   LIKE  '%$busqueda%') 
                                   ORDER BY s.Id_Solicitud
            ");
<<<<<<< HEAD
=======
?>
				
                                    <tr>
										<th>Id Solicitud </th>		                        
                                        <th>Enlace</th>	    
			                         	<th>Nombre Completo</th>
				                        <th>Tipo de Solicitud</th>
				                        <th>Estado</th>
				                        <th>Nombre Proyecto</th>
				                        <th>Motivo</th>
				                        <th>Fecha de Registro </th>
                                        <th>Acciones</th>
                                        </tr>
										<?php 
			//Paginador
			$rol = '';
			if($busqueda == 'administrador')
			{
				$rol = " OR rol LIKE '%1%' ";

			}else if($busqueda == 'supervisor'){

				$rol = " OR rol LIKE '%2%' ";

			}else if($busqueda == 'vendedor'){

				$rol = " OR rol LIKE '%3%' ";
			}


			$sql_registe = mysqli_query($conexion,"SELECT COUNT(*) as total_registro FROM tbl_solicitud 
																WHERE ( Id_Solicitud LIKE '%$busqueda%' OR 
																Nombre_Proyecto LIKE '%$busqueda%' OR 
																Motivo LIKE '%$busqueda%' 
																
																		$rol  )");

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

			$query = mysqli_query($conexion,"SELECT s.Id_Solicitud, 
            s.Id_Solicitud_Adjunto, 
            s.Id_Personas, 
            s.Id_Tipo_Solicitud, 
            s.Id_Estado,
            s.Nombre_Proyecto, 
            s.Motivo,
            s.Fecha_Registro_Solicitud,
            a.enlace,
            p.Nombre_Completo,
            t.Tipo_Solicitud,
            e.Estado FROM tbl_solicitud s 
             INNER JOIN tbl_solicitud_adjunto a
			ON s.Id_Solicitud_Adjunto = a.Id_Solicitud_Adjunto 
            INNER JOIN tbl_personas p
			ON s.Id_Personas = p.Id_Personas
            INNER JOIN tbl_tipo_solicitud t
			ON s.Id_Tipo_Solicitud = t.Id_Tipo_Solicitud
            INNER JOIN tbl_estado e
			ON s.Id_Estado = e.Id_Estado 
										WHERE 
										( s.Id_Solicitud LIKE '%$busqueda%' OR 
                                        s.Id_Solicitud_Adjunto LIKE '%$busqueda%' OR 
                                        s.Id_Personas LIKE '%$busqueda%' OR 
                                        s.Id_Tipo_Solicitud LIKE '%$busqueda%' OR 	
                                        s.Id_Estado LIKE '%$busqueda%' OR 
                                        s.Nombre_Proyecto LIKE '%$busqueda%' OR
                                        s.Motivo LIKE '%$busqueda%' OR 	
                                        s.Fecha_Registro_Solicitud LIKE '%$busqueda%' OR 	
                                        a.enlace LIKE '%$busqueda%' OR 	  
                                        p.Nombre_Completo LIKE '%$busqueda%' OR
                                        t.Tipo_Solicitud    LIKE  '%$busqueda%' OR 
                                        e.Estado LIKE '%$busqueda%') 
									
										 ORDER BY s.Id_Solicitud ASC LIMIT $desde,$por_pagina 
				");

>>>>>>> d6b6c5477a8a6fb9c5881884d1e23c2920028be4
			mysqli_close($conexion);
			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
								
				<tr>
                <td><?php echo $data["Id_Solicitud"]; ?></td>
<<<<<<< HEAD
					
=======

					

					<td><?php echo $data["enlace"]; ?></td>
                

>>>>>>> d6b6c5477a8a6fb9c5881884d1e23c2920028be4
					<td><?php echo $data["Nombre_Completo"]; ?></td>
					<td><?php echo $data["Tipo_Solicitud"]; ?></td>
					<td><?php echo $data["Estado"]; ?></td>
					<td><?php echo $data["Nombre_Proyecto"] ?></td>
					<td><?php echo $data["Motivo"] ?></td>
					<td><?php echo $data["Fecha_Registro_Solicitud"] ?></td>
<<<<<<< HEAD
=======

>>>>>>> d6b6c5477a8a6fb9c5881884d1e23c2920028be4
                    <td>
						<a class="link_edit" href="actualizar_solicitud.php?id=<?php echo $data["Id_Solicitud"]; ?>">Editar</a>

				
						|
						<a class="link_delete" href="eliminar_solicitud.php?id=<?php echo $data["Id_Solicitud"]; ?>">Eliminar</a>
					
				
<<<<<<< HEAD
=======

					

					<td>
						<a class="link_edit" href="editar_solicitud.php?id=<?php echo $data["Id_Solicitud"]; ?>">Editar</a>

					<?php if($data["Id_Solicitud"] != 1){ ?>
						|
						<a class="link_delete" href="eliminar_confirmar_solicitudes.php?id=<?php echo $data["Id_Solicitud"]; ?>">Eliminar</a>
					<?php } ?>

>>>>>>> d6b6c5477a8a6fb9c5881884d1e23c2920028be4
						
					</td>
				</tr>
			
		<?php 
				}

			}
		 ?>
										
										</thead>
                                    </tbody>
                                </table>
<<<<<<< HEAD
								
	
	
=======

								<?php 
	
	if($total_registro != 0)
	{
 ?>
		<div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>
             <?php } ?>

>>>>>>> d6b6c5477a8a6fb9c5881884d1e23c2920028be4

			              </ul>
		                  </div>
                            </div>
                        </div>
                    </div>
                </main>
                
		</section>
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
    </body>

</html>
