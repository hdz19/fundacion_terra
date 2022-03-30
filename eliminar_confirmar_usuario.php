<?php 
include ('funciones.php');
	session_start();
	if($_SESSION['Id_Rol'] != 1)
	{
		header("location: index.php");
	}
	
	$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

	if(!empty($_POST))
	{
		if($_POST['Id_Usuario'] == 1){
			header("location: lista_usuarios.php");
			mysqli_close($conexion);
			exit;
		}
		
		$id_usuario = ($_POST['Id_Usuario']);

		$query_delete = mysqli_query($conexion,"DELETE FROM tbl_ms_usuario WHERE Id_Usuario =$id_usuario ");
		//$query_delete = mysqli_query($conexion,"UPDATE tbl_ms_usuario SET Id_Estado_Usuario = 0 WHERE Id_Usuario = $id_usuario ");
		mysqli_close($conexion);
		if($query_delete){
			$bitacora = EVENT_BITACORA($id_usuario ,2,'Delete','Usuario eliminado.');
			header("location: lista_usuarios.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1 )
	{
		header("location: lista_usuarios.php");
		mysqli_close($conexion);
	}else{

		$id_usuario = $_REQUEST['id'];

		$query = mysqli_query($conexion,"SELECT u.Nombre_Usuario,u.Usuario,r.Id_Rol
												FROM tbl_ms_usuario u
												INNER JOIN
												tbl_ms_roles r
												ON u.Id_Rol = r.Id_Rol
												WHERE u.Id_Usuario = $id_usuario ");
		
		mysqli_close($conexion);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$nombre_usuario = $data['Nombre_Usuario'];
				$usuario = $data['Usuario'];
				$id_rol     = $data['Id_Rol'];
			}
		}else{
			header("location: lista_usuarios.php");
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
			<p>Nombre: <span><?php echo $nombre_usuario; ?></span></p>
			<p>Usuario: <span><?php echo $usuario; ?></span></p>
			<p>Tipo Rol de Usuario: <span><?php echo $id_rol; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="Id_Usuario" value="<?php echo $id_usuario; ?>">
				<a href="lista_usuarios.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>
	
</body>
</html>