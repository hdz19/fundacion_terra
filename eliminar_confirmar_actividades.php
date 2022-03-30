<?php 
	session_start();
	if($_SESSION['Id_Rol'] != 1)
	{
		header("location: index.php");
	}
	
	$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

	if(!empty($_POST))
	{
		if($_POST['Id_Actividad'] == 1){
			header("location: actividades.php");
			mysqli_close($conexion);
			exit;
		}
		
		$id_actividad = ($_POST['Id_Actividad']);

		$query_delete = mysqli_query($conexion,"DELETE FROM tbl_actividades WHERE Id_Actividad  =$id_actividad ");
		//$query_delete = mysqli_query($conexion,"UPDATE tbl_ms_usuario SET Id_Estado_Usuario = 0 WHERE Id_Usuario = $id_usuario ");
		mysqli_close($conexion);
		if($query_delete){
			header("location: actividades.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1 )
	{
		header("location: actividades.php");
		mysqli_close($conexion);
	}else{

		$id_actividad = $_REQUEST['id'];

		$query = mysqli_query($conexion,"SELECT a.Id_Actividad, 
          
        a.Archivo, 
        a.Descripcion, 
       
         s.Nombre_Proyecto,
         ta.Tipo_Actividad
         FROM tbl_actividades a
         
       
         INNER JOIN tbl_solicitud s
         ON a.Id_Solicitud = s.Id_Solicitud

         INNER JOIN tbl_tipo_actividad ta
         ON a.Id_Tipo_Actividad = ta.Id_Tipo_Actividad
											
												WHERE Id_Actividad = $id_actividad ");
		
		mysqli_close($conexion);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$archivo = $data['Archivo'];
                $descripcion = $data['Descripcion'];
                $nombre_proyecto = $data['Nombre_Proyecto'];
                $tipo_actividad = $data['Tipo_Actividad'];
				
			}
		}else{
			header("location: actividades.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	
	<title>Eliminar Usuario</title>
	<link href="css/styles.css" rel="stylesheet" />
	<link href="css/style_2.css" rel="stylesheet" />
	
	
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
</head>
<body>
	
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			<p>ID: <span><?php echo $id_actividad; ?></span></p>
			<p> Descripcion: <span><?php echo $descripcion; ?></span></p>
            <p> Nombre del Proyecto: <span><?php echo $nombre_proyecto; ?></span></p>
			

			<form method="post" action="">
				<input type="hidden" name="Id_Actividad" value="<?php echo $id_actividad; ?>">
				<a href="actividades.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>
	
</body>
</html>