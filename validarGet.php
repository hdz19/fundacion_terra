
<?php


$usuario=$_GET['Usuario'];

session_start();
$_SESSION['Usuario']=$usuario;


$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

$consulta="SELECT Id_Usuario FROM tbl_ms_usuario where Usuario='$usuario' and Id_Estado_Usuario=1 ";


$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas>0){
  ?>
  <script type="text/javascript">
			alert('¡ Correo enviado exitosamente !')
			</script>

      <?php
    //header("location:index.php");
    
}else{
  var_dump(http_response_code(404));
  
}


mysqli_free_result($resultado);
mysqli_close($conexion);
?>