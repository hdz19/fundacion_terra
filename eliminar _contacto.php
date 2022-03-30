<?php 
	session_start();
	/*if($_SESSION['Id_Rol'] != 1)
	{
		header("location: index.php");
	}*/
	
	$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

	if(!empty($_POST))
	{
		if($_POST['Id_Contacto'] == 1){
			header("location: lista_contacto.php");
			mysqli_close($conexion);
			exit;
		}
		
		$id_contacto = ($_POST['Id_Contacto']);

		$query_delete = mysqli_query($conexion,"DELETE FROM tbl_contacto WHERE Id_Contacto =$id_contacto ");
		//$query_delete = mysqli_query($conexion,"UPDATE tbl_ms_usuario SET Id_Estado_Usuario = 0 WHERE Id_Usuario = $id_usuario ");
		mysqli_close($conexion);
		if($query_delete){
			header("location: lista_contacto.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1 )
	{
		header("location: lista_contacto.php");
		mysqli_close($conexion);
	}else{

		$id_contacto = $_REQUEST['id'];

		$query = mysqli_query($conexion,"SELECT u.Id_Personas,u.Id_Tipo_Contacto
												FROM tbl_contacto u
												WHERE u.Id_Contacto = $id_contacto ");
		
		mysqli_close($conexion);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$id_personas = $data['Id_Personas'];
				$id_tipo_contacto = $data['Id_Tipo_Contacto'];
			}
		}else{
			header("location: lista_contacto.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	
	<title>Eliminar Contacto </title>
	<link href="css/styles.css" rel="stylesheet" />
	<link href="css/style_2.css" rel="stylesheet" />
	
	
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
</head>
<body>
	
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			<p>Id persona: <span><?php echo $id_personas; ?></span></p>
			<p>Id tipo contacto : <span><?php echo $id_tipo_contacto; ?></span></p>
		
			<form method="post" action="">
				<input type="hidden" name="Id_Contacto" value="<?php echo $id_contacto; ?>">
				<a href="lista_contacto.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>
	
</body>
</html>