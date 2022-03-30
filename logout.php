<?php
session_start();
include ('funciones.php');
$id_usuario=$_SESSION['Id_Usuario'];
$bitacora = EVENT_BITACORA($id_usuario ,4,'Log Out','Cierre de sesión realizado.');
//echo $id_usuario;
session_destroy();
header("Location: login.php ");




?>