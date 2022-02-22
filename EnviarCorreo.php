<?php
    session_start();
    $usuario=$_SESSION['Usuario'];
    mail("michellochoa997@gmail.com", "Contraseña reestablecida", "Querido (a) $usuario ,
     Hemos reestablecido tu contraseña correctamente.
     Para volver a ingresar utiliza la siguiente contraseña:  ",
     "From: michellochoa99@gmail.com");
    
 ?>
 
 