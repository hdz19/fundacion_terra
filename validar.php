
<?php

include ('funciones.php');
$usuario=$_POST['Usuario'];
$contraseña=($_POST['Contraseña']);

session_start();
$_SESSION['Usuario']=$usuario;

$conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

$consulta="SELECT Id_Usuario,Id_Rol FROM tbl_ms_usuario where Usuario='$usuario' and Contraseña='$contraseña' and Id_Estado_Usuario=1 ";

$resultado=mysqli_query($conexion,$consulta);
$rol=$resultado->fetch_array();
@$_SESSION['Id_Rol']=$rol['Id_Rol'];
@$_SESSION['Id_Usuario']=$rol['Id_Usuario'];
$id_usuario=$_SESSION['Id_Usuario'];
$filas=mysqli_num_rows($resultado);


if($filas>0){
    $bitacora = EVENT_BITACORA($id_usuario ,4,'login','Login realizado con exitos, ingreso correcto.');
    header("location:index.php");
    
}else{
 $_SESSION['reintentos']= $_SESSION['reintentos']+1;
 $resultadointentos=mysqli_query($conexion,"SELECT Valor FROM `tbl_ms_parametros` WHERE `Id_Parametro`=8"); 
 $sqlreintentos=$resultadointentos->fetch_array();
  if($_SESSION['reintentos']>= $sqlreintentos['Valor']){
      $_SESSION['reintentos']=0;
      ?>
      <script type="text/javascript">
			    alert('El usuario a sido bloqueado, ingrese a recuperar contraseña.');
			</script>
  <?php
  $upd="update tbl_ms_usuario set Id_Estado_Usuario=3 where Usuario='$usuario'";
  //Preguntar si solo se bloquea o se resetea la clave y se genera una nueva.
  $resultado=mysqli_query($conexion,$upd);
  }
    //echo @$_SESSION['reintentos'];
    @$bitacora = EVENT_BITACORA($id_usuario ,4,'login','Login no fue exitoso, usuario o contraseña incorrectos. Usuario:'.$id_usuario);
      include("login.php");
      //header("location:login.php");
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