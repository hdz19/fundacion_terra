
<?php


$usuario=$_POST['Usuario'];
$contraseña=($_POST['Contraseña']);

session_start();
$_SESSION['Usuario']=$usuario;


$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

$consulta="SELECT Id_Usuario,Id_Rol FROM tbl_ms_usuario where Usuario='$usuario' and Contraseña='$contraseña' and Id_Estado_Usuario=1 ";


$resultado=mysqli_query($conexion,$consulta);
$rol=$resultado->fetch_array();
$_SESSION['Id_Rol']=$rol['Id_Rol'];

$filas=mysqli_num_rows($resultado);

if($filas>0){
  //print_r($rol);
    header("location:index.php");
    
}else{
  ?>
       
  <?php
    
    include("login.php")
    ?> 
       <script type="text/javascript">
			alert('¡ Usuario o Contraseña Invalido !')
			</script>
    <?php 
    ?>    
  
  <?php 
  
}


mysqli_free_result($resultado);
mysqli_close($conexion);
?>