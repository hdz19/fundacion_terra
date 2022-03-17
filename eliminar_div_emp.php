<?php 
	session_start();
	if($_SESSION['Id_Rol'] != 1)
	{
		header("location: index.php");
	}
	
	$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

	if(!empty($_POST))
	{
		if($_POST['Id_Usuario'] == 1){
			header("location: lista_div_empresa.php");
			mysqli_close($conexion);
			exit;
		}
		
		$id_division_empresa = ($_POST['Id_Division_Empresa']);

		$query_delete = mysqli_query($conexion,"DELETE FROM tbl_division_empresa WHERE Id_Division_Empresa = $id_division_empresa ");
		//$query_delete = mysqli_query($conexion,"UPDATE tbl_ms_usuario SET Id_Estado_Usuario = 0 WHERE Id_Usuario = $id_usuario ");
		mysqli_close($conexion);
		if($query_delete){
			header("location: lista_div_empresa.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1 )
	{
		header("location: lista_div_empresa.php");
		mysqli_close($conexion);
	}else{

		$id_division_empresa = $_REQUEST['id'];

		$query = mysqli_query($conexion,"SELECT Id_Division_Empresa
												FROM tbl_division_empresa
												
												WHERE Id_Division_Empresa = $id_division_empresa ");
		
		mysqli_close($conexion);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$division_empresa = $data['Division_Empresa'];
				
			}
		}else{
			header("location: lista_div_empresa.php");
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
			<p>Division empresa: <span><?php echo $division_empresa; ?></span></p>
			
			<form method="post" action="">
				<input type="hidden" name="Id_Division_Empresa" value="<?php echo $id_division_empresa; ?>">
				<a href="lista_div_empresa.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>
	
</body>
</html>