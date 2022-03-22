<?php 
	session_start();
	if($_SESSION['Id_Rol'] != 1)
	{
		header("location: index.php");
	}
	
	$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

	if(!empty($_POST))
	{
		if($_POST['Id_Tipo_Persona'] == 1){
			header("location: lista_tipo_persona.php");
			mysqli_close($conexion);
			exit;
		}
		
		$id_tipo_persona = ($_POST['Id_Tipo_Persona']);

		$query_delete = mysqli_query($conexion,"DELETE FROM tbl_tipo_persona WHERE Id_Tipo_Persona = $id_tipo_persona ");
		//$query_delete = mysqli_query($conexion,"UPDATE tbl_ms_usuario SET Id_Estado_Usuario = 0 WHERE Id_Usuario = $id_usuario ");
		mysqli_close($conexion);
		if($query_delete){
			header("location: lista_tipo_persona.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1 )
	{
		header("location: lista_tipo_persona.php");
		mysqli_close($conexion);
	}else{

		$id_tipo_persona = $_REQUEST['id'];

		$query = mysqli_query($conexion,"SELECT Id_Tipo_Persona
												FROM tbl_tipo_persona
												
												WHERE Id_Tipo_Persona = $id_tipo_persona");
		
		mysqli_close($conexion);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$tipo_persona = $data['Tipo_Persona'];
				
			}
		}else{
			header("location: lista_tipo_persona.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	
	<title>Eliminar Tipo Persona</title>
	<link href="css/styles.css" rel="stylesheet" />
	<link href="css/style_2.css" rel="stylesheet" />
	
	
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
</head>
<body>
	
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			<p>Tipo Persona: <span><?php echo $tipo_persona; ?></span></p>
			
			<form method="post" action="">
				<input type="hidden" name="Id_Division_Empresa" value="<?php echo $id_tipo_persona; ?>">
				<a href="lista_div_empresa.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>
	
</body>
</html>