<?php
    
 //session_start();
 //
 $usuario=$_GET['Usuario'];
 $conexion=mysqli_connect("localhost","root","","bdd_fundacion_terra");

 $consulta="SELECT Id_Usuario, Correo_Electronico FROM tbl_ms_usuario where Usuario='$usuario' and Id_Estado_Usuario= '1'";
 
 $resultado=mysqli_query($conexion,$consulta);
 
 $filas=mysqli_fetch_array($resultado);
 
 if(empty($filas)){
   
     header("location:index.php");
 
 }else{
   $clave=generateRandomString();
   $insert="INSERT INTO tbl_ms_hist_contraseña (Id_Historico, Id_Usuario, Contraseña, 
   Tipo_Contraseña, Creado_Por, Fecha_Creacion, Modificado_Por, Fecha_Modificacion) 
   VALUES (NULL, '".$filas['Id_Usuario']."', '".$clave."', 'T', '".$usuario."', '".date("y-m-d")."', '".$usuario."', '".date("y-m-d")."')";
   $resultado=mysqli_query($conexion,$insert); 
   $Update= "UPDATE `tbl_ms_usuario` SET `Contraseña`='".$clave."' WHERE `Usuario`= '".$usuario."'";
   $resultadoUpd= mysqli_query($conexion,$Update);

    mail ($filas["Correo_Electronico"], "Contraseña Reestablecida", "Estimado (a) $usuario ,
    Hemos reestablecido tu contraseña correctamente.
    Para volver a ingresar utilice la siguiente contraseña: ".$clave.""
    ."
    
    Favor no contestar. 
    Generado automaticamente.
    La contraseña es temporal, tiene 24 horas para utilizarla, luego será desactivada."
   ,
    "From: fundacio.terra22@gmail.com");
 }
 
 function generateRandomString($length = 10) {
   return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}


 ?>
 
 