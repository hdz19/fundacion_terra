<?php
 session_start();
 $usuario=$_SESSION['Usuario'];
mail ("michellochoa997@gmail.com", "Contraseña Reestablecida", "Querido (a)  ,
Hemos reestablecido tu contraseña correctamente.
Para volver a ingresar utilice la siguiente contraseña: ",
"From: michellochoa91@gmail.com");

 ?>
 
 