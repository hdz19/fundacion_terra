<?php 
	session_start();
	/*if($_SESSION['Id_Rol'] != 1)
	{
		header("location: index.php");
	}*/
	
	$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

	if(!empty($_POST))
	{
		if($_POST['Id_Orden_Compra'] == 1){
			header("location: lista_orden_compra.php");
			mysqli_close($conexion);
			exit;
		}
		
		$id_orden = ($_POST['Id_Orden_Compra']);

		$query_delete = mysqli_query($conexion,"DELETE FROM tbl_orden_compra WHERE Id_Orden_Compra =$id_orden ");
		//$query_delete = mysqli_query($conexion,"UPDATE tbl_ms_usuario SET Id_Estado_Usuario = 0 WHERE Id_Usuario = $id_usuario ");
		mysqli_close($conexion);
		if($query_delete){
			header("location: lista_orden_compra.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1 )
	{
		header("location: lista_orden_compra.php");
		mysqli_close($conexion);
	}else{

		$id_orden = $_REQUEST['id'];

		$query = mysqli_query($conexion,"SELECT oc.Id_Orden_Compra, oc.Id_Estado_Orden_Compra, doc.Id_Detalle_Orden_Compra
												FROM tbl_orden_compra oc
												INNER JOIN
												tbl_detalle_orden_compra doc 
												ON oc.Id_Detalle_Orden_Compra = doc.Id_Rol
												WHERE oc.Id_Orden_Compra = $id_orden ");
		
		mysqli_close($conexion);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$id_orden = $data['Id_Orden_Compra'];
				$estado = $data['Id_Estado_Orden_Compra'];
				$id_detalle     = $data['Id_Detalle_Orden_Compra'];
			}
		}else{
			header("location: lista_orden_compra.php");
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
			<p>Id Orden Compra: <span><?php echo $id_orden; ?></span></p>
			<p>Estado: <span><?php echo $Estado_Orden_Compra; ?></span></p>
			<p>Id Detalle Orden Compra: <span><?php echo $id_detalle; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="Id_Orden_Compra" value="<?php echo $id_orden; ?>">
				<a href="lista_orden_compra.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>
	
</body>
</html>