<?php
//Campos TBL_MS_USUARIO
$usuario = trim($_GET['Usuario']);
if (preg_match('/(.)\1{3}/i', $usuario)) {
   //echo "¡usuario no puede tener 3 letras consecutivas!";
   var_dump(http_response_code(200));
 }