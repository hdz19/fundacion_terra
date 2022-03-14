<?php 
	session_start();
    /*
	if($_SESSION['Id_Rol'] != 1)
	{
		header("location: index.php");
	}
	*/
	$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

	if(!empty($_POST))
	{
		if($_POST['Id_Solicitud'] == 1){
			header("location: lista_solicitud.php");
			mysqli_close($conexion);
			exit;
		}
		
		$id_solicitud = ($_POST['Id_Solicitud']);

		$query_delete = mysqli_query($conexion,"DELETE FROM tbl_solicitud WHERE Id_Solicitud =$id_solicitud ");
		//$query_delete = mysqli_query($conexion,"UPDATE tbl_ms_usuario SET Id_Estado_Usuario = 0 WHERE Id_Usuario = $id_usuario ");
		mysqli_close($conexion);
		if($query_delete){
			header("location: lista_solicitud.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1 )
	{
		header("location: lista_solicitud.php");
		mysqli_close($conexion);
	}else{

		$id_solicitud = $_REQUEST['id'];

		$query = mysqli_query($conexion,"SELECT  
        
        p.Nombre_Completo, 
        t.Tipo_Solicitud, 
        s.Id_Estado,
        e.Estado,
        s.Nombre_Proyecto
      
         FROM tbl_solicitud s 
         INNER JOIN tbl_solicitud_adjunto a
			ON s.Id_Solicitud_Adjunto = a.Id_Solicitud_Adjunto 
        INNER JOIN tbl_personas p
        ON s.Id_Personas = p.Id_Personas
        INNER JOIN tbl_tipo_solicitud t
        ON s.Id_Tipo_Solicitud = t.Id_Tipo_Solicitud
        INNER JOIN tbl_estado e
        ON s.Id_Estado = e.Id_Estado
        WHERE s.Id_Solicitud = $id_solicitud");
		
		mysqli_close($conexion);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				
				$nombre_completo                  = $data['Nombre_Completo'];
				$tipo_solicitud        = $data['Tipo_Solicitud'];
                $estado                = $data['Estado'];
                $nombre_proyecto          = $data['Nombre_Proyecto'];
              


			}
		}else{
			header("location: lista_solicitud.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	
	<title>Eliminar Solicitud</title>
	<link href="css/styles.css" rel="stylesheet" />
	<link href="css/style_2.css" rel="stylesheet" />
	
	
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
</head>
<body>
	
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar la siguiente Solicitud?</h2>
	
			<p>Nombre Completo: <span><?php echo $nombre_completo; ?></span></p>
			<p>Tipo de Solicitud: <span><?php echo $tipo_solicitud; ?></span></p>
            <p>Estado: <span><?php echo $estado; ?></span></p>
            <p>Nombre Proyecto: <span><?php echo $nombre_proyecto; ?></span></p>
          

			<form method="post" action="">
				<input type="hidden" name="Id_Solicitud" value="<?php echo $id_solicitud; ?>">
				<a href="lista_solicitud.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Aceptar" class="btn_ok">
			</form>
		</div>


	</section>
	
</body>
</html>