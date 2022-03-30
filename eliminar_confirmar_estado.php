<?php 
	session_start();
	if($_SESSION['Id_Rol'] != 1)
	{
		header("location: index.php");
	}
	
	$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

	if(!empty($_POST))
	{
		if($_POST['Id_Estado'] == 1){
			header("location: estado_solicitud.php");
			mysqli_close($conexion);
			exit;
		}
		
		$id_estado = ($_POST['Id_Estado']);

		$query_delete = mysqli_query($conexion,"DELETE FROM tbl_estado WHERE Id_Estado =$id_estado ");
		//$query_delete = mysqli_query($conexion,"UPDATE tbl_ms_usuario SET Id_Estado_Usuario = 0 WHERE Id_Usuario = $id_usuario ");
		mysqli_close($conexion);
		if($query_delete){
			header("location: estado_solicitud.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1 )
	{
		header("location: estado_solicitud.php");
		mysqli_close($conexion);
	}else{

		$id_estado = $_REQUEST['id'];

		$query = mysqli_query($conexion,"SELECT Estado
												FROM tbl_estado 
												
											
												WHERE Id_Estado = $id_estado ");
		
		mysqli_close($conexion);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$estado = $data['Estado'];
				
			}
		}else{
			header("location: estado_solicitud.php");
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
			<p>ID: <span><?php echo $id_estado; ?></span></p>
			<p>Estado: <span><?php echo $estado; ?></span></p>
			

			<form method="post" action="">
				<input type="hidden" name="Id_Estado" value="<?php echo $id_estado; ?>">
				<a href="estado_solicitud.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>
	
</body>
</html>